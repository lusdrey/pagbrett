<?php

// Inicializa la sesión
session_start();

/* Verifique si el usuario ya ha iniciado sesión, si es así, 
rediríjalo a la página de bienvenida (index.php)*/
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: index.php");
  exit;
}

// Incluir el archivo de configuración
require_once "conexs/config.php";
 
// Definir variables e inicializar con valores vacíos
$username = $password = $username_err = $password_err = "";

// Procesamiento de datos del formulario cuando se envía el formulario
if($_SERVER["REQUEST_METHOD"] == "POST"){

// Comprobar si el nombre de usuario está vacío
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor ingrese su usuario.";
    } else{
        $username = trim($_POST["username"]);
    }

// Comprobar si la contraseña está vacía
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor ingrese su contraseña.";
    } else{
        $password = trim($_POST["password"]);
    }

// Validar información del usuario
    if(empty($username_err) && empty($password_err)){

// Preparar la consulta select
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
/* Vincular variables a la declaración preparada como parámetros, s es por la
variable de tipo string*/
            mysqli_stmt_bind_param($stmt, "s", $param_username);

// Asignar parámetros
            $param_username = $username;

// Intentar ejecutar la declaración preparada
      if(mysqli_stmt_execute($stmt)){

// almacenar el resultado de la consulta
      mysqli_stmt_store_result($stmt);

/*Verificar si existe el nombre de usuario, si es así,
verificar la contraseña*/
      if(mysqli_stmt_num_rows($stmt) == 1){                    

// Vincular las variables del resultado
      mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);

//obtener los valores de la consulta
      if(mysqli_stmt_fetch($stmt)){

/*comprueba que la contraseña ingresada sea igual a la 
almacenada con hash*/
      if(password_verify($password, $hashed_password)){

// La contraseña es correcta, así que se inicia una nueva sesión
      session_start();

// se almacenan los datos en las variables de la sesión
      $_SESSION["loggedin"] = true;
      $_SESSION["id"] = $id;
      $_SESSION["username"] = $username;                            

// Redirigir al usuario a la página de inicio
      header("location: home.php");
      } else{

// Mostrar un mensaje de error si la contraseña no es válida
     $password_err = "La contraseña que ha ingresado no es válida.";
                        }
                    }
                } else{

// Mostrar un mensaje de error si el nombre de usuario no existe
       $username_err = "No existe cuenta registrada con ese nombre de usuario.";
                }
            } else{
                echo "Algo salió mal, por favor vuelve a intentarlo.";
            }
        }

// Cerrar la sentencia de consulta
        mysqli_stmt_close($stmt);
    }

// Cerrar laconexión
    mysqli_close($link);
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
  <link href="css/principal.css" rel="stylesheet" type="text/css">
  <link href="css/footer.css" rel="stylesheet" type="text/css">
  <?php include("includes/header.php"); ?>
	</head>
<body>
	<div class="contenedor">
		<header class="header">
			<?php include("includes/cabecera.php"); ?>
		</header>
		<div class="contenido">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h1 align="center">Inicio de sesión</h1><br><br>
        <table align="center">
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Nombre:</td>
          <td>
          <input type="text" class="campo" name="username" id="strNombre" value="<?php echo $username; ?>">
          </td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Contraseña:</td>
          <td>
            <input type="password" class="campo" name="password" id="strPassword">
          </td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td><br><br><input type="submit" class="boton" value="INGRESAR" id="botoninsertar" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right"><br></td>
          <td><br><p>¿No tienes una cuenta?</p><a href="register.php"><input type="button"  class="boton" value="Registrate Ahora!"></a></td>
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