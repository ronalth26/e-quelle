<!-- Header -->

	<header class="header">
			
		<!-- Top Bar -->
		<div class="top_bar">
			<div class="top_bar_container">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="top_bar_content d-flex flex-row align-items-center justify-content-start">
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
			</ul>
		</nav>
	</div>