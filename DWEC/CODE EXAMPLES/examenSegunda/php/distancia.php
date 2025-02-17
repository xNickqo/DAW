<?php
    $entrada=fopen('php://input','r');
    $datos= fgets($entrada);
    $valores= json_decode($datos,true);
	
	$salida=array();
	for($i=0;$i<count($valores);$i++){
		$dist=$valores[$i]["velocidad"] * $valores[$i]["tiempo"] +  ((1/2) * $valores[$i]["aceleracion"] * pow($valores[$i]["tiempo"],2));
		$nuevo=new stdClass();
		$nuevo->moto=$valores[$i]["moto"];
		$nuevo->velocidad=$valores[$i]["velocidad"];
		$nuevo->aceleracion=$valores[$i]["aceleracion"];
		$nuevo->tiempo=$valores[$i]["tiempo"];
		$nuevo->distancia=$dist;
		$salida[$i]=$nuevo;
	}
	$respuesta=json_encode($salida);
    echo$respuesta;
?>
