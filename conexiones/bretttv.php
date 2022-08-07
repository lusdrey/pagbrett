<?php
function conectar(){
	
$user="root";
$pass="";
$server="localhost";
$db="brett";


$con=mysql_connect($server,$user,$pass) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($db,$con);
$query_DatosFrecuentes = "SELECT * FROM tblfrecuentes WHERE tblfrecuentes.intEstado = 1 ORDER BY tblfrecuentes.fchFecha DESC";
$DatosFrecuentes = mysql_query($query_DatosFrecuentes, $db) or die(mysql_error());
$row_DatosFrecuentes = mysql_fetch_assoc($DatosFrecuentes);
$totalRows_DatosFrecuentes = mysql_num_rows($DatosFrecuentes);
if (is_file("../includes/funciones.php")){
	include("../includes/funciones.php");
}
else
{
	include("../includes/funciones.php");
	}
}
?>