<?php

// se incluye el archivo de configuración
require_once "conexs/config.php";

// Definir variables e inicializar con valores vacíos
$nombre = $username = $correo = $password = $confirm_password = "";
$nombre_err = $username_err = $correo_err = $password_err = $confirm_password_err = "";

// Procesamiento de datos del formulario cuando se envía el formulario
if($_SERVER["REQUEST_METHOD"] == "POST"){

// Validar el nombre de usuario
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor ingrese un usuario.";
    } else{

// Preparar la consulta
        $sql = "SELECT id FROM users WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){

// Vincular variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "s", $param_username);

// asignar parámetros
            $param_username = trim($_POST["username"]);

// Intentar ejecutar la declaración preparada
            if(mysqli_stmt_execute($stmt)){

/* almacenar resultado*/
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 1){
            $username_err = "Este usuario ya esta en uso.";
     } else{
            $username = trim($_POST["username"]);
                }
            } else{
                echo "Al parecer algo salió mal.";
            }
        }

        // Validar el correo electronico
    if(empty(trim($_POST["correo"]))){
        $correo_err = "Por favor ingrese un correo.";
    } else{
    
// Preparar la consulta
        $sql = "SELECT id FROM users WHERE correo = ?";
        if($stmt = mysqli_prepare($link, $sql)){

// Vincular variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "s", $param_correo);

// asignar parámetros
            $param_correo = trim($_POST["correo"]);

// Intentar ejecutar la declaración preparada
            if(mysqli_stmt_execute($stmt)){

/* almacenar resultado*/
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 1){
            $correo_err = "Este correo ya esta registrado.";
     } else{
            $correo = trim($_POST["correo"]);
                }
            } else{
                echo "Al parecer algo salió mal.";
            }
        }

// Declaración de cierre
        mysqli_stmt_close($stmt);
    }

// Validar contraseña
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor ingresa una contraseña.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "La contraseña debe tener al menos 6 caracteres.";
    } else{
        $password = trim($_POST["password"]);
    }
    
// Validar que se confirma la contraseña
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Confirma tu contraseña.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "No coincide la contraseña.";
        }
    }
    
// Verifique los errores de entrada antes de insertar en la base de datos
    if(empty($nombre_err) && empty($username_err) && empty($correo_err) && empty($password_err) && empty($confirm_password_err)){
        
// Prepare una declaración de inserción
        $sql = "INSERT INTO users (nombre, username, correo, password) VALUES (?, ?, ?, ?)";
        if($stmt = mysqli_prepare($link, $sql)){

// Vincular variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "ssss", $param_nombre, $param_username, $param_correo, $param_password);
            
// Establecer parámetros
            $param_nombre = $nombre;
            $param_username = $username;
            $param_correo = $correo;
			      $param_password = password_hash($password, PASSWORD_DEFAULT); // Crear una contraseña hash

// Intentar ejecutar la declaración preparada
            if(mysqli_stmt_execute($stmt)){
              echo "Usuario Registrado Correctamente.";

// Redirigir a la página de inicio de sesión (login.php)
                header("location: login.php");
            } else{
                echo "Algo salió mal, por favor inténtalo de nuevo.";
            }
        }
         
// declaración de cierre
        mysqli_stmt_close($stmt);
    }
    
// Cerrar la conexión
    mysqli_close($link);
}
} 

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Layout de Sitio Web con CSS GRID</title>
	<?php include("includes/header.php"); ?>
	</head>
<body>
	<div class="contenedor">
		<header class="header">
			<?php include("includes/cabecera.php"); ?>
		</header>
		<div class="contenido">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <h1 align="center">Registro de Usuarios</h1>    
      <table align="center">
        <tr valign="baseline"><br><br>
          <td nowrap="nowrap" align="right">Nombre Completo:</td>
          <td>
          <input type="text" class="campo" name="nombre" id="strNombre" value="<?php echo $username; ?>">
          <span id="diverrores"><?php echo $nombre_err; ?></span>
        </td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Usuario:</td>
          <td>
            <input type="text" class="campo" name="username" id="strUsername">
          <span id="diverrores"><?php echo $username_err; ?></span>
        </td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Correo Electrónico:</td>
          <td>
            <input type="email" class="campo" name="correo" id="strCorreo">
          <span id="diverrores"><?php echo $correo_err; ?></span>
          </td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Contraseña:</td>
          <td>
            <input type="password" class="campo" name="password" id="strPassword">
          <span id="diverrores"><?php echo $password_err; ?></span>
          </td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Confirmar Contraseña:</td>
          <td>
            <input type="password" class="campo" name="confirm_password" id="strPassword" value="<?php echo $confirm_password; ?>">
          <span id="diverrores"><?php echo $confirm_password_err; ?></span>
        </td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td><br><input type="submit" class="boton" value="REGISTRARME" id="botoninsertar" />
          <input type="reset" class="bor" value="Borrar"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right"></td>
          <td><br><p>Ya Tienes Cuenta?</p><a href="login.php"><input type="button"  class="boton" value="Inicia Sesión Ahora!"></a></td>
          </tr>
        </table>
      <input type="hidden" name="MM_insert" value="form1" />
      
  </form>
		</div>
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