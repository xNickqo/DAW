<?php
	$entrada=fopen('php://input','r');
	$datos=fgets($entrada);
	$valores=simplexml_load_string($datos);
	
	$respuesta="<fabrica>";
	
	$apuntes=$valores->empleado;
	for ($i=0; $i < count($apuntes); $i++){
		$tra=$apuntes[$i]->trabajador;
		$res=$tra->attributes();
		$nom=$res["nombre"];
		$ape=$res["apellidos"];
		$sueldo=rand(1050,9536);
		
		
		
		$respuesta=$respuesta."<empleado><trabajador nombre='".$nom."' apellidos='".$ape.
				"' sueldo='".$sueldo."' /></empleado>";
	}
	
	$respuesta=$respuesta."</fabrica>";
	
	header("Content-type:text/xml");
	
	echo $respuesta;
?>
