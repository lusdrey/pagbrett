<?php

// Se inicializa la sesión
session_start();

 /* Se comprueba si el usuario ha iniciado sesión, si no, se redirecciona
 a la página de inicio de sesión (login.php)*/
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Layout de Sitio Web con CSS GRID</title>
	<link  href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link href="css/base.css" rel="stylesheet" type="text/css">
  <link href="css/menu.css" rel="stylesheet" type="text/css">
  <link href="css/footer.css" rel="stylesheet" type="text/css">
  <?php include("includes/header.php"); ?>
	</head>
<body>
	<div class="contenedor">
		<header class="header">
			<?php include("includes/cabecera.php"); ?>
		</header>
		<main class="contenido">
			<h1> Bienvenid@ de Nuevo, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Bienvenid@.</h1>
		<p>
			<a href="logout.php">Cerrar sesión</a><br>
			<a href="reset-password.php" >Cambiar contraseña</a>
		</p>
    <p>
		Nuestro sistema cuenta con ....
  	</p>
		</main>
		<aside class="sidebar">
			<?php include("includes/afterbody.php"); ?>
		</aside>
		<div class="widget-1">
			<h3>WIDGET 1</h3>
		</div>
		<div class="widget-2">
			<h3>WIDGET 2</h3>
		</div>
		<footer class="footer">
			<?php include("includes/pie.php"); ?>
		</footer>
	</div>
</body>
</html>