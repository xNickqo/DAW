<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// definición de variables de error
$nombreErr = $emailErr = $genderErr = $facebookErr = "";
// definición de variables para recuperar valor campos
$name = $email = $gender = $comment = $facebook = "";

/*Validaciones a realizar:
Campo  		Validación
Nombre 		Obligatorio. Solo puede contener letras y espcios en blanco
Email		Obligatorio. Comprobar es email válido (inlcuye @ y .)
Facebook 	Opcional. Contendrá una URL válida
Experiencia 	Opcional. Campo multilinea
Sexo 	Obligatorio. Debe seleccionar alguna de las opciones
*/
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nombreErr = "Nombre es obligatorio";
  } else {
    $name = limpiar_campos($_POST["name"]);
	// Comprueba solo letras y espacios
	if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nombreErr = "Solo se permiten letras y espacios en blanco";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email es obligatorio";
  } else {
    $email = limpiar_campos($_POST["email"]);
	// Comprueba email correcto
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
    
  if (empty($_POST["facebook"])) {
    $facebook = "";
  } else {
    $facebook = limpiar_campos($_POST["facebook"]);
	// comprueba la URL 
	 if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$facebook)) 
	 {
      $facebookErr = "URL no valida"; 
	  }
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = limpiar_campos($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Sexo es obligatorio";
  } else {
    $gender = limpiar_campos($_POST["gender"]);
  }
}

function limpiar_campos($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
/** Otras funciones utiles para validar:
 1. Tipos y null: empty(), is_bool(), is_string(), is_int(), is_float(), is_numeric() e is_null()
 2. Expresiones regulares: Para ello podemos usar expresiones regulares y funciones funciones como addslashes(), stripslashes(), htmlspecialchars(), htmlentities(), htmlspecialchars_decode() y html_entity_decode()
**/

<h2>PHP Formulario con validaci&oacuten de campos</h2>
<p><span class="error">* Campo Obligatorio</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Nombre: <input type="text" name="name">
  <span class="error">* <?php echo $nombreErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Facebook: <input type="text" name="facebook">
  <span class="error"><?php echo $facebookErr;?></span>
  <br><br>
  Comment: <textarea name="comment" rows="5" cols="40"></textarea>
  <br><br>
  Gender:
  <input type="radio" name="gender" value="Mujer">Mujer
  <input type="radio" name="gender" value="Hombre">Hombre
  <input type="radio" name="gender" value="other">Otro
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Validar">  
</form>

<?php
echo "<h2>Datos introducidos:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $facebook;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;
?>