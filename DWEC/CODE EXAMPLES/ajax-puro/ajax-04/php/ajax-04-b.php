<?php
	$entrada=fopen('php://input','r');
	$datos=fgets($entrada);
	$valores=simplexml_load_string($datos);
	
	$tra=$valores->empleado[0]->trabajador;
	$apuntes=$tra->attributes();
	$nom=$apuntes["nombre"];
	$ape=$apuntes["apellidos"];
	$sueldo=rand(1050,9536);
	
	$respuesta="<fabrica><empleado><trabajador nombre='".$nom."' apellidos='".$ape.
				"' sueldo='".$sueldo."' /></empleado></fabrica>";
							
	header("Content-type:text/xml");
	
	echo $respuesta;
?>