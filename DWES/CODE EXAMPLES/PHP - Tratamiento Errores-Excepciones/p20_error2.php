<?php
echo "<h1> 2- Tratamiento de Errores: errores customizados por el usuario </h1>";

echo "<br> Para ello vamos a definir una funci&oacuten que gestione los errores";
echo "<br> Podemos definir una funci&oacuten <b> errores (error_level,error_message)</b> ";

echo "<br> Parametro <b>error_level</b>   asignamos un codigo a nuestro error ";
echo "<br> Parametro <b>error_message</b> asignamos un mensaje a nuestro error ";

echo "<br><br><br> La funci&oacuten <b>set_error_handler</b>   permite manejar los errores <br>";


// Definicion funcion error_function
function errores ($error_level,$error_message)
{
  echo "<b> TRANQUILO!! Codigo error: </b> $error_level  - <b> Mensaje: $error_message </b><br>";

}

// Establecemos la funcion que va a tratar los errores
set_error_handler("errores");

// Provocamos un error
echo $file;

//Otro error
//$file=fopen("hola.txt","r");



?> 



 