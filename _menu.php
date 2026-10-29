<!-- Estilos del selector de idioma y eliminación total del banner de Google Translate -->
<style>
	/* --- Forzar tamaño correcto de los iconos de banderas (sobreescribiendo .top_bar img) --- */
	.top_bar img.lang_flag_icon,
	.top_bar .lang_switch_container img,
	.lang_switch_container img,
	img.lang_flag_icon {
		width: 18px !important;
		min-width: 18px !important;
		max-width: 18px !important;
		height: 12px !important;
		min-height: 12px !important;
		max-height: 12px !important;
		object-fit: cover !important;
		border-radius: 2px !important;
		display: inline-block !important;
		vertical-align: middle !important;
		float: none !important;
		margin: 0 !important;
		padding: 0 !important;
		border: none !important;
		box-shadow: 0 1px 2px rgba(0, 0, 0, 0.25) !important;
	}

	/* --- Contenedor del selector en la barra superior --- */
	.top_bar_lang {
		display: flex !important;
		align-items: center !important;
		height: 100% !important;
	}
	.lang_switch_container {
		display: inline-flex !important;
		align-items: center !important;
		background: rgba(0, 0, 0, 0.3) !important;
		border: 1px solid rgba(255, 255, 255, 0.35) !important;
		border-radius: 14px !important;
		padding: 2px 5px !important;
		height: 24px !important;
		box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2) !important;
	}
	.btn_lang {
		background: transparent !important;
		border: none !important;
		color: #ffffff !important;
		font-family: Arial, sans-serif !important;
		font-size: 11px !important;
		font-weight: bold !important;
		cursor: pointer !important;
		padding: 2px 6px !important;
		border-radius: 10px !important;
		display: inline-flex !important;
		align-items: center !important;
		gap: 4px !important;
		line-height: 1 !important;
		height: 18px !important;
		float: none !important;
		transition: all 0.2s ease !important;
		outline: none !important;
		text-decoration: none !important;
	}
	.btn_lang:hover {
		color: #ffffff !important;
		background: rgba(255, 255, 255, 0.2) !important;
	}
	.btn_lang.active {
		background: #ff0913 !important;
		color: #ffffff !important;
	}
	.lang_divider {
		color: rgba(255, 255, 255, 0.5) !important;
		font-size: 10px !important;
		margin: 0 2px !important;
		user-select: none !important;
		line-height: 1 !important;
	}
	.lang_switch_mobile {
		background: #132544 !important;
		border: 1px solid #ff0913 !important;
		border-radius: 16px !important;
		padding: 4px 10px !important;
		height: auto !important;
	}
	.lang_switch_mobile .btn_lang {
		font-size: 13px !important;
		padding: 4px 8px !important;
		height: auto !important;
	}

	/* --- OCULTAR DEFINITIVAMENTE EL BANNER SUPERIOR DE GOOGLE TRANSLATE --- */
	.goog-te-banner-frame,
	.goog-te-banner-frame.skiptranslate,
	iframe.goog-te-banner-frame,
	iframe.skiptranslate,
	body > .skiptranslate,
	iframe[id*="container"],
	iframe[id*=":1."],
	iframe[id*=":2."],
	.VIpgJd-ZVi9od-aZ2wEe-wOHMyf,
	.VIpgJd-ZVi9od-aZ2wEe-OiiCO,
	#goog-gt-tt,
	.goog-te-balloon-frame {
		display: none !important;
		visibility: hidden !important;
		height: 0px !important;
		width: 0px !important;
		max-height: 0px !important;
		position: absolute !important;
		top: -9999px !important;
		left: -9999px !important;
		opacity: 0 !important;
		pointer-events: none !important;
		z-index: -9999 !important;
	}
	html, body {
		top: 0px !important;
		position: static !important;
		margin-top: 0px !important;
		padding-top: 0px !important;
	}
	.goog-text-highlight {
		background: none !important;
		box-shadow: none !important;
	}
	#google_translate_element {
		display: none !important;
	}
</style>

<!-- Header -->

	<header class="header">
			
		<!-- Top Bar -->
		<div class="top_bar">
			<div class="top_bar_container">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="top_bar_content d-flex flex-row align-items-center justify-content-start">
								<!-- Selector de idioma (Español / Inglés) -->
								<div class="top_bar_lang mr-auto">
									<div class="lang_switch_container notranslate">
										<button type="button" class="btn_lang btn_lang_es active" onclick="cambiarIdioma('es')" title="Español">
											<img src="https://flagcdn.com/w20/es.png" alt="ES" class="lang_flag_icon" style="width:18px !important; height:12px !important; min-width:18px !important; max-width:18px !important; min-height:12px !important; max-height:12px !important; display:inline-block !important; vertical-align:middle !important; float:none !important; margin:0 !important; padding:0 !important;" onerror="this.style.display='none'"> ES
										</button>
										<span class="lang_divider">|</span>
										<button type="button" class="btn_lang btn_lang_en" onclick="cambiarIdioma('en')" title="English">
											<img src="https://flagcdn.com/w20/us.png" alt="EN" class="lang_flag_icon" style="width:18px !important; height:12px !important; min-width:18px !important; max-width:18px !important; min-height:12px !important; max-height:12px !important; display:inline-block !important; vertical-align:middle !important; float:none !important; margin:0 !important; padding:0 !important;" onerror="this.style.display='none'"> EN
										</button>
									</div>
								</div>
								<div class="top_bar_login ml-auto">
									<a href="https://proveedores.e-quelle.net/intranet/" target="_blank" title="Proveedores">
										<img src="assets/images/boton_sistema.svg" onerror="this.onerror=null; this.src='assets/images/boton_sistema.png'">
									</a>
									<a href="https://miaulavirtual.e-quelle.net/" target="_blank" title="Aula Virtual">
										<img src="assets/images/boton_intra.svg" onerror="this.onerror=null; this.src='assets/images/boton_intra.png'">
									</a>
									
									<a href="https://comercial.e-quelle.net/" title="login">
									<img src="assets/images/equelle_usuario.png"
										onerror="this.onerror=null; this.src='assets/images/boton_sistema.png'">
							    	</a>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>				
		</div>

		<!-- Header Content -->
		<div class="header_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="header_content d-flex flex-row align-items-center justify-content-start">
							<div class="logo_container">
								<a href="index.php">
									<div class="logo_text">
										<img src="assets/images/logo.svg"  onerror="this.onerror=null; this.src='assets/images/logo.png'">
									</div>
								</a>
							</div>
							<nav class="main_nav_contaner ml-auto">
								<ul class="main_nav">
									<li<?php if($vIntIdSeccion==2) echo ' class="active"';?>><a href="nosotros.php">Nosotros</a></li>
									<li<?php if($vIntIdSeccion==3) echo ' class="active"';?>><a href="servicios.php">Servicios</a></li>
									<li<?php if($vIntIdSeccion==4) echo ' class="active"';?>><a href="clientes.php">Clientes</a></li>
									<li<?php if($vIntIdSeccion==5) echo ' class="active"';?>><a href="noticias.php">Noticias</a></li>
									<li<?php if($vIntIdSeccion==6) echo ' class="active"';?>><a href="contactos.php">Contactos</a></li>
								</ul>

								<!-- Hamburger -->
								<div class="hamburger menu_mm">
									<i class="fa fa-bars menu_mm" aria-hidden="true"></i>
								</div>
							</nav>

						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- Menu -->
	<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm menu_movil trans_400" style="z-index:2000">
		<div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>
		<nav class="menu_nav">
			<ul class="menu_mm">
				<li class="menu_mm"><a href="index.php">Inicio</a></li>
				<li class="menu_mm"><a href="nosotros.php">Nosotros</a></li>
				<li class="menu_mm"><a href="servicios.php">Servicios</a></li>
				<li class="menu_mm"><a href="clientes.php">Clientes</a></li>
				<li class="menu_mm"><a href="noticias.php">Noticias</a></li>
				<li class="menu_mm"><a href="contactos.php">Contactos</a></li>
				<li class="menu_mm pt-3 pr-3">
					<div class="lang_switch_container lang_switch_mobile notranslate">
						<button type="button" class="btn_lang btn_lang_es active" onclick="cambiarIdioma('es')" title="Español">
							<img src="https://flagcdn.com/w20/es.png" alt="ES" class="lang_flag_icon" style="width:18px !important; height:12px !important; min-width:18px !important; max-width:18px !important; min-height:12px !important; max-height:12px !important; display:inline-block !important; vertical-align:middle !important; float:none !important; margin:0 !important; padding:0 !important;" onerror="this.style.display='none'"> ES
						</button>
						<span class="lang_divider">|</span>
						<button type="button" class="btn_lang btn_lang_en" onclick="cambiarIdioma('en')" title="English">
							<img src="https://flagcdn.com/w20/us.png" alt="EN" class="lang_flag_icon" style="width:18px !important; height:12px !important; min-width:18px !important; max-width:18px !important; min-height:12px !important; max-height:12px !important; display:inline-block !important; vertical-align:middle !important; float:none !important; margin:0 !important; padding:0 !important;" onerror="this.style.display='none'"> EN
						</button>
					</div>
				</li>
			</ul>
		</nav>
	</div>

	<!-- Contenedor oculto del traductor de Google -->
	<div id="google_translate_element" style="display:none;"></div>

	<script type="text/javascript">
		function googleTranslateElementInit() {
			new google.translate.TranslateElement({
				pageLanguage: 'es',
				includedLanguages: 'en,es',
				autoDisplay: false
			}, 'google_translate_element');
		}

		// Función que elimina y suprime activamente el banner superior de Google
		function suprimirBannerGoogle() {
			var frames = document.querySelectorAll('iframe.goog-te-banner-frame, iframe.skiptranslate, body > .skiptranslate, iframe[id*="container"], .goog-te-banner-frame');
			for (var i = 0; i < frames.length; i++) {
				frames[i].style.setProperty('display', 'none', 'important');
				frames[i].style.setProperty('visibility', 'hidden', 'important');
				frames[i].style.setProperty('height', '0px', 'important');
				frames[i].style.setProperty('position', 'absolute', 'important');
				frames[i].style.setProperty('top', '-9999px', 'important');
			}
			if (document.body && document.body.style.top !== '0px') {
				document.body.style.setProperty('top', '0px', 'important');
				document.body.style.setProperty('position', 'static', 'important');
			}
			if (document.documentElement && document.documentElement.style.top !== '0px') {
				document.documentElement.style.setProperty('top', '0px', 'important');
			}
		}

		// Ejecución periódica para evitar cualquier parpadeo o aparición del banner
		setInterval(suprimirBannerGoogle, 50);

		if (window.MutationObserver) {
			var bannerObserver = new MutationObserver(function() {
				suprimirBannerGoogle();
			});
			bannerObserver.observe(document.documentElement, {
				childList: true,
				subtree: true,
				attributes: true,
				attributeFilter: ['style', 'class']
			});
		}

		function getCookie(name) {
			var match = document.cookie.match(new RegExp('(^|;\\s*)' + name + '=([^;]+)'));
			return match ? decodeURIComponent(match[2]) : null;
		}

		function getIdiomaActual() {
			var trans = getCookie('googtrans');
			if (trans && (trans.indexOf('/es/en') !== -1 || trans.endsWith('/en'))) {
				return 'en';
			}
			return 'es';
		}

		function actualizarBotones(lang) {
			var btnsEs = document.querySelectorAll('.btn_lang_es');
			var btnsEn = document.querySelectorAll('.btn_lang_en');

			btnsEs.forEach(function(b) {
				if (lang === 'es') b.classList.add('active');
				else b.classList.remove('active');
			});
			btnsEn.forEach(function(b) {
				if (lang === 'en') b.classList.add('active');
				else b.classList.remove('active');
			});
		}

		function cambiarIdioma(lang) {
			var host = window.location.hostname;
			var domainParts = host.split('.');
			var rootDomain = domainParts.length > 1 ? '.' + domainParts.slice(-2).join('.') : '';

			if (lang === 'es') {
				// Eliminar cookies para retornar al idioma original (español)
				document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
				document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; domain=" + host + "; path=/;";
				if (rootDomain) {
					document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; domain=" + rootDomain + "; path=/;";
				}
				document.cookie = "googtrans=/es/es; path=/;";

				var combo = document.querySelector(".goog-te-combo");
				if (combo) {
					combo.value = 'es';
					combo.dispatchEvent(new Event('change'));
				}
				location.reload();
			} else {
				// Establecer cookie para inglés
				document.cookie = "googtrans=/es/" + lang + "; path=/;";
				document.cookie = "googtrans=/es/" + lang + "; domain=" + host + "; path=/;";
				if (rootDomain) {
					document.cookie = "googtrans=/es/" + lang + "; domain=" + rootDomain + "; path=/;";
				}

				var combo = document.querySelector(".goog-te-combo");
				if (combo) {
					combo.value = lang;
					combo.dispatchEvent(new Event('change'));
					actualizarBotones(lang);
				} else {
					location.reload();
				}
			}
		}

		document.addEventListener('DOMContentLoaded', function() {
			actualizarBotones(getIdiomaActual());
			suprimirBannerGoogle();
		});
	</script>
	<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>