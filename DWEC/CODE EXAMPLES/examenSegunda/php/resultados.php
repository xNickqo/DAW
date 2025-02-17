<?php
	$dato=fopen('php://input','r');
    $valor=fgets($dato);
	$muestra=simplexml_load_string($valor);
	$nomequipo=$muestra->resultado[0]->equipo;
    $tempo=$muestra->resultado[0]->temporada;
	$tablaequipos = array("at-madrid", "ath-bilbao", "barcelona", "real-madrid","sevilla","valencia");
	$tablatemporadas= array("2015_16","2016_17","2017_18","2018_19");
	$indiceequipo=array_search($nomequipo,$tablaequipos);
	$indicetemporada=array_search($tempo,$tablatemporadas);
	$todosvalores=array(array(array(3,88,28,6,4,63,18),array(3,78,23,6,9,70,27),array(2,79,23,5,10,58,22),array(2,76,22,6,10,55,29)),
	                    array(array(5,62,18,12,8,58,45),array(7,63,19,13,6,53,43),array(16,43,10,15,13,41,49),array(8,53,13,11,14,41,45)),
						array(array(1,91,29,5,4,112,29),array(2,90,28,4,6,116,37),array(1,93,28,1,9,99,29),array(1,87,26,3,9,90,36)),
						array(array(2,90,28,4,6,110,34),array(1,93,29,3,6,106,41),array(3,76,22,6,10,94,44),array(3,68,21,12,5,63,46)),
						array(array(7,52,14,14,10,51,50),array(4,72,21,8,9,69,49),array(7,58,17,14,7,49,58),array(6,59,17,13,8,62,47)),
						array(array(12,44,11,16,11,46,48),array(12,46,13,18,7,56,65),array(4,73,22,9,7,65,38),array(4,61,15,7,7,51,35)));
	$puesto=$todosvalores[$indiceequipo][$indicetemporada][0];
	$puntos=$todosvalores[$indiceequipo][$indicetemporada][1];
	$ganados=$todosvalores[$indiceequipo][$indicetemporada][2];
	$perdidos=$todosvalores[$indiceequipo][$indicetemporada][3];
	$empatados=$todosvalores[$indiceequipo][$indicetemporada][4];
	$favor=$todosvalores[$indiceequipo][$indicetemporada][5];
	$contra=$todosvalores[$indiceequipo][$indicetemporada][6];
    header('Content-Type:text/xml');
	$uno='<datos><resultado><equipo>'.$nomequipo.'</equipo><temporada>'.$tempo.'</temporada><puesto>'.$puesto.'</puesto><puntos>'.$puntos.'</puntos>';
	$dos='<ganados>'.$ganados.'</ganados><perdidos>'.$perdidos.'</perdidos><empatados>'.$empatados.'</empatados><favor>'.$favor.'</favor>';
	$tres='<contra>'.$contra.'</contra></resultado></datos>';
	$final=$uno.$dos.$tres;
	//var_dump($final);
    echo $final;
?>
