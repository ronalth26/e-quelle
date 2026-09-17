<!DOCTYPE html>
<html lang="es">
<head>
    <title><?php echo $vSeoTag;?></title>
    <meta charset="utf-8">
    <meta name="theme-color" content="#ff0913">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="e quelle compañía peruana especializada en consultoría, auditorías y capacitación virtual y presencial en sistemas de gestión; medimos y validamos la huella de carbono.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/assets/styles/bootstrap4/bootstrap.min.css">
    <link href="/assets/pluginsjs/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="/assets/pluginsjs/lightcase/src/css/lightcase.css">
    <link href="/assets/styles/animate.css" rel="stylesheet">
<?php	if($vIntIdSeccion=='1'){?>
    <link rel="stylesheet" href="/assets/pluginsjs/owlcarousel/owl.carousel.css">
    <link rel="stylesheet" href="/assets/pluginsjs/owlcarousel/owl.theme.default.css">
    <link rel="stylesheet" href="/assets/pluginsjs/owlcarousel/owl.css">
<?php	}else{?>
    <link rel="stylesheet" href="/assets/pluginsjs/nivoslider/themes/default/default.css">
    <link rel="stylesheet" href="/assets/pluginsjs/nivoslider/nivo-slider.css">
<?php	}?>
    <link rel="stylesheet" href="/assets/styles/main_styles.css">
    <link rel="stylesheet" href="/assets/styles/responsive.css">
<?php if($vSocialUrl!=""){?>
    <meta property="og:title" content="<?php echo $vTitulo;?>">
    <meta property="og:description" content="<?php echo $vSocialDes;?>">
    <meta property="og:image" content="<?php echo $vSocialImg;?>">
    <meta expr:content='<?php echo $vSocialImg;?>' property='og:image'>
    <meta property="og:url" content="<?php echo $vSocialUrls;?>">
    <meta property="og:type" content="website">
	<meta property="og:site_name" content="e quelle - Consultoría en Sistemas de Gestión">
<?php }?>
    <link rel="shortcut icon" href="/assets/images/favicon.ico">
    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->
    
    <!-- Google tag (gtag.js) -->
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-1GJCFV62BT"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-1GJCFV62BT');
    </script>
    
    <!-- Google Tag (gtag.js) 2-->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-11503524819"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'AW-11503524819');
    </script>


</head>
<body>
<div class="ayuda">
    <div class="box text-center">
        <h3>¿En qué te podemos ayudar?</h3>
        <div class="resumen">
            Atendemos todas tus solicitudes y dudas<br> de manera confidencial
        </div>
        <a href="#proyecto" data-rel="lightcase" class="btn btn-primary owl-slide-animated">Iniciar un proyecto</a>
    </div>
</div>
<div class="super_container">