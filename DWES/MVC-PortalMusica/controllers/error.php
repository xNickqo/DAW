<?php
/* Funcion para la gestion de errores */
function error($errno, $errstr, $errfile, $errline) {
	
	echo "<b>Codigo del error [$errno]:</b> $errstr 
		en la línea <b>$errline</b> 
		en el archivo <b>$errfile</b>.<br>";
	
	die();
}
set_error_handler("error");

?>