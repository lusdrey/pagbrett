<?php
function conectar(){
	
$user="root";
$pass="";
$server="localhost";
$db="brett";


$con=mysql_connect($server,$user,$pass) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($db,$con);

if (is_file("../includes/funciones.php")){
	include("../includes/funciones.php");
}
else
{
	include("../includes/funciones.php");
	}
}
?>
