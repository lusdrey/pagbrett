<?php 

define("mailremitente", "jorvidu@gmail.com");
define("maildestinatarioconsultas", "jorvidu@gmail.com");

//***************************************************
//***************************************************
//***************************************************

function EnvioCorreoHTML($remitente, $destinatario, $contenido, $asunto)
{

	$mensaje = '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<table width="100%" border="0" cellspacing="3" cellpadding="3">
  <tr>
    <td><img src="IMAGENPENDIENTE.jpg" width="318" height="65" /></td>
  </tr>
  <tr>
    <td><p>Estimado Cliente:</p>
    <p>';
	$mensaje.= $contenido;
	$mensaje.='</p></td>
  </tr>
  <tr>
    <td>Muchas gracias, puede contactarnos a través de nuestro correo electrónico:<br />      <a href="mailto:info@bretttv.com">info@bretttv.com</a></td>
  </tr>
</table>
</body>
</html>';

	// Para enviar correo HTML, la cabecera Content-type debe definirse
	
	$cabeceras  = 'MIME-Version: 1.0' . "\n";
	$cabeceras .= 'Content-type: text/html; charset=utf-8' . "\n";
	// Cabeceras adicionales
	$cabeceras .= 'From: '.$remitente.'\n';
	//$cabeceras .= 'Bcc: info@bretttv.com' . "\n";
	
	// Enviarlo
	//mail($destinatario, $asunto, $mensaje, $cabeceras);
	//echo $mensaje;
	
/*	include("includes/class.phpmailer.php");
	include("includes/class.smtp.php");

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
///////$mail->SMTPSecure = "ssl";

$mail->Host = "bretttv.com";
$mail->Port = 25;
$mail->Username = "noresponder@brettv.com";
$mail->Password = "wedfkh2487jh2eg";

$mail->From = "noresponder@bretttv.com";
$mail->FromName = "la Televisi&oacute;n que tu quieres";
$mail->Subject = $asunto;
$mail->AltBody = "Informacion de Brett TV";
$mail->MsgHTML($mensaje);

$mail->AddAddress($destinatario, "Destinatario");
$mail->IsHTML(true);


if(!$mail->Send()) {
  echo "Error: " . $mail->ErrorInfo;
} else {
  echo "Mensaje enviado.";
}*/
	
}

function DateToQuotedMySQLDate($Fecha) 
{ 
$Parte1 = substr($Fecha, 0, 10);
$Parte2 = substr($Fecha, 10, 18);

if ($Parte1<>""){ 
   $trozos=explode("/",$Parte1,3); 
   return $trozos[2]."-".$trozos[1]."-".$trozos[0].$Parte2; } 
else 
   {return "NULL";} 
} 

function MySQLDateToDateHORA($MySQLFecha) 
{ 
if (($MySQLFecha == "") or ($MySQLFecha == "0000-00-00") ) 
    {return "";} 
else 
    {return date("H:i",strtotime($MySQLFecha));} 
} 

function MySQLDateToDateDIA($MySQLFecha) 
{ 
if (($MySQLFecha == "") or ($MySQLFecha == "0000-00-00") ) 
    {return "";} 
else 
    {return date("d/m/Y",strtotime($MySQLFecha));} 
}
?>