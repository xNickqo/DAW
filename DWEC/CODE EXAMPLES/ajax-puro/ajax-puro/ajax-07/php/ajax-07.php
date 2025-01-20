<?php
	$entrada=fopen('php://input','r');
	$datos=fgets($entrada);
	$valores=json_decode($datos,true);
	
	$devuelve=array();
	
	for ($i=0; $i < count($valores); $i++){
		$apuntes=$valores[$i];
		$nom=$apuntes['nombre'];
		$ape=$apuntes['apellidos'];
		$sueldo=rand(1050,9536);
		$respuesta=new stdClass();
		$respuesta->nombre=$nom;
		$respuesta->apellidos=$ape;
		$respuesta->sueldo=$sueldo;
		$devuelve[$i]=$respuesta;
	}
	
	$envio=json_encode($devuelve);
	echo $envio;
?>
