<?php

echo "<h1> 4-Tratamiento de Errores completo </h1>";


// Definicion funcion error_function
function errores ($error_level,$error_message)
{
  echo "<b> TRANQUILO!! Codigo error: </b> $error_level  - <b> Mensaje: $error_message </b><br>";
  echo "Finalizando script <br>";
  die();  

}


// Establecemos la funcion que va a tratar los errores
set_error_handler("errores");
#set_error_handler("errores",E_USER_WARNING);	
#set_error_handler("errores",E_USER_ERROR);	


$variable=2;
if ($variable>=1) {
  trigger_error("El valor de la variable debe ser inferior a 1");
  #trigger_error("El valor de la variable debe ser inferior a 1",E_USER_WARNING);
  #trigger_error("El valor de la variable debe ser inferior a 1",E_USER_ERROR);
}

?> 

 