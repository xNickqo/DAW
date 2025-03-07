<?php
/* Funcion para la gestion de errores */
function error($errno, $errstr, $errfile, $errline) {
	echo "<b>Codigo del error [$errno]:</b> $errstr 
		en la línea <b>$errline</b> 
		en el archivo <b>$errfile</b>.<br>";
	
	// Si es un error crítico (E_ERROR, E_USER_ERROR), detener ejecución
    if ($errno == E_ERROR || $errno == E_USER_ERROR) {
        die();
    }
	
}

set_error_handler("error");

?>