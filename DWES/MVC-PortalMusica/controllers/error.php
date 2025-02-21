<?php
/* Funcion para la gestion de errores */
function error($errno, $errstr, $errfile, $errline) {

	// Si es un error crítico (E_ERROR, E_USER_ERROR), detener ejecución
    if ($errno == E_ERROR || $errno == E_USER_ERROR) {
		echo "<b>Codigo del error [$errno]:</b> $errstr 
				en la línea <b>$errline</b> 
				en el archivo <b>$errfile</b>.<br>";
        die();
    } else {
		echo $errstr;
	}
	
}
set_error_handler("error");

?>