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
		<div class="contenido">
			<h1>Contenido</h1>
			<p>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sagittis rutrum gravida. Aliquam vel nunc sit amet nibh aliquam sollicitudin eu vitae elit. Duis varius turpis est, at feugiat metus blandit non. Mauris est nunc, ullamcorper nec egestas at, faucibus ac ex. Cras gravida ut odio eget vulputate. Suspendisse ut nunc cursus, vulputate tortor id, mollis magna. Proin mattis euismod magna. Suspendisse mattis, nunc vitae mattis iaculis, elit massa facilisis magna, ac consequat magna lacus sit amet lectus. Suspendisse a lacinia est, a semper turpis. Phasellus lobortis eget nibh in scelerisque. Morbi feugiat volutpat nisl, vehicula commodo augue volutpat at. Aenean aliquet tristique diam. Aenean maximus, quam non sollicitudin efficitur, est sapien pharetra odio, eget aliquam justo urna eu eros. Donec nec tincidunt tortor.
				<br><br>

				Maecenas pharetra pretium quam ut posuere. Quisque luctus sem purus. Phasellus vel nibh sed erat interdum placerat eget a dui. Vivamus viverra pharetra congue. Sed pretium mi eu dui congue pulvinar. Donec felis risus, malesuada quis tristique faucibus, vestibulum non urna. Fusce nec orci pulvinar, blandit velit quis, finibus neque. Mauris malesuada metus eget ornare pellentesque. Nunc pharetra ante eget ullamcorper finibus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla maximus a dolor non condimentum. Suspendisse convallis ullamcorper justo.
				<br><br>

				Nullam ut erat sit amet elit ultricies tempor vel eget magna. Vivamus vitae diam purus. Fusce semper nisl a nulla congue feugiat. Maecenas et tincidunt felis, dapibus rhoncus sapien. Maecenas tortor tortor, sagittis ac mattis sed, ullamcorper et orci. Pellentesque quis mollis massa. Donec lacinia turpis sapien, eu tincidunt dui rutrum elementum. Maecenas dictum et metus eget aliquam. Sed imperdiet lacinia vulputate. Vivamus mauris arcu, faucibus pulvinar laoreet sed, scelerisque et dui.
			</p>
		</div>
		<aside class="sidebar">
			<?php include("includes/menuizquierda.php"); ?>
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