<?php

echo "<h1> 3-Tratamiento de Errores: funcion trigger_error() </h1>";


/* Categorias de Error :

    E_USER_ERROR - Fatal user-generated run-time error. Errors that can not be recovered from. Execution of the script is halted
    E_USER_WARNING - Non-fatal user-generated run-time warning. Execution of the script is not halted
    E_USER_NOTICE - Default value
	
*/	


$variable=2;
if ($variable>=1) {
  trigger_error("El valor de la variable debe ser inferior a 1");
  #trigger_error("El valor de la variable debe ser inferior a 1",E_USER_WARNING);
  #trigger_error("El valor de la variable debe ser inferior a 1",E_USER_ERROR);
}

?> 

 