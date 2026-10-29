<?php 
include("../libs/fb_xin.php");
include("../libs/fb_xam.php");
$vMenu = 44;
?>
<?php include("ihea.php");?>

<style>
/* Estilos modernos para el panel de Noticias Sugeridas IA */
.ia-container {
    padding: 15px 20px 40px 20px;
    font-family: Arial, Helvetica, sans-serif;
    color: #333;
    text-align: left;
}
.ia-header-box {
    background: linear-gradient(135deg, #0b2646 0%, #1e4570 100%);
    border-radius: 8px;
    padding: 22px 25px;
    color: #fff;
    margin-bottom: 22px;
    box-shadow: 0 4px 12px rgba(11, 38, 70, 0.15);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
}
.ia-header-box h1 {
    margin: 0 0 6px 0;
    font-size: 22px;
    font-weight: 700;
    color: #ffffff;
    letter-spacing: 0.5px;
}
.ia-header-box p {
    margin: 0;
    font-size: 13px;
    color: #d2e3f5;
    line-height: 1.4;
}
.ia-header-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}
.btn-ia-action {
    background: #ff0913;
    color: #fff !important;
    text-decoration: none !important;
    padding: 8px 16px;
    border-radius: 5px;
    font-size: 12px;
    font-weight: bold;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
}
.btn-ia-action:hover {
    background: #d40810;
    transform: translateY(-1px);
    box-shadow: 0 2px 6px rgba(0,0,0,0.25);
}
.btn-ia-secondary {
    background: rgba(255, 255, 255, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.3);
}
.btn-ia-secondary:hover {
    background: rgba(255, 255, 255, 0.25);
}

/* Caja de Generación Directa por Tema */
.ia-generator-card {
    background: #f7faff;
    border: 1px solid #c9dced;
    border-left: 5px solid #0056b3;
    border-radius: 6px;
    padding: 18px 20px;
    margin-bottom: 25px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.04);
}
.ia-generator-card h3 {
    margin: 0 0 10px 0;
    font-size: 15px;
    color: #0b2646;
    display: flex;
    align-items: center;
    gap: 8px;
}
.ia-gen-input-group {
    display: flex;
    gap: 10px;
    margin-bottom: 12px;
}
.ia-gen-input-group input[type="text"] {
    flex: 1;
    padding: 9px 14px;
    border: 1px solid #b8cde3;
    border-radius: 5px;
    font-size: 13px;
    outline: none;
    transition: border 0.2s ease;
}
.ia-gen-input-group input[type="text"]:focus {
    border-color: #0056b3;
    box-shadow: 0 0 0 3px rgba(0, 86, 179, 0.1);
}
.ia-chips-container {
    display: flex;
    flex-wrap: wrap;
    gap: 7px;
    align-items: center;
}
.ia-chip {
    background: #e9f2fc;
    color: #0d3b66;
    border: 1px solid #c2dbf3;
    border-radius: 14px;
    padding: 4px 11px;
    font-size: 11px;
    cursor: pointer;
    transition: all 0.15s ease;
    user-select: none;
}
.ia-chip:hover {
    background: #0d3b66;
    color: #fff;
    border-color: #0d3b66;
}

/* Filtros por Categoría */
.ia-filters-bar {
    display: flex;
    gap: 8px;
    margin-bottom: 20px;
    overflow-x: auto;
    padding-bottom: 5px;
}
.filter-btn {
    background: #fff;
    border: 1px solid #d0d7de;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 12px;
    color: #555;
    cursor: pointer;
    white-space: nowrap;
    transition: all 0.2s ease;
}
.filter-btn.active, .filter-btn:hover {
    background: #0b2646;
    color: #fff;
    border-color: #0b2646;
}

/* Grid de Noticias */
.news-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(330px, 1fr));
    gap: 20px;
}
.news-card {
    background: #ffffff;
    border: 1px solid #e1e4e8;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 7px rgba(0, 0, 0, 0.05);
    display: flex;
    flex-direction: column;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.news-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
    border-color: #b8cde3;
}
.news-card-thumb {
    width: 100%;
    height: 170px;
    background: #eef2f7;
    position: relative;
    overflow: hidden;
}
.news-card-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}
.news-card:hover .news-card-thumb img {
    transform: scale(1.04);
}
.badge-source {
    position: absolute;
    top: 10px;
    left: 10px;
    padding: 4px 9px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: bold;
    color: #fff;
    text-transform: uppercase;
    box-shadow: 0 1px 4px rgba(0,0,0,0.3);
}
.badge-elperuano { background: #b80000; }
.badge-gestion { background: #003366; }
.badge-elcomercio { background: #d98200; }
.badge-andina { background: #0077b6; }
.badge-ia { background: #6b21a8; }

.badge-tag {
    position: absolute;
    bottom: 10px;
    left: 10px;
    background: rgba(0, 0, 0, 0.7);
    color: #fff;
    padding: 3px 8px;
    border-radius: 4px;
    font-size: 10px;
}
.news-card-date {
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(255, 255, 255, 0.9);
    color: #333;
    padding: 3px 7px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: bold;
}
.news-card-body {
    padding: 16px;
    flex: 1;
    display: flex;
    flex-direction: column;
}
.news-card-title {
    font-size: 14px;
    font-weight: bold;
    color: #0b2646;
    margin: 0 0 8px 0;
    line-height: 1.35;
    min-height: 38px;
}
.char-count {
    font-size: 10px;
    font-weight: normal;
    color: #777;
    margin-left: 4px;
}
.news-card-resumen {
    font-size: 12px;
    color: #555;
    line-height: 1.4;
    margin: 0 0 14px 0;
    flex: 1;
}
.news-card-footer {
    border-top: 1px solid #f0f0f0;
    padding-top: 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 8px;
}
.btn-use-news {
    background: #0072ce;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 8px 14px;
    font-size: 12px;
    font-weight: bold;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s ease;
    flex: 1;
    justify-content: center;
}
.btn-use-news:hover {
    background: #00569e;
}
.btn-orig-link {
    background: #f1f3f5;
    color: #495057;
    border: 1px solid #ced4da;
    border-radius: 5px;
    padding: 8px 10px;
    font-size: 11px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}
.btn-orig-link:hover {
    background: #e9ecef;
}

/* Estado de carga */
.ia-loading-state {
    text-align: center;
    padding: 60px 20px;
    background: #fff;
    border: 1px solid #e1e4e8;
    border-radius: 8px;
    color: #666;
}
.spinner {
    width: 38px;
    height: 38px;
    border: 4px solid #f3f3f3;
    border-top: 4px solid #0056b3;
    border-radius: 50%;
    animation: spin 0.9s linear infinite;
    margin: 0 auto 15px auto;
}
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Modal de Configuración */
.ia-modal-overlay {
    display: none;
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.55);
    z-index: 99999;
    justify-content: center;
    align-items: center;
}
.ia-modal-content {
    background: #fff;
    border-radius: 8px;
    width: 90%;
    max-width: 500px;
    padding: 24px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    text-align: left;
}
.ia-modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #eee;
    padding-bottom: 12px;
    margin-bottom: 15px;
}
.ia-modal-header h3 {
    margin: 0;
    color: #0b2646;
    font-size: 16px;
}
.ia-modal-close {
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
    color: #999;
}
</style>

<div class="ia-container">
    <!-- Header -->
    <div class="ia-header-box">
        <div>
            <h1>📰 NOTICIAS SUGERIDAS DEL DÍA (IA & PRENSA PERUANA)</h1>
            <p>Monitoreo diario de <strong>El Peruano, Gestión, El Comercio y Andina</strong>, adaptadas para Consultoría Empresarial, Normas ISO y SST.</p>
        </div>
        <div class="ia-header-actions">
            <button type="button" class="btn-ia-action btn-ia-secondary" onclick="cargarNoticias(true);">
                🔄 Actualizar Noticias
            </button>
            <button type="button" class="btn-ia-action btn-ia-secondary" onclick="abrirConfigModal();">
                ⚙️ Configurar Gemini IA
            </button>
            <a href="noticia-reg.php?acc=2" class="btn-ia-action">
                ✍️ Crear Noticia Manual
            </a>
        </div>
    </div>

    <!-- Generador por Tema -->
    <div class="ia-generator-card">
        <h3>💡 Generar Noticia con IA sobre un tema o norma específica</h3>
        <div class="ia-gen-input-group">
            <input type="text" id="txtCustomTopic" placeholder="Escribe un tema (ej. Nuevas exigencias de auditoría para ISO 45001 en Perú, Sunafil multas SST 2026...)" />
            <button type="button" class="btn-ia-action" id="btnGenerarTema" onclick="generarPorTema();">
                ✨ Generar con IA
            </button>
        </div>
        <div class="ia-chips-container">
            <span style="font-size:11px; color:#555; font-weight:bold;">Sugerencias rápidas:</span>
            <span class="ia-chip" onclick="seleccionarChip('ISO 9001: Clave para elevar la productividad empresarial en Perú')">🎯 ISO 9001 Calidad</span>
            <span class="ia-chip" onclick="seleccionarChip('Fiscalizaciones de Sunafil: Claves para el cumplimiento en SST 2026')">🛡️ Sunafil & SST</span>
            <span class="ia-chip" onclick="seleccionarChip('ISO 14001: Gestión Ambiental y sostenibilidad corporativa en Perú')">🌿 ISO 14001 Ambiental</span>
            <span class="ia-chip" onclick="seleccionarChip('ISO 37001: Fortalecimiento de sistemas antisoborno en empresas')">⚖️ ISO 37001 Antisoborno</span>
            <span class="ia-chip" onclick="seleccionarChip('ISO 27001: Ciberseguridad y protección de datos para pymes')">🔒 ISO 27001 Ciberseguridad</span>
        </div>
    </div>

    <!-- Filtros de Categoría -->
    <div class="ia-filters-bar">
        <button type="button" class="filter-btn active" onclick="filtrarNoticias('todos', this);">Todas las Noticias</button>
        <button type="button" class="filter-btn" onclick="filtrarNoticias('Normas ISO', this);">Normas ISO</button>
        <button type="button" class="filter-btn" onclick="filtrarNoticias('SST & Sunafil', this);">SST & Sunafil</button>
        <button type="button" class="filter-btn" onclick="filtrarNoticias('Calidad & Certificación', this);">Calidad & Certificación</button>
        <button type="button" class="filter-btn" onclick="filtrarNoticias('Seguridad & ISO 27001', this);">Seguridad & ISO 27001</button>
        <button type="button" class="filter-btn" onclick="filtrarNoticias('Gestión Ambiental', this);">Gestión Ambiental</button>
    </div>

    <!-- Contenedor de Noticias / Estado de Carga -->
    <div id="loadingContainer" class="ia-loading-state">
        <div class="spinner"></div>
        <h3 style="margin:0 0 5px 0; color:#0b2646;">Consultando fuentes de prensa peruana y preparando noticias...</h3>
        <p style="margin:0; font-size:12px;">Conectando con El Peruano, Gestión, El Comercio y Andina...</p>
    </div>

    <div id="newsGrid" class="news-grid" style="display:none;"></div>
</div>

<!-- Modal Configuración Gemini API -->
<div id="modalConfig" class="ia-modal-overlay">
    <div class="ia-modal-content">
        <div class="ia-modal-header">
            <h3>⚙️ Configuración de Google Gemini API (Opcional)</h3>
            <button type="button" class="ia-modal-close" onclick="cerrarConfigModal();">&times;</button>
        </div>
        <p style="font-size:12px; color:#555; line-height:1.4;">
            El sistema ya cuenta con un <strong>motor experto y extracción inteligente de noticias</strong> activo sin costo. Si deseas además redacción avanzada ilimitada con Google Gemini, puedes ingresar tu API Key gratuita de <a href="https://aistudio.google.com/app/apikey" target="_blank" style="color:#0072ce; font-weight:bold;">Google AI Studio</a>.
        </p>
        <div style="margin:15px 0;">
            <label style="font-weight:bold; font-size:12px; display:block; margin-bottom:5px;">API Key de Gemini:</label>
            <input type="password" id="txtGeminiKey" style="width:95%; padding:8px 10px; border:1px solid #ccc; border-radius:4px; font-size:12px;" placeholder="AIzaSy..." />
        </div>
        <div style="text-align:right;">
            <button type="button" class="btn-ia-action btn-ia-secondary" onclick="cerrarConfigModal();" style="color:#333 !important; border-color:#ccc;">Cancelar</button>
            <button type="button" class="btn-ia-action" onclick="guardarGeminiKey();">Guardar Configuración</button>
        </div>
    </div>
</div>

<script type="text/javascript">
var allArticles = [];

function seleccionarChip(texto) {
    document.getElementById('txtCustomTopic').value = texto;
}

function abrirConfigModal() {
    document.getElementById('modalConfig').style.display = 'flex';
}
function cerrarConfigModal() {
    document.getElementById('modalConfig').style.display = 'none';
}

function guardarGeminiKey() {
    var key = document.getElementById('txtGeminiKey').value;
    $.ajax({
        url: 'ia_service.php',
        type: 'POST',
        data: { action: 'save_gemini_key', key: key },
        dataType: 'json',
        success: function(resp) {
            alert("Configuración guardada exitosamente.");
            cerrarConfigModal();
        }
    });
}

function cargarNoticias(forzar) {
    var loadDiv = document.getElementById('loadingContainer');
    var gridDiv = document.getElementById('newsGrid');
    loadDiv.style.display = 'block';
    gridDiv.style.display = 'none';

    var url = 'ia_service.php?action=get_suggestions' + (forzar ? '&refresh=1' : '');
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            loadDiv.style.display = 'none';
            if (data && data.status === 'ok' && data.articles && data.articles.length > 0) {
                allArticles = data.articles;
                renderizarNoticias(allArticles);
                gridDiv.style.display = 'grid';
            } else {
                loadDiv.innerHTML = '<h3>No se pudieron recuperar noticias en este momento</h3><p>Por favor intente nuevamente.</p>';
                loadDiv.style.display = 'block';
            }
        },
        error: function() {
            loadDiv.innerHTML = '<h3>Error de conexión al cargar noticias</h3><p>Revise su conexión a internet.</p>';
            loadDiv.style.display = 'block';
        }
    });
}

function renderizarNoticias(lista) {
    var grid = document.getElementById('newsGrid');
    grid.innerHTML = '';

    if (lista.length === 0) {
        grid.innerHTML = '<div style="grid-column: 1/-1; text-align:center; padding:40px; color:#666;">No hay noticias para la categoría seleccionada.</div>';
        return;
    }

    for (var idx = 0; idx < lista.length; idx++) {
        var item = lista[idx];
        var badgeClass = 'badge-elperuano';
        var srcLow = (item.source || '').toLowerCase();
        if (srcLow.indexOf('gesti') >= 0) badgeClass = 'badge-gestion';
        else if (srcLow.indexOf('comercio') >= 0) badgeClass = 'badge-elcomercio';
        else if (srcLow.indexOf('andina') >= 0) badgeClass = 'badge-andina';
        else if (srcLow.indexOf('ia') >= 0) badgeClass = 'badge-ia';

        var imgHtml = item.image_url 
            ? '<img src="' + item.image_url + '" alt="Noticia" onerror="this.onerror=null; this.src=\'../assets/images/logo.png\';" />'
            : '<div style="display:flex; align-items:center; justify-content:center; height:100%; color:#999; font-size:12px; font-weight:bold;">Equelle Noticias</div>';

        var card = document.createElement('div');
        card.className = 'news-card';
        card.setAttribute('data-tag', item.tag || '');
        card.innerHTML = 
            '<div class="news-card-thumb">' +
                imgHtml +
                '<span class="badge-source ' + badgeClass + '">' + item.source + '</span>' +
                '<span class="badge-tag">' + (item.tag || 'Consultoría') + '</span>' +
                '<span class="news-card-date">' + item.date + '</span>' +
            '</div>' +
            '<div class="news-card-body">' +
                '<h4 class="news-card-title">' + item.title + '<span class="char-count">(' + item.title.length + '/85)</span></h4>' +
                '<p class="news-card-resumen">' + item.resumen + '<span class="char-count"> (' + item.resumen.length + '/115)</span></p>' +
                '<div class="news-card-footer">' +
                    '<button type="button" class="btn-use-news" id="btn-use-' + idx + '" onclick="usarNoticia(' + idx + ');">' +
                        '📝 Cargar en Formulario' +
                    '</button>' +
                    (item.link ? '<a href="' + item.link + '" target="_blank" class="btn-orig-link" title="Ver original">🔗 Fuente</a>' : '') +
                '</div>' +
            '</div>';

        grid.appendChild(card);
    }
}

function filtrarNoticias(tag, btn) {
    var btns = document.querySelectorAll('.filter-btn');
    for (var i = 0; i < btns.length; i++) {
        btns[i].className = btns[i].className.replace(' active', '').replace('active ', '').replace('active', '');
    }
    btn.className += ' active';

    if (tag === 'todos') {
        renderizarNoticias(allArticles);
    } else {
        var filtradas = [];
        for (var j = 0; j < allArticles.length; j++) {
            if ((allArticles[j].tag || '') === tag) {
                filtradas.push(allArticles[j]);
            }
        }
        renderizarNoticias(filtradas);
    }
}

function usarNoticia(idx) {
    var item = allArticles[idx];
    if (!item) return;

    var btn = document.getElementById('btn-use-' + idx);
    var oldText = btn.innerHTML;
    btn.innerHTML = '⏳ Preparando imagen...';
    btn.disabled = true;

    // Si tiene URL de imagen externa, primero descargarla y recortarla a 255x255
    var _item = item; // captura por valor para closures
    if (item.image_url && item.image_url.indexOf('http') === 0) {
        $.ajax({
            url: 'ia_service.php',
            type: 'POST',
            data: { action: 'prepare_image', image_url: item.image_url },
            dataType: 'json',
            success: function(resp) {
                var fotoFinal = (resp && resp.status === 'ok') ? resp.filename : '';
                enviarAFormulario(_item, fotoFinal);
            },
            error: function() {
                enviarAFormulario(_item, '');
            }
        });
    } else {
        enviarAFormulario(item, '');
    }
}

function enviarAFormulario(item, fotoFilename) {
    // Guardar en sessionStorage para que noticia-reg.php lo consuma al abrirse
    var data = {
        fecha: item.date || '<?php echo date("d/m/Y");?>',
        titulo: item.title,
        resumen: item.resumen,
        contenido: item.content,
        foto: fotoFilename || '',
        origen: item.source || ''
    };
    try {
        sessionStorage.setItem('equelle_auto_noticia', JSON.stringify(data));
    } catch(e) {}

    // Redirigir al formulario de registro nuevo
    location.href = 'noticia-reg.php?acc=2&from_ia=1';
}

function generarPorTema() {
    var topic = document.getElementById('txtCustomTopic').value;
    if (!topic || topic.trim() === '') {
        alert("Por favor ingrese un tema para generar la noticia.");
        return;
    }

    var btn = document.getElementById('btnGenerarTema');
    var oldText = btn.innerHTML;
    btn.innerHTML = '⏳ Redactando noticia con IA...';
    btn.disabled = true;

    var _btn = btn;
    var _oldText = oldText;
    $.ajax({
        url: 'ia_service.php',
        type: 'POST',
        data: { action: 'generate_ai', topic: topic },
        dataType: 'json',
        success: function(resp) {
            _btn.innerHTML = _oldText;
            _btn.disabled = false;
            if (resp && resp.status === 'ok' && resp.data) {
                var art = resp.data;
                var payload = {
                    fecha: '<?php echo date("d/m/Y");?>',
                    titulo: art.titulo,
                    resumen: art.resumen,
                    contenido: art.contenido,
                    foto: '',
                    origen: art.source || 'IA Equelle'
                };
                try { sessionStorage.setItem('equelle_auto_noticia', JSON.stringify(payload)); } catch(e) {}
                location.href = 'noticia-reg.php?acc=2&from_ia=1';
            } else {
                alert("No se pudo generar la noticia. Intente nuevamente.");
            }
        },
        error: function() {
            _btn.innerHTML = _oldText;
            _btn.disabled = false;
            alert("Error de conexión al generar.");
        }
    });
}

// Cargar noticias al iniciar
$(document).ready(function() {
    cargarNoticias(false);
});
</script>

<?php include("ifoo.php");?>
