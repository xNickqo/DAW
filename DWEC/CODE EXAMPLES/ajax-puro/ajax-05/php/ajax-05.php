<?php
	$entrada=fopen('php://input','r');
	$datos=fgets($entrada);
	$valores=json_decode($datos,true);
	
	$nom=$valores['nombre'];
	$ape=$valores['apellidos'];
	$sueldo=rand(1050,9536);
	
	$respuesta=new stdClass();
	$respuesta->nombre=$nom;
	$respuesta->apellidos=$ape;
	$respuesta->sueldo=$sueldo;
	
	$envio=json_encode($respuesta);
	
	echo $envio;
?>