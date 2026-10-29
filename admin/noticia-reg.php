<?php 
include("ckeditor/ckeditor.php");
include("../libs/fb_xin.php");
include("../libs/fb_xam.php");	
include("../libs/vi/Noticia.php");
$vMenu=4;
?>
<?php include("ihea.php");?>

<style>
/* Estilos del Asistente IA en Formulario de Noticias */
.ia-assistant-bar {
    background: linear-gradient(135deg, #0b2646 0%, #173d69 100%);
    border-radius: 6px;
    padding: 14px 18px;
    margin-bottom: 20px;
    color: #fff;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    box-shadow: 0 3px 8px rgba(11, 38, 70, 0.15);
}
.ia-assistant-title {
    font-size: 14px;
    font-weight: bold;
    display: flex;
    align-items: center;
    gap: 8px;
}
.ia-assistant-title small {
    display: block;
    font-size: 11px;
    font-weight: normal;
    color: #c9e0fa;
    margin-top: 2px;
}
.ia-assistant-btns {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}
.btn-ia-inline {
    background: #ff0913;
    color: #ffffff !important;
    text-decoration: none !important;
    padding: 7px 14px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: bold;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    transition: all 0.2s ease;
}
.btn-ia-inline:hover {
    background: #d40810;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}
.btn-ia-inline-blue {
    background: #0072ce;
}
.btn-ia-inline-blue:hover {
    background: #00569e;
}
.btn-ia-inline-outline {
    background: rgba(255, 255, 255, 0.12);
    border: 1px solid rgba(255, 255, 255, 0.35);
}
.btn-ia-inline-outline:hover {
    background: rgba(255, 255, 255, 0.25);
}

.char-counter {
    float: right;
    font-size: 11px;
    font-weight: normal;
    padding: 2px 7px;
    border-radius: 3px;
    background: #f0f0f0;
    color: #555;
}
.char-counter.ok { background: #e8f5e9; color: #2e7d32; }
.char-counter.warn { background: #fff8e1; color: #f57f17; }
.char-counter.over { background: #ffebee; color: #c62828; font-weight: bold; }

.ia-loaded-alert {
    background: #e8f4fd;
    border-left: 4px solid #0072ce;
    padding: 10px 14px;
    margin-bottom: 15px;
    border-radius: 4px;
    font-size: 12px;
    color: #0b2646;
    display: none;
}

.ia-preview-box {
    margin-top: 10px;
    padding: 10px;
    border: 1px dashed #b8cde3;
    background: #fbfdff;
    border-radius: 6px;
    display: none;
    align-items: center;
    gap: 12px;
}
.ia-preview-box img {
    width: 90px;
    height: 90px;
    object-fit: cover;
    border-radius: 4px;
    border: 1px solid #ccc;
}
.ia-preview-info {
    font-size: 11px;
    color: #444;
    line-height: 1.4;
}
.ia-preview-info strong {
    color: #0b2646;
    display: block;
    margin-bottom: 3px;
    font-size: 12px;
}

/* Modal Selector de Noticias */
.ia-modal-bg {
    display: none;
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0, 0, 0, 0.6);
    z-index: 999999;
    justify-content: center;
    align-items: center;
}
.ia-modal-win {
    background: #fff;
    width: 92%;
    max-width: 850px;
    max-height: 85vh;
    border-radius: 8px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.35);
    display: flex;
    flex-direction: column;
    overflow: hidden;
    text-align: left;
}
.ia-modal-head {
    background: #0b2646;
    color: #fff;
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.ia-modal-head h3 {
    margin: 0;
    font-size: 16px;
    font-weight: bold;
}
.ia-modal-head span {
    font-size: 22px;
    cursor: pointer;
    line-height: 1;
    color: #ccc;
}
.ia-modal-head span:hover { color: #fff; }

.ia-modal-body {
    padding: 15px 20px;
    overflow-y: auto;
    flex: 1;
}
.ia-modal-item {
    display: flex;
    gap: 14px;
    padding: 12px;
    border-bottom: 1px solid #eee;
    align-items: center;
    transition: background 0.15s ease;
}
.ia-modal-item:hover {
    background: #f7faff;
}
.ia-modal-item-thumb {
    width: 80px;
    height: 70px;
    object-fit: cover;
    border-radius: 4px;
    background: #eef2f7;
    flex-shrink: 0;
}
.ia-modal-item-info {
    flex: 1;
}
.ia-modal-item-info h4 {
    margin: 0 0 4px 0;
    font-size: 13px;
    color: #0b2646;
}
.ia-modal-item-info p {
    margin: 0 0 4px 0;
    font-size: 11px;
    color: #555;
    line-height: 1.35;
}
.ia-modal-badge {
    display: inline-block;
    padding: 2px 6px;
    border-radius: 3px;
    font-size: 10px;
    font-weight: bold;
    color: #fff;
}
</style>

		<div class="h2">NOTICIAS</div>
    	<div class="edit">

            <!-- Barra del Asistente IA -->
            <div class="ia-assistant-bar">
                <div class="ia-assistant-title">
                    🤖 Asistente IA de Noticias Diarias
                    <small>Genera o autocompleta con noticias de El Peruano, Gestión, El Comercio y Andina</small>
                </div>
                <div class="ia-assistant-btns">
                    <button type="button" class="btn-ia-inline" id="btnAutoTop" onclick="autocompletarNoticiaTop();">
                        ⚡ Autocompletar con Noticia del Día
                    </button>
                    <button type="button" class="btn-ia-inline btn-ia-inline-blue" onclick="abrirModalSugerencias();">
                        📰 Elegir de Noticias Sugeridas
                    </button>
                    <a href="noticias-sugeridas.php" class="btn-ia-inline btn-ia-inline-outline" title="Ver panel completo">
                        📋 Ver Panel Completo
                    </a>
                </div>
            </div>

            <!-- Alerta de noticia precargada con IA -->
            <div id="iaAlertLoaded" class="ia-loaded-alert">
                ✨ <strong>Noticia cargada con éxito.</strong> Revisa el título, resumen y contenido, verifica la foto y presiona <strong>ACEPTAR</strong> para guardar.
            </div>

        <form name="frm_reg" id="frm_reg" method="post" action="javascript:valSimpleAjx1('','frm_reg','alerta','alerta',3,1,'',0);" enctype="multipart/form-data">
        	<input type="hidden" name="txtSv" id="txtSv" value="noticia.php" />
        	<input type="hidden" name="acc" id="acc" value="3" />
        	<input type="hidden" name="pag" id="pag" value="<?php echo $vIntPagAct;?>" />
          <input name="txtId" id="txtId" type="hidden" value="<?php echo $vIntIdNoticia;?>" />
          <input name="radResaltado" id="radResaltado" type="hidden" value="0">
        	<div id="alerta"></div>
    	  <table width="100%" border="0" cellspacing="0" class="tbl_reg">
    	    <tr>
    	      <th>INFORMACIÓN</th>
    	      <th>&nbsp;</th>
    	      	</tr>
    	    <tr>
    	      <td width="50%" valign="top">
                <h4>Fecha</h4>
                <input type="text" name="txtFecha" id="txtFecha" class="text req" alt="fecha" style="width:12%" value="<?php echo $vFecha;?>" />
                <br /><br />
                <h4>
                    Título
                    <span id="counterTitulo" class="char-counter">0 / 85 car.</span>
                </h4>
                <input type="text" name="txtTitulo" id="txtTitulo" class="text req" alt="título" maxlength="85" style="width:95%" value="<?php echo $vTitulo;?>" oninput="actualizarContadores();" />
                <br /><br />
                <h4>
                    Resumen
                    <span id="counterResumen" class="char-counter">0 / 115 car.</span>
                </h4>
                <input type="text" name="txtResumen" id="txtResumen" class="text" alt="resumen" maxlength="115" style="width:95%" value="<?php echo $vResumen;?>" oninput="actualizarContadores();" />
                <br /><br />
            </td>
    	      <td width="50%" valign="top">
                <h4>Foto</h4>
                <input name="txtImg12" id="txtImg12" type="hidden" value="<?php echo $vFoto;?>" />
                <input name="txtImg11" id="txtImg11" type="file" class="text req" alt="foto principal" style="width:95%" onchange="previsualizarArchivoLocal(this);" />
                <input name="txtImg11lib" id="txtImg11lib" type="hidden" value="jpg,jpeg,gif,JPG,JPEG,GIF,png,PNG" />
                <br />
                Formatos: JPG,GIF,PNG. Peso máximo: 1.8Mb. Tamaño: <?php echo NOTICIA_AN1." x ".NOTICIA_AL1;?> px

                <!-- Caja de Vista Previa de Imagen (Existente o generada por IA) -->
                <div id="iaPreviewBox" class="ia-preview-box" <?php if($vFoto!="") echo 'style="display:flex;"';?>>
                    <img id="imgPreview" src="<?php echo ($vFoto!="") ? $vRuta.$vFoto : '../assets/images/logo.png';?>" alt="Vista previa" />
                    <div class="ia-preview-info">
                        <strong id="previewStatus"><?php echo ($vFoto!="") ? "Imagen actual guardada" : "Imagen preparada para guardar";?></strong>
                        <span id="previewFilename" style="word-break:break-all; font-family:monospace;"><?php echo $vFoto;?></span>
                        <br />
                        <span style="color:#0072ce;">Tamaño optimizado: 255 x 255 px</span>
                    </div>
                </div>

                <?php	if($vFoto!=""){?>
                <br />
                <a href="<?php echo $vRuta.$vFoto;?>" id="lnkVerActual" title="Ver imagen" target="_blank">Ver imagen actual</a>
                <?php	}?>
                <br /><br />
                <h4>Estado</h4>
                <label>
                	<input type="radio" name="radEstado" id="radEstado" value="1" <?php if($vEstado=='1') echo 'checked="checked"';?> />Si
                </label>
                &nbsp;&nbsp;
                <label>
                	<input type="radio" name="radEstado" id="radEstado" value="0" <?php if($vEstado=='0') echo 'checked="checked"';?> />No
                </label>
                <br /><br />
              </td>
  	      	</tr>
    	    <tr>
    	      <td colspan="2">
                <h4>Contenido</h4>
            </td>
          </tr>
    	    <tr>
    	      <td colspan="2">
                <textarea rows="12" style="width:100%;" name="txtContenido" id="txtContenido" maxlength="11000" class="textarea req" alt="contenido" cols="8"><?php echo $vContenido;?></textarea>
                <br><br>
            </td>
          </tr>
    	    <tr>
    	      <td colspan="2" align="right" class="barra">
              	<input type="button" onclick="javascript:location.href='noticia.php';" name="button" id="button" value="VOLVER" class="cancelar" />
                &nbsp;&nbsp;&nbsp;
              	<input type="submit" name="button" id="button" value="ACEPTAR" class="guardar" />
              </td>
    	      </tr>
  	    </table>
        </form>
    	</div>

<!-- Modal Selector de Noticias Sugeridas -->
<div id="modalSugerencias" class="ia-modal-bg">
    <div class="ia-modal-win">
        <div class="ia-modal-head">
            <h3>📰 Seleccionar Noticia Sugerida de Prensa (El Peruano / Gestión / El Comercio)</h3>
            <span onclick="cerrarModalSugerencias();">&times;</span>
        </div>
        <div class="ia-modal-body" id="modalSugerenciasBody">
            <div style="text-align:center; padding:30px;">
                Cargando noticias sugeridas...
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function actualizarContadores() {
    var tit = document.getElementById('txtTitulo').value || '';
    var res = document.getElementById('txtResumen').value || '';

    var cTit = document.getElementById('counterTitulo');
    var cRes = document.getElementById('counterResumen');

    cTit.innerHTML = tit.length + " / 85 car.";
    cRes.innerHTML = res.length + " / 115 car.";

    cTit.className = 'char-counter ' + (tit.length > 85 ? 'over' : (tit.length > 70 ? 'warn' : 'ok'));
    cRes.className = 'char-counter ' + (res.length > 115 ? 'over' : (res.length > 100 ? 'warn' : 'ok'));
}

function previsualizarArchivoLocal(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imgPreview').src = e.target.result;
            document.getElementById('iaPreviewBox').style.display = 'flex';
            document.getElementById('previewStatus').innerText = 'Archivo seleccionado desde tu PC';
            document.getElementById('previewFilename').innerText = input.files[0].name;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function cargarDatosEnFormulario(data) {
    if (data.fecha) document.getElementById('txtFecha').value = data.fecha;
    if (data.titulo) document.getElementById('txtTitulo').value = data.titulo;
    if (data.resumen) document.getElementById('txtResumen').value = data.resumen;
    if (data.contenido) document.getElementById('txtContenido').value = data.contenido;

    if (data.foto) {
        document.getElementById('txtImg12').value = data.foto;
        document.getElementById('imgPreview').src = '../files/noticias/' + data.foto;
        document.getElementById('iaPreviewBox').style.display = 'flex';
        document.getElementById('previewStatus').innerText = 'Imagen preparada y recortada (255x255)';
        document.getElementById('previewFilename').innerText = data.foto;
    } else if (data.image_url) {
        // Mostrar la imagen original del RSS como preview temporal (no guardada aún)
        document.getElementById('imgPreview').src = data.image_url;
        document.getElementById('iaPreviewBox').style.display = 'flex';
        document.getElementById('previewStatus').innerText = 'Vista previa (imagen original de la fuente)';
        document.getElementById('previewFilename').innerText = 'Se recortará a 255x255 al guardar';
    } else {
        // Sin imagen: usar logo de equelle como placeholder
        document.getElementById('imgPreview').src = '../assets/images/logo.png';
        document.getElementById('iaPreviewBox').style.display = 'flex';
        document.getElementById('previewStatus').innerText = 'Sin imagen disponible';
        document.getElementById('previewFilename').innerText = 'Puede subir una imagen manualmente';
    }

    actualizarContadores();

    var alertDiv = document.getElementById('iaAlertLoaded');
    alertDiv.style.display = 'block';
    window.scrollTo(0, 0);
}

function abrirModalSugerencias() {
    document.getElementById('modalSugerencias').style.display = 'flex';
    var body = document.getElementById('modalSugerenciasBody');
    body.innerHTML = '<div style="text-align:center; padding:30px;">⏳ Consultando fuentes de prensa en tiempo real...</div>';

    $.ajax({
        url: 'ia_service.php?action=get_suggestions',
        type: 'GET',
        dataType: 'json',
        success: function(resp) {
            if (resp && resp.status === 'ok' && resp.articles && resp.articles.length > 0) {
                var html = '';
                for (var idx = 0; idx < resp.articles.length; idx++) {
                    var item = resp.articles[idx];
                    var badgeBg = '#b80000';
                    var s = (item.source || '').toLowerCase();
                    if (s.indexOf('gesti') >= 0) badgeBg = '#003366';
                    else if (s.indexOf('comercio') >= 0) badgeBg = '#d98200';
                    else if (s.indexOf('andina') >= 0) badgeBg = '#0077b6';

                    var thumb = item.image_url
                        ? '<img src="' + item.image_url + '" class="ia-modal-item-thumb" onerror="this.src=\'../assets/images/logo.png\';" />'
                        : '<div class="ia-modal-item-thumb" style="display:flex;align-items:center;justify-content:center;font-size:10px;color:#888;">Noticia</div>';

                    html += '<div class="ia-modal-item">' +
                        thumb +
                        '<div class="ia-modal-item-info">' +
                            '<h4>' + item.title + '</h4>' +
                            '<p>' + item.resumen + '</p>' +
                            '<span class="ia-modal-badge" style="background:' + badgeBg + ';">' + item.source + '</span> ' +
                            '<span style="font-size:10px; color:#777; margin-left:6px;">' + item.date + '</span>' +
                        '</div>' +
                        '<div>' +
                            '<button type="button" class="btn-ia-inline btn-ia-inline-blue" id="btnModalUse-' + idx + '" onclick="seleccionarNoticiaModal(' + idx + ');">' +
                                'Usar esta' +
                            '</button>' +
                        '</div>' +
                    '</div>';
                }
                body.innerHTML = html;
                window._modalArticles = resp.articles;
            } else {
                body.innerHTML = '<div style="text-align:center; padding:30px; color:#666;">No se encontraron noticias en este momento.</div>';
            }
        },
        error: function() {
            body.innerHTML = '<div style="text-align:center; padding:30px; color:red;">Error al conectar con el servicio de noticias.</div>';
        }
    });
}

function cerrarModalSugerencias() {
    document.getElementById('modalSugerencias').style.display = 'none';
}

function seleccionarNoticiaModal(idx) {
    if (!window._modalArticles || !window._modalArticles[idx]) return;
    var item = window._modalArticles[idx];

    var btn = document.getElementById('btnModalUse-' + idx);
    var oldText = btn.innerHTML;
    btn.innerHTML = '⏳ Preparando...';
    btn.disabled = true;

    var _itemM = item;
    if (item.image_url && item.image_url.indexOf('http') === 0) {
        $.ajax({
            url: 'ia_service.php',
            type: 'POST',
            data: { action: 'prepare_image', image_url: item.image_url },
            dataType: 'json',
            success: function(resp) {
                var foto = (resp && resp.status === 'ok') ? resp.filename : '';
                aplicarNoticiaEnFormulario(_itemM, foto);
                cerrarModalSugerencias();
            },
            error: function() {
                aplicarNoticiaEnFormulario(_itemM, '');
                cerrarModalSugerencias();
            }
        });
    } else {
        // No hay imagen — buscar por Google imágenes o usar placeholder generado
        buscarImagenFallback(_itemM.title, function(foto) {
            aplicarNoticiaEnFormulario(_itemM, foto);
            cerrarModalSugerencias();
        });
    }
}

function aplicarNoticiaEnFormulario(item, foto) {
    cargarDatosEnFormulario({
        fecha: item.date || '<?php echo date("d/m/Y");?>',
        titulo: item.title,
        resumen: item.resumen,
        contenido: item.content,
        foto: foto,
        image_url: item.image_url || ''
    });
}

// Fallback: si no hay imagen en la noticia, buscar en Google Images
function buscarImagenFallback(titulo, callback) {
    // Intentar obtener imagen desde Google Custom Search via ia_service.php
    $.ajax({
        url: 'ia_service.php',
        type: 'POST',
        data: { action: 'search_image', query: titulo },
        dataType: 'json',
        success: function(resp) {
            if (resp && resp.status === 'ok' && resp.filename) {
                callback(resp.filename);
            } else {
                callback('');
            }
        },
        error: function() {
            callback('');
        }
    });
}

function autocompletarNoticiaTop() {
    var btn = document.getElementById('btnAutoTop');
    var oldText = btn.innerHTML;
    btn.innerHTML = '&#9203; Obteniendo noticia del día...';
    btn.disabled = true;

    $.ajax({
        url: 'ia_service.php?action=get_suggestions',
        type: 'GET',
        dataType: 'json',
        success: function(resp) {
            if (resp && resp.status === 'ok' && resp.articles && resp.articles.length > 0) {
                var top = resp.articles[0];
                var _btn = btn;
                var _oldText = oldText;
                var _top = top;
                if (top.image_url && top.image_url.indexOf('http') === 0) {
                    $.ajax({
                        url: 'ia_service.php',
                        type: 'POST',
                        data: { action: 'prepare_image', image_url: top.image_url },
                        dataType: 'json',
                        success: function(imgResp) {
                            _btn.innerHTML = _oldText;
                            _btn.disabled = false;
                            var foto = (imgResp && imgResp.status === 'ok') ? imgResp.filename : '';
                            aplicarNoticiaEnFormulario(_top, foto);
                        },
                        error: function() {
                            _btn.innerHTML = _oldText;
                            _btn.disabled = false;
                            // Sin imagen — buscar fallback
                            buscarImagenFallback(_top.title, function(foto) {
                                aplicarNoticiaEnFormulario(_top, foto);
                            });
                        }
                    });
                } else {
                    btn.innerHTML = oldText;
                    btn.disabled = false;
                    // Sin imagen en la noticia — buscar fallback
                    buscarImagenFallback(top.title, function(foto) {
                        aplicarNoticiaEnFormulario(top, foto);
                    });
                }
            } else {
                btn.innerHTML = oldText;
                btn.disabled = false;
                alert('No se pudieron cargar noticias en este momento.');
            }
        },
        error: function() {
            btn.innerHTML = oldText;
            btn.disabled = false;
            alert('Error de conexión con el servicio de noticias.');
        }
    });
}

// Inicialización
$(document).ready(function() {
    actualizarContadores();

    // Comprobar si hay una noticia enviada desde sessionStorage (desde noticias-sugeridas.php)
    try {
        var pending = sessionStorage.getItem('equelle_auto_noticia');
        if (pending) {
            var data = JSON.parse(pending);
            sessionStorage.removeItem('equelle_auto_noticia');
            cargarDatosEnFormulario(data);
        }
    } catch(e) {}
});
</script>

<?php include("ifoo.php");?>