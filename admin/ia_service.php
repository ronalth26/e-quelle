<?php
/**
 * Servicio Inteligente de Noticias para Equelle
 * - Extrae noticias de El Peruano, Gestión, El Comercio y Andina
 * - Filtra por temas corporativos: Normas ISO, Sunafil, SST, Calidad, Auditorías
 * - Adapta textos: Título (<= 85 chars), Resumen (<= 115 chars) y Contenido estructurado
 * - Descarga y procesa imágenes a 255x255 (NOTICIA_AN1 x NOTICIA_AL1)
 * - Soporte opcional para Google Gemini API
 */

header('Content-Type: application/json; charset=utf-8');
session_start();

// Opcional: Verificación básica de sesión en admin si aplica
// (los archivos de admin incluyen fb_xin.php)

$configFile = __DIR__ . '/ia_config.php';
$geminiApiKey = '';
if (file_exists($configFile)) {
    include $configFile;
    if (defined('GEMINI_API_KEY')) {
        $geminiApiKey = GEMINI_API_KEY;
    }
}
if (empty($geminiApiKey) && getenv('GEMINI_API_KEY')) {
    $geminiApiKey = getenv('GEMINI_API_KEY');
}

$action = isset($_GET['action']) ? $_GET['action'] : (isset($_POST['action']) ? $_POST['action'] : '');

// Directorio destino de imágenes
$targetDir = realpath(__DIR__ . '/../files/noticias');
if (!$targetDir) {
    $targetDir = __DIR__ . '/../files/noticias';
    if (!file_exists($targetDir)) {
        @mkdir($targetDir, 0777, true);
    }
}
$targetDir = rtrim($targetDir, '/\\') . DIRECTORY_SEPARATOR;

// Funciones auxiliares
function cleanTrim($str, $maxLen) {
    $str = html_entity_decode(strip_tags($str), ENT_QUOTES, 'UTF-8');
    $str = preg_replace('/\s+/', ' ', trim($str));
    if (mb_strlen($str, 'UTF-8') <= $maxLen) {
        return $str;
    }
    $trimmed = mb_substr($str, 0, $maxLen - 3, 'UTF-8');
    $lastSpace = mb_strrpos($trimmed, ' ', 0, 'UTF-8');
    if ($lastSpace !== false && $lastSpace > ($maxLen * 0.6)) {
        $trimmed = mb_substr($trimmed, 0, $lastSpace, 'UTF-8');
    }
    return $trimmed . '...';
}

function curlFetch($url, $timeout = 8) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36');
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $data = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return ($code == 200 && $data) ? $data : false;
}

function createSquareCrop($sourcePath, $destPath, $targetW = 255, $targetH = 255) {
    $info = @getimagesize($sourcePath);
    if (!$info) return false;
    
    $origW = $info[0];
    $origH = $info[1];
    $mime = $info['mime'];
    
    switch ($mime) {
        case 'image/jpeg':
        case 'image/jpg':
            $src = @imagecreatefromjpeg($sourcePath);
            break;
        case 'image/png':
            $src = @imagecreatefrompng($sourcePath);
            break;
        case 'image/gif':
            $src = @imagecreatefromgif($sourcePath);
            break;
        case 'image/webp':
            if (function_exists('imagecreatefromwebp')) {
                $src = @imagecreatefromwebp($sourcePath);
            } else {
                $src = false;
            }
            break;
        default:
            $src = false;
    }
    
    if (!$src) return false;
    
    $srcRatio = $origW / $origH;
    $targetRatio = $targetW / $targetH;
    
    if ($srcRatio > $targetRatio) {
        $cropH = $origH;
        $cropW = (int)($origH * $targetRatio);
        $cropX = (int)(($origW - $cropW) / 2);
        $cropY = 0;
    } else {
        $cropW = $origW;
        $cropH = (int)($origW / $targetRatio);
        $cropX = 0;
        $cropY = (int)(($origH - $cropH) / 2);
    }
    
    $dst = imagecreatetruecolor($targetW, $targetH);
    $white = imagecolorallocate($dst, 255, 255, 255);
    imagefilledrectangle($dst, 0, 0, $targetW, $targetH, $white);
    
    imagecopyresampled($dst, $src, 0, 0, $cropX, $cropY, $targetW, $targetH, $cropW, $cropH);
    
    $ok = imagejpeg($dst, $destPath, 90);
    imagedestroy($dst);
    imagedestroy($src);
    return $ok;
}

function scoreRelevance($text) {
    $keywords = [
        'iso' => 15,
        'iso 9001' => 25,
        'iso 14001' => 25,
        'iso 45001' => 25,
        'iso 37001' => 25,
        'iso 27001' => 25,
        'sunafil' => 20,
        'inacal' => 20,
        'calidad' => 10,
        'auditor' => 15,
        'auditoría' => 15,
        'auditoria' => 15,
        'sst' => 15,
        'seguridad y salud' => 18,
        'seguridad laboral' => 18,
        'antisoborno' => 15,
        'ciberseguridad' => 12,
        'empresas' => 8,
        'pymes' => 8,
        'capacitacion' => 8,
        'capacitación' => 8,
        'mejora continua' => 12,
        'gestion ambiental' => 12,
        'sostenibilidad' => 8,
        'normas tecnicas' => 12,
        'fiscalizacion' => 10,
        'fiscalización' => 10
    ];
    
    $lower = mb_strtolower($text, 'UTF-8');
    $score = 0;
    foreach ($keywords as $kw => $pts) {
        if (mb_strpos($lower, $kw) !== false) {
            $score += $pts;
        }
    }
    return $score;
}

function determineTag($text) {
    $lower = mb_strtolower($text, 'UTF-8');
    if (strpos($lower, 'iso') !== false) return 'Normas ISO';
    if (strpos($lower, 'sunafil') !== false || strpos($lower, 'salud') !== false || strpos($lower, 'laboral') !== false) return 'SST & Sunafil';
    if (strpos($lower, 'calidad') !== false || strpos($lower, 'inacal') !== false) return 'Calidad & Certificación';
    if (strpos($lower, 'ciber') !== false || strpos($lower, 'seguridad') !== false) return 'Seguridad & ISO 27001';
    if (strpos($lower, 'ambiental') !== false || strpos($lower, 'sostenib') !== false) return 'Gestión Ambiental';
    return 'Consultoría Empresarial';
}

// Enriquecer contenido corto con análisis corporativo Equelle
function enriquecerContenido($contenido, $titulo) {
    $lower = mb_strtolower($titulo . ' ' . $contenido, 'UTF-8');
    
    if (strpos($lower, 'iso') !== false || strpos($lower, 'calidad') !== false || strpos($lower, 'certificac') !== false) {
        $extra = "\n\nImpacto para las empresas en Perú:\nLos estándares internacionales ISO constituyen una herramienta estratégica que permite a las organizaciones optimizar sus procesos internos, reducir riesgos operativos y mejorar su posicionamiento en el mercado. Para las empresas peruanas, contar con estas certificaciones abre puertas a nuevos mercados, fortalece la confianza de los clientes y facilita el cumplimiento de requisitos en licitaciones públicas y privadas.\n\nRecomendaciones de Equelle Consultoría:\nEs fundamental que las organizaciones realicen un diagnóstico integral de su sistema de gestión, identifiquen las brechas respecto a los requisitos de la norma y desarrollen un plan de implementación con metas claras. La capacitación del equipo humano y el compromiso de la alta dirección son factores críticos de éxito en cualquier proceso de certificación.";
    } elseif (strpos($lower, 'sunafil') !== false || strpos($lower, 'laboral') !== false || strpos($lower, 'trabajador') !== false || strpos($lower, 'sst') !== false) {
        $extra = "\n\nImpacto para los empleadores:\nEl cumplimiento de la normativa laboral y de Seguridad y Salud en el Trabajo (SST) no solo evita sanciones y multas elevadas, sino que contribuye a crear un entorno de trabajo seguro y productivo. Las empresas que invierten en la prevención de riesgos laborales registran menor índice de accidentes, mayor retención del talento y una imagen corporativa sólida.\n\nAcciones recomendadas:\nActualizar la Política de SST, revisar la Matriz IPERC, asegurarse de que el Comité de Seguridad funcione correctamente, y ejecutar las capacitaciones exigidas por la Ley N\u00b0 29783. Un consultor especializado puede orientar este proceso de forma eficiente y sostenible.";
    } elseif (strpos($lower, 'empresa') !== false || strpos($lower, 'econom') !== false || strpos($lower, 'negocio') !== false) {
        $extra = "\n\nPerspectiva empresarial:\nEste tipo de medidas y disposiciones impactan directamente en la planificación estratégica de las organizaciones. Los directivos y gerentes deben evaluar cómo estas políticas afectan sus operaciones, cadena de valor y cumplimiento normativo.\n\nRecomendación de Equelle:\nContar con asesoría especializada permite anticipar cambios regulatorios, adaptar los sistemas de gestión y mantener la competitividad empresarial en un entorno en constante transformación.";
    } else {
        $extra = "\n\nAnálisis de Equelle Consultoría:\nEsta información resulta relevante para las organizaciones que buscan mantenerse actualizadas sobre el entorno normativo y económico del país. Estar al tanto de las últimas disposiciones y tendencias permite a los directivos tomar decisiones informadas y fortalecer sus sistemas de gestión.\n\nLe invitamos a contactar a nuestro equipo de consultores para evaluar cómo estas novedades impactan en su empresa y qué acciones preventivas pueden implementarse de manera inmediata.";
    }
    
    return trim($contenido) . $extra;
}

// -------------------------------------------------------------
// CONTROLADOR DE ACCIONES
// -------------------------------------------------------------

switch ($action) {

    // 1. Obtener lista de noticias sugeridas del día
    case 'get_suggestions':
        $forceRefresh = isset($_GET['refresh']) && $_GET['refresh'] == '1';
        $cacheFile = sys_get_temp_dir() . '/equelle_news_cache.json';
        
        if (!$forceRefresh && file_exists($cacheFile) && (time() - filemtime($cacheFile) < 1800)) {
            $cached = file_get_contents($cacheFile);
            if ($cached) {
                echo $cached;
                exit;
            }
        }
        
        $articles = [];
        
        // --- FUENTE 1: GESTIÓN (Economía & Empresas) ---
        $xmlGestion = curlFetch('https://gestion.pe/arc/outboundfeeds/rss/category/economia/?outputType=xml');
        if ($xmlGestion) {
            $xml = @simplexml_load_string($xmlGestion);
            if ($xml && isset($xml->channel->item)) {
                foreach ($xml->channel->item as $item) {
                    $title = (string)$item->title;
                    $link = (string)$item->link;
                    $desc = (string)$item->description;
                    $date = (string)$item->pubDate;
                    
                    // Contenido completo
                    $contentNs = $item->children('http://purl.org/rss/1.0/modules/content/');
                    $fullContent = isset($contentNs->encoded) ? (string)$contentNs->encoded : $desc;
                    $fullContentClean = trim(strip_tags(str_replace(['<br>', '<br/>', '<br />', '</p>', '</li>'], ["\n", "\n", "\n", "\n\n", "\n"], $fullContent)));
                    
                    // Imagen
                    $mediaNs = $item->children('http://search.yahoo.com/mrss/');
                    $imgUrl = '';
                    if (isset($mediaNs->content)) {
                        $attrs = $mediaNs->content->attributes();
                        $imgUrl = (string)$attrs['url'];
                    }
                    
                    // Enriquecer contenido si es muy corto
                    if (mb_strlen($fullContentClean, 'UTF-8') < 300) {
                        $fullContentClean = enriquecerContenido($fullContentClean, $title);
                    }
                    
                    $score = scoreRelevance($title . ' ' . $desc . ' ' . $fullContentClean);
                    
                    $articles[] = [
                        'source' => 'Gestión',
                        'raw_title' => $title,
                        'title' => cleanTrim($title, 85),
                        'resumen' => cleanTrim($desc, 115),
                        'content' => $fullContentClean,
                        'image_url' => $imgUrl,
                        'link' => $link,
                        'date' => date('d/m/Y', strtotime($date) ?: time()),
                        'score' => $score,
                        'tag' => determineTag($title . ' ' . $desc)
                    ];
                }
            }
        }
        
        // --- FUENTE 2: EL COMERCIO (Día 1 / Economía) ---
        $xmlComercio = curlFetch('https://elcomercio.pe/arc/outboundfeeds/rss/category/economia/?outputType=xml');
        if ($xmlComercio) {
            $xml = @simplexml_load_string($xmlComercio);
            if ($xml && isset($xml->channel->item)) {
                foreach ($xml->channel->item as $item) {
                    $title = (string)$item->title;
                    $link = (string)$item->link;
                    $desc = (string)$item->description;
                    $date = (string)$item->pubDate;
                    
                    $contentNs = $item->children('http://purl.org/rss/1.0/modules/content/');
                    $fullContent = isset($contentNs->encoded) ? (string)$contentNs->encoded : $desc;
                    $fullContentClean = trim(strip_tags(str_replace(['<br>', '<br/>', '<br />', '</p>', '</li>'], ["\n", "\n", "\n", "\n\n", "\n"], $fullContent)));
                    
                    $mediaNs = $item->children('http://search.yahoo.com/mrss/');
                    $imgUrl = '';
                    if (isset($mediaNs->content)) {
                        $attrs = $mediaNs->content->attributes();
                        $imgUrl = (string)$attrs['url'];
                    }
                    
                    // Enriquecer contenido si es muy corto
                    if (mb_strlen($fullContentClean, 'UTF-8') < 300) {
                        $fullContentClean = enriquecerContenido($fullContentClean, $title);
                    }
                    
                    $score = scoreRelevance($title . ' ' . $desc . ' ' . $fullContentClean);
                    
                    $articles[] = [
                        'source' => 'El Comercio',
                        'raw_title' => $title,
                        'title' => cleanTrim($title, 85),
                        'resumen' => cleanTrim($desc, 115),
                        'content' => $fullContentClean,
                        'image_url' => $imgUrl,
                        'link' => $link,
                        'date' => date('d/m/Y', strtotime($date) ?: time()),
                        'score' => $score,
                        'tag' => determineTag($title . ' ' . $desc)
                    ];
                }
            }
        }
        
        // --- FUENTE 3: EL PERUANO (Jurídica & Económika) ---
        $elPeruanoUrls = [
            'https://elperuano.pe/notas-suplemento/juridica',
            'https://elperuano.pe/notas-suplemento/economika'
        ];
        foreach ($elPeruanoUrls as $epUrl) {
            $htmlEp = curlFetch($epUrl);
            if ($htmlEp) {
                preg_match_all('/<a[^>]+href="(\/notas-suplemento\/articulo\/[^"]+)"[^>]*>(.*?)<\/a>/is', $htmlEp, $mLinks);
                if (!empty($mLinks[1])) {
                    $uniqueLinks = array_slice(array_unique($mLinks[1]), 0, 5);
                    foreach ($uniqueLinks as $artRel) {
                        $fullArtUrl = 'https://elperuano.pe' . $artRel;
                        $artHtml = curlFetch($fullArtUrl, 5);
                        if ($artHtml) {
                            preg_match('/<title>(.*?)<\/title>/is', $artHtml, $mT);
                            $artTitle = isset($mT[1]) ? trim(html_entity_decode(strip_tags($mT[1]), ENT_QUOTES, 'UTF-8')) : '';
                            $artTitle = preg_replace('/^Suplemento\s+(Jurídica|Económika):\s*/i', '', $artTitle);
                            
                            preg_match('/<meta[^>]+property=["\']og:image["\'][^>]+content=["\']([^"\']+)["\']/is', $artHtml, $mImg);
                            $artImg = isset($mImg[1]) ? $mImg[1] : '';
                            
                            preg_match('/<meta[^>]+property=["\']og:description["\'][^>]+content=["\']([^"\']+)["\']/is', $artHtml, $mDesc);
                            $artDesc = isset($mDesc[1]) ? trim(html_entity_decode(strip_tags($mDesc[1]), ENT_QUOTES, 'UTF-8')) : '';
                            
                            // Extraer texto de párrafos
                            preg_match_all('/<p[^>]*>(.*?)<\/p>/is', $artHtml, $mParas);
                            $bodyParas = [];
                            foreach ($mParas[1] as $p) {
                                $cleanP = trim(strip_tags($p));
                                if (mb_strlen($cleanP) > 60 && !preg_match('/derechos reservados|política de privacidad|cookies/i', $cleanP)) {
                                    $bodyParas[] = $cleanP;
                                }
                            }
                            $artContent = implode("\n\n", array_slice($bodyParas, 0, 8));
                            if (empty($artDesc) && !empty($bodyParas[0])) {
                                $artDesc = $bodyParas[0];
                            }
                            
                            if (!empty($artTitle)) {
                                $score = scoreRelevance($artTitle . ' ' . $artDesc . ' ' . $artContent) + 10; // Prioridad oficial
                                $articles[] = [
                                    'source' => 'El Peruano',
                                    'raw_title' => $artTitle,
                                    'title' => cleanTrim($artTitle, 85),
                                    'resumen' => cleanTrim($artDesc, 115),
                                    'content' => $artContent,
                                    'image_url' => $artImg,
                                    'link' => $fullArtUrl,
                                    'date' => date('d/m/Y'),
                                    'score' => $score,
                                    'tag' => determineTag($artTitle . ' ' . $artDesc)
                                ];
                            }
                        }
                    }
                }
            }
        }
        
        // --- FUENTE 4: ANDINA (Economía y Normas) ---
        $xmlAndina = curlFetch('https://andina.pe/agencia/rss.aspx?id=3');
        if ($xmlAndina) {
            $xml = @simplexml_load_string($xmlAndina);
            if ($xml && isset($xml->channel->item)) {
                $countAndina = 0;
                foreach ($xml->channel->item as $item) {
                    if ($countAndina++ >= 10) break;
                    $title = (string)$item->title;
                    $link = (string)$item->link;
                    $desc = (string)$item->description;
                    $date = (string)$item->pubDate;
                    
                    $mediaNs = $item->children('http://search.yahoo.com/mrss/');
                    $imgUrl = '';
                    if (isset($mediaNs->thumbnail)) {
                        $attrs = $mediaNs->thumbnail->attributes();
                        $imgUrl = (string)$attrs['url'];
                    }
                    
                    $score = scoreRelevance($title . ' ' . $desc);
                    
                    // Enriquecer contenido Andina si es muy corto
                    $andContent = $desc;
                    if (mb_strlen($andContent, 'UTF-8') < 300) {
                        $andContent = enriquecerContenido($andContent, $title);
                    }
                    
                    $articles[] = [
                        'source' => 'Andina',
                        'raw_title' => $title,
                        'title' => cleanTrim($title, 85),
                        'resumen' => cleanTrim($desc, 115),
                        'content' => $andContent,
                        'image_url' => $imgUrl,
                        'link' => $link,
                        'date' => date('d/m/Y', strtotime($date) ?: time()),
                        'score' => $score,
                        'tag' => determineTag($title . ' ' . $desc)
                    ];
                }
            }
        }
        
        // Ordenar: primero los más relevantes para ISO/Consultoría, luego más recientes
        usort($articles, function($a, $b) {
            if ($a['score'] == $b['score']) {
                return 0;
            }
            return ($a['score'] > $b['score']) ? -1 : 1;
        });
        
        // Eliminar duplicados por título similar
        $seen = [];
        $finalList = [];
        foreach ($articles as $art) {
            $key = mb_strtolower(mb_substr($art['title'], 0, 30));
            if (!isset($seen[$key])) {
                $seen[$key] = true;
                $finalList[] = $art;
            }
            if (count($finalList) >= 20) break;
        }
        
        $output = json_encode([
            'status' => 'ok',
            'count' => count($finalList),
            'timestamp' => date('d/m/Y H:i'),
            'has_gemini' => !empty($geminiApiKey),
            'articles' => $finalList
        ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        
        @file_put_contents($cacheFile, $output);
        echo $output;
        exit;
        break;

    // 2. Descargar y preparar imagen en files/noticias (255x255)
    case 'prepare_image':
        $imgUrl = isset($_POST['image_url']) ? trim($_POST['image_url']) : '';
        if (empty($imgUrl)) {
            echo json_encode(['status' => 'error', 'message' => 'URL de imagen no proporcionada']);
            exit;
        }
        
        $tempFile = tempnam(sys_get_temp_dir(), 'eq_img_');
        $imgData = curlFetch($imgUrl, 10);
        if (!$imgData || strlen($imgData) < 200) {
            echo json_encode(['status' => 'error', 'message' => 'No se pudo descargar la imagen original']);
            exit;
        }
        
        file_put_contents($tempFile, $imgData);
        
        $prefix = "img1_" . date("d") . date("m") . date("Y") . date("H") . date("i") . date("s") . "_" . rand(100, 999);
        $finalFilename = $prefix . ".jpg";
        $finalPath = $targetDir . $finalFilename;
        
        $res = createSquareCrop($tempFile, $finalPath, 255, 255);
        @unlink($tempFile);
        
        if ($res && file_exists($finalPath)) {
            echo json_encode([
                'status' => 'ok',
                'filename' => $finalFilename,
                'preview_url' => '../files/noticias/' . $finalFilename
            ]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al recortar la imagen a 255x255']);
        }
        exit;
        break;

    // 3. Generar / Redactar Noticia con IA (Gemini o Motor Local)
    case 'generate_ai':
        $topic = isset($_POST['topic']) ? trim($_POST['topic']) : '';
        if (empty($topic)) {
            $topic = "Importancia de la certificación ISO 9001 en la competitividad empresarial en Perú";
        }
        
        $result = null;
        
        // Si hay API Key de Gemini configurada, llamar a Google Gemini
        if (!empty($geminiApiKey)) {
            $prompt = "Eres un consultor experto senior de la empresa Equelle (consultoría empresarial en Perú especializada en normas ISO 9001, 14001, 45001, 37001, 27001, Sunafil SST y auditorías).\n" .
                      "Escribe una noticia / artículo corporativo profesional para la web sobre el tema: '{$topic}'.\n\n" .
                      "REGLAS ESTRICTAS DE FORMATO:\n" .
                      "1. Título: MÁXIMO 85 CARACTERES. Atractivo, formal y directo.\n" .
                      "2. Resumen: MÁXIMO 115 CARACTERES. Conciso, claro, para vista previa.\n" .
                      "3. Contenido: Entre 250 y 450 palabras estructurado en párrafos claros separados por doble salto de línea. Incluye contexto empresarial en Perú, impacto para directivos/empresas y recomendaciones prácticas de consultoría.\n" .
                      "Responde ÚNICAMENTE en formato JSON con las claves exactas: 'titulo', 'resumen', 'contenido'.";
            
            $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . urlencode($geminiApiKey);
            $postData = json_encode([
                "contents" => [
                    ["parts" => [["text" => $prompt]]]
                ],
                "generationConfig" => [
                    "temperature" => 0.6,
                    "responseMimeType" => "application/json"
                ]
            ]);
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_TIMEOUT, 15);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $aiResponse = curl_exec($ch);
            curl_close($ch);
            
            if ($aiResponse) {
                $jsonAi = json_decode($aiResponse, true);
                if (isset($jsonAi['candidates'][0]['content']['parts'][0]['text'])) {
                    $rawText = $jsonAi['candidates'][0]['content']['parts'][0]['text'];
                    $parsed = json_decode($rawText, true);
                    if ($parsed && isset($parsed['titulo'])) {
                        $result = [
                            'titulo' => cleanTrim($parsed['titulo'], 85),
                            'resumen' => cleanTrim($parsed['resumen'], 115),
                            'contenido' => trim($parsed['contenido']),
                            'source' => 'Generado con IA Gemini'
                        ];
                    }
                }
            }
        }
        
        // Motor Local de Generación Experta de Respaldo (si no hay clave o falló la API)
        if (!$result) {
            $templates = [
                'iso_calidad' => [
                    'titulo' => 'Normas ISO: Clave para elevar la productividad empresarial en Perú',
                    'resumen' => 'La implementación de estándares internacionales optimiza procesos y abre nuevos mercados.',
                    'contenido' => "En un entorno corporativo cada vez más competitivo, las empresas en el Perú enfrentan el reto continuo de elevar sus estándares operativos y asegurar la satisfacción de clientes cada vez más exigentes.\n\nLa adopción de normas internacionales como la ISO 9001:2015 se ha consolidado como un pilar fundamental. Esta norma no solo certifica la calidad de los procesos, sino que reduce significativamente los sobrecostos operativos y facilita la participación exitosa en licitaciones públicas y privadas.\n\nEspecialistas en consultoría destacan que una adecuada planificación del sistema de gestión permite a las organizaciones alinear sus objetivos estratégicos con la mejora continua. Se recomienda a las empresas realizar auditorías diagnósticas periódicas para identificar brechas de cumplimiento y preparar al equipo humano ante futuros procesos de recertificación."
                ],
                'sst_sunafil' => [
                    'titulo' => 'Fiscalizaciones de Sunafil: Claves para el cumplimiento en SST',
                    'resumen' => 'Recomendaciones fundamentales para prevenir riesgos laborales y sanciones normativas.',
                    'contenido' => "La Superintendencia Nacional de Fiscalización Laboral (Sunafil) continúa intensificando sus campañas de orientación e inspección en los diversos sectores productivos del país, con especial énfasis en el sistema de gestión de Seguridad y Salud en el Trabajo (SST).\n\nPara los empleadores, el cumplimiento estricto de la Ley N° 29783 y sus reglamentos no solo previene contingencias económicas y sanciones de alto impacto, sino que protege la integridad física de los trabajadores y garantiza la continuidad operativa de la empresa.\n\nEntre las medidas críticas se encuentran la actualización de la matriz IPERC, la conformación activa del Comité de SST y la ejecución de las capacitaciones obligatorias. Un plan preventivo articulado con consultores calificados asegura entornos seguros y sostenibles."
                ],
                'iso_37001' => [
                    'titulo' => 'ISO 37001: Fortaleciendo el gobierno corporativo y antisoborno',
                    'resumen' => 'Sistemas de gestión antisoborno garantizan transparencia y confianza ante socios.',
                    'contenido' => "La integridad y la transparencia son hoy valores determinantes para la sostenibilidad de cualquier negocio. La norma internacional ISO 37001 establece requisitos específicos para implementar, mantener y mejorar un sistema de gestión antisoborno en entidades públicas y privadas.\n\nContar con esta certificación genera una sólida ventaja competitiva, proyectando confianza ante inversionistas, entidades financieras y aliados comerciales internacionales, mitigando de raíz los riesgos de corrupción en la cadena de valor.\n\nLa consultoría especializada permite diseñar políticas claras, canales de denuncia confidenciales y mecanismos de debida diligencia adaptados al tamaño y complejidad de cada organización."
                ]
            ];
            
            // Elegir la plantilla más afín al tema
            $chosen = $templates['iso_calidad'];
            $lowerTopic = mb_strtolower($topic, 'UTF-8');
            if (strpos($lowerTopic, 'sunafil') !== false || strpos($lowerTopic, 'salud') !== false || strpos($lowerTopic, 'sst') !== false) {
                $chosen = $templates['sst_sunafil'];
            } elseif (strpos($lowerTopic, 'antisoborno') !== false || strpos($lowerTopic, '37001') !== false || strpos($lowerTopic, 'gobierno') !== false) {
                $chosen = $templates['iso_37001'];
            }
            
            $result = [
                'titulo' => cleanTrim($topic, 85),
                'resumen' => $chosen['resumen'],
                'contenido' => $chosen['contenido'],
                'source' => 'Generador Experto Equelle'
            ];
        }
        
        echo json_encode([
            'status' => 'ok',
            'data' => $result
        ], JSON_UNESCAPED_UNICODE);
        exit;
        break;

    // 4. Adaptar una noticia con enfoque corporativo Equelle
    case 'adapt_news':
        $title = isset($_POST['title']) ? trim($_POST['title']) : '';
        $resumen = isset($_POST['resumen']) ? trim($_POST['resumen']) : '';
        $content = isset($_POST['content']) ? trim($_POST['content']) : '';
        
        $adaptedTitle = cleanTrim($title, 85);
        $adaptedResumen = cleanTrim($resumen, 115);
        
        // Agregar valor analítico corporativo al contenido si es breve
        $corporateFooter = "\n\nImpacto para las empresas:\nEspecialistas sugieren a las organizaciones evaluar el impacto de estas disposiciones en sus operaciones y revisar sus sistemas de gestión y cumplimiento para garantizar una óptima continuidad de negocio.";
        
        if (mb_strlen($content) < 500 && mb_strpos($content, 'Impacto para las empresas') === false) {
            $content .= $corporateFooter;
        }
        
        echo json_encode([
            'status' => 'ok',
            'title' => $adaptedTitle,
            'resumen' => $adaptedResumen,
            'content' => $content
        ], JSON_UNESCAPED_UNICODE);
        exit;
        break;

    // 5. Guardar clave de Gemini si el usuario desea configurarla
    case 'save_gemini_key':
        $key = isset($_POST['key']) ? trim($_POST['key']) : '';
        $content = "<?php\n// Configuración de Gemini API\ndefine('GEMINI_API_KEY', " . var_export($key, true) . ");\n";
        file_put_contents($configFile, $content);
        echo json_encode(['status' => 'ok', 'has_key' => !empty($key)]);
        exit;
        break;

    // 6. Buscar imagen en Google Images para noticias sin foto
    case 'search_image':
        $query = isset($_POST['query']) ? trim($_POST['query']) : '';
        if (empty($query)) {
            echo json_encode(['status' => 'error', 'message' => 'Query vacío']);
            exit;
        }
        
        // Buscar imagen via Google Images (scraping básico)
        $searchUrl = 'https://www.google.com/search?q=' . urlencode($query . ' empresa peru') . '&tbm=isch&hl=es';
        $html = curlFetch($searchUrl, 8);
        $imgFound = '';
        
        if ($html) {
            // Intentar extraer URL de imagen de los resultados de Google
            if (preg_match_all('/"(https?:\/\/[^"\s]+\.(?:jpg|jpeg|png|webp)(?:\?[^"]*)?)"/i', $html, $mImgs)) {
                foreach ($mImgs[1] as $imgCandidate) {
                    // Filtrar thumbnails de Google y gstatic
                    if (strpos($imgCandidate, 'gstatic') === false && 
                        strpos($imgCandidate, 'google') === false &&
                        strpos($imgCandidate, 'data:') === false &&
                        strlen($imgCandidate) > 30) {
                        $imgFound = $imgCandidate;
                        break;
                    }
                }
            }
        }
        
        if (!empty($imgFound)) {
            // Descargar y recortar la imagen encontrada
            $imgData = curlFetch($imgFound, 8);
            if ($imgData && strlen($imgData) > 1000) {
                $tempFile = tempnam(sys_get_temp_dir(), 'eq_gimg_');
                file_put_contents($tempFile, $imgData);
                $prefix = "img1_" . date("dmYHis") . "_" . rand(100, 999);
                $finalFilename = $prefix . ".jpg";
                $finalPath = $targetDir . $finalFilename;
                $res = createSquareCrop($tempFile, $finalPath, 255, 255);
                @unlink($tempFile);
                if ($res && file_exists($finalPath)) {
                    echo json_encode(['status' => 'ok', 'filename' => $finalFilename]);
                    exit;
                }
            }
        }
        
        // Si nada funcionó, generar imagen placeholder con GD
        $placeholder = imagecreatetruecolor(255, 255);
        $bg = imagecolorallocate($placeholder, 11, 38, 70);  // Azul corporativo Equelle
        $fg = imagecolorallocate($placeholder, 255, 255, 255);
        imagefilledrectangle($placeholder, 0, 0, 255, 255, $bg);
        $lines = ['EQUELLE', 'NOTICIAS', date('d/m/Y')];
        foreach ($lines as $i => $line) {
            $y = 90 + $i * 28;
            imagestring($placeholder, 4, (255 - strlen($line) * 8) / 2, $y, $line, $fg);
        }
        $prefix = "img1_placeholder_" . date("dmYHis") . "_" . rand(100, 999);
        $finalFilename = $prefix . ".jpg";
        $finalPath = $targetDir . $finalFilename;
        imagejpeg($placeholder, $finalPath, 85);
        imagedestroy($placeholder);
        
        echo json_encode(['status' => 'ok', 'filename' => $finalFilename, 'generated' => true]);
        exit;
        break;

    default:
        echo json_encode(['status' => 'error', 'message' => 'Acción no válida']);
        exit;
}
