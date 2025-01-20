<?php
	$entrada=fopen('php://input','r');
	$datos=fgets($entrada);
	$valores=simplexml_load_string($datos);
	
	$respuesta="<fabrica>";
	
	$apuntes=$valores->empleado;
	for ($i=0; $i < count($apuntes); $i++){
		$nom=$apuntes[$i]->nombre;
		$ape=$apuntes[$i]->apellidos;
		$sueldo=rand(1050,9536);
		$respuesta=$respuesta."<empleado><nombre>".$nom."</nombre><apellidos>".$ape.
				"</apellidos><sueldo>".$sueldo."</sueldo></empleado>";
	}
	
	$respuesta=$respuesta."</fabrica>";
	
	header("Content-type:text/xml");
	
	echo $respuesta;
?>
