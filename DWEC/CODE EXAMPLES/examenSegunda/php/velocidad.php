<?php
    $entrada=fopen('php://input','r');
    $dato=fgets($entrada);
    $valor=simplexml_load_string($dato);
	$resultado="<resultado>";
	for($i=0;$i<count($valor->vehiculos);$i++){
		$coch=$valor->vehiculos[$i]->coche;
		$vel=$valor->vehiculos[$i]->velocidad;
		$acel=$valor->vehiculos[$i]->aceleracion;
		$tiep=$valor->vehiculos[$i]->tiempo;
		$vfinal=$vel + ($acel * $tiep);
		$resultado=$resultado."<vehiculos><coche>".$coch."</coche><velocidad>".$vel."</velocidad><aceleracion>".$acel.
								"</aceleracion><tiempo>".$tiep."</tiempo><velfinal>".$vfinal."</velfinal></vehiculos>";
	}
	$resultado=$resultado."</resultado>";
	header('Content-Type:text/xml');
    echo $resultado;
?>
