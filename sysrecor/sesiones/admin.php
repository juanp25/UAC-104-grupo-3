<!DOCTYPE HTML>
<!--
	Projection by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Entrenador</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="apple-touch-icon" sizes="57x57" href="sesiones/images/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="sesiones/images/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="sesiones/images/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="sesiones/images/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="sesiones/images/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="sesiones/images/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="sesiones/images/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="sesiones/images/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="sesiones/images/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="sesiones/images/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="sesiones/images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="sesiones/images/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="sesiones/images/favicon/favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#FFD700">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#FFD700">
		<link rel="stylesheet" href="sesiones/assets/css/stylee.css" />
		<link rel="stylesheet" href="sesiones/logout/fonts/style.css" />
        <?php
session_start();
if (@!$_SESSION['correo']) {
	header("Location:index.php");
}elseif ($_SESSION['nomRol']== 'Administrador') {
	header("Location:entrenador.php");
}
?>
	</head>
	<body class="subpage">

		<!-- Header -->
			<header id="header">
				<div class="inner">

				<div class="menu" align="left"> 
				<ul id="nav">
				<li><a href="index.php">Inicio</a></li>
                <li><a href="../matricula/matricula.vista.php">Actividades</a></li>
                <li><a href=".php">Asistencia</a></li>
                <li><a href=".php">Datos personales</a></li>
                <li><a href="tipoEjercicio/vistatEjercicio.php">Ejercicios</a></li>
                <li><a href=".php">Graficos</a></li>
                <li><a href="objetivos/vistaObjetivos.php">Objetivos</a></li>
                <li><a href=".php">Salud</a></li>
                <li><a href=".php">Tipo de Sangre</a></li>

             	<div class="menu" align="right"> 
             	<li><a href="">Bienvenido <strong><?php echo $_SESSION['correo'];?></strong> </a></li>
			    
                <li><a href="desconectar.php"> cerrar sesion </a></li>
            	</div>


            	<div id="lavalamp"></div>
            	</ul>
            	</div>

            	
 			

  		



					
					<a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
				</div>
			</header>

		<!-- Three -->
			<section id="three" class="wrapper">
				<div class="inner">
					<header class="align-left">
						<h3>Entrenador</h1>
                        <iframe  align="right" src="../actividad/actividad.vista.php" target="objetivo"
name="objetivo" width="500" height="400" scrolling="no">
						
					</header>
					sdfgdsfgsdfg

					<div class="image round right">
						<img src="images/pic01.png">
					</div>
             
                   
				</div>
			</section>

		<!-- Footer -->
			<footer id="footer">
				<div class="inner">

					

					<div class="copyright">
						&copy; Derechos reservados <a href="https://templated.co">Bogotá</a>. Images: <a href="https://funvida.com">FunvidaYDeporte</a>.
					</div>

				</div>
			</footer>

		<!-- Scripts -->
			<script src="sesiones/assets/js/jquery.min.js"></script>
			<script src="sesiones/assets/js/skel.min.js"></script>
			<script src="sesiones/assets/js/util.js"></script>
			<script src="sesiones/assets/js/main.js"></script>

	</body>
</html>