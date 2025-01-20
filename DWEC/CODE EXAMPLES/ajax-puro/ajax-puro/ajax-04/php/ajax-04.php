<?php
	$entrada=fopen('php://input','r');
	$datos=fgets($entrada);
	$valores=simplexml_load_string($datos);
	
	$nom=$valores->empleado[0]->nombre;
	$ape=$valores->empleado[0]->apellidos;
	$sueldo=rand(1050,9536);
	
	$respuesta="<fabrica><empleado><nombre>".$nom."</nombre><apellidos>".$ape.
				"</apellidos><sueldo>".$sueldo."</sueldo></empleado></fabrica>";
	header("Content-type:text/xml");
	
	echo $respuesta;
?>