<?php require_once('../Connections/conexioncolegio.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

if ($_POST["formid"]==1)
	{
  $insertSQL = sprintf("INSERT INTO tblfrecuentes (strTexto, fchFecha) VALUES (%s, NOW())",
                       GetSQLValueString(utf8_decode($_POST['strTexto']), "text"));

  mysql_select_db($database_conexioncolegio, $conexioncolegio);
  $Result1 = mysql_query($insertSQL, $conexioncolegio) or die(mysql_error());
  echo "1";
}
  
  
if ($_POST["formid"]==2)
	{
	  $insertSQL = sprintf("INSERT INTO tblcontacto (strNombre, strEmail, strConsulta, fchFecha) VALUES (%s,%s,%s, NOW())",
						   GetSQLValueString(utf8_decode($_POST['strNombre']), "text"),
						   GetSQLValueString(utf8_decode($_POST['strEmail']), "text"),
						   GetSQLValueString(utf8_decode($_POST['strConsulta']), "text"));
	
	  mysql_select_db($database_conexioncolegio, $conexioncolegio);
	  $Result1 = mysql_query($insertSQL, $conexioncolegio) or die(mysql_error());
	  
	  $contenido='Nombre: '.utf8_decode($_POST['strNombre']).'<br>
	  Email: '.utf8_decode($_POST['strEmail']).'<br>
	  strConsulta: '.utf8_decode($_POST['strConsulta']).'<br>';
	  $asunto='Consulta desde la Web del Colegio';
	  
	  EnvioCorreoHTML(utf8_decode($_POST['strEmail']), maildestinatarioconsultas, $contenido, $asunto);
	  
	  echo "1";
	}
?>