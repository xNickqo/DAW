<HTML>
<HEAD> <TITLE> VALIDACIONES EN FORMULARIOS  </TITLE>
</HEAD>
<BODY>
<?php
//Función permite "limpiar campos" introducidos por los usuarios
function limpiar_campo($campoformulario) {
  $campoformulario = trim($campoformulario); //elimina espacios en blanco por izquierda/derecha
  $campoformulario = stripslashes($campoformulario); //elimina la barra de escape "\", utilizada para escapar caracteres
  $campoformulario = htmlspecialchars($campoformulario);  
  //convierte caracteres especiales a entidades HTML
  // Ciertos caracteres tienen significados especiales en HTML, y deben ser representados por entidades HTML 
  // si se desea preservar su significado
  //  &(ampersand) = &amp;
  //  " (double quote) = &quot;
  //  ' (single quote) = &#039;
  //  < menor que = &lt;

  return $campoformulario;
   
}

// definición variables para recoger datos formulario
$nombre = $email = $sexo = $experiencia = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre = limpiar_campo($_POST["nombre"]);
  $email = limpiar_campo($_POST["email"]);
  $sexo = limpiar_campo($_POST["sexo"]);
  $experiencia = limpiar_campo($_POST["experiencia"]);
}

?>


<?php
echo "<h2>Datos introducidos por alumno:</h2>";
echo "Nombre Alumno:".$nombre;
echo "<br>";
echo "Email Alumno:".$email;
echo "<br>";
echo "Sexo:".$sexo;
echo "<br>";
echo "Experiencia Profesional:".$experiencia;
echo "<br>";

?>


