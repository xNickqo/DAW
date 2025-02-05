<?php

/* Funcion para la gestion de errores */
function errores($errno, $errstr, $errfile, $errline) {
	
	echo "<b>Codigo del error [$errno]:</b> $errstr 
		en la línea <b>$errline</b> 
		en el archivo <b>$errfile</b>.<br>";
	
	die();
}
set_error_handler("errores");

/* Funcion que almacena los jugadores en un array multidimensional y le asigna 
	el numero de dados.

			jugs = array('num_dados', 'res' = array(), 'puntos') 
	
	--->Devuelve un array con el nombre del jugador asociado a un numero de dados*/
function obtenerJugadores() {
	$jugadores = array();
	$numDados = $_POST['numdados'];
	$jugadoresInput = ['jug1', 'jug2', 'jug3', 'jug4'];

	//Introduce los input $_POST dentro del array jugs[]
	foreach ($jugadoresInput as $jug) {
		//Si el input no esta vacio, introducelos en el array
		if(!empty($_POST[$jug])) {
			$jugadores[$_POST[$jug]] = array(
												'num_dados' => $numDados,
												'res' => array(),
												'puntos' => 0
											);
		}
	}
	//Si el numero de jugadores en menor que 2, ERROR
	if (count($jugadores) < 2)
		trigger_error("Debe haber minimo 2 jugadores", E_USER_ERROR);

	var_dump($jugadores);
	return $jugadores;
}


/* Imprime una imagen del numero que sale en el dado */
function imprimirDados($num) {
	echo "<td><img src='images/$num.PNG'></td>";
}


/* Verifica si todos los dados de un jugador son iguales, en el caso 
	de ser todos iguales, la puntuacion del jugador sera 100 puntos 
	
	--->Almacena el numero de puntos*/
function checker(&$jug) {
	$num_check = $jug['res'][0];
	$count = 0;

	for($j = 0; $j < count($jug['res']); $j++) {
		if($num_check == $jug['res'][$j])
		$count++;
	}

	if($count == count($jug['res']))
		$jug['puntos'] = 100;
}


/* Esta funcion consiste en mostrar el ganador, teniendo en cuenta el empate 
	
--->Devolvera un 'echo' imprimiendo el ganador/es*/
function mostrarGanador($jugadores) {
	$puntosMax = 0;
	$ganadores = array();

	//Recorremos el array y encontramos la puntuación máxima
	foreach ($jugadores as $nombre => $jug) {
		if ($jug['puntos'] > $puntosMax)
			$puntosMax = $jug['puntos'];
	}
	
	//Encontrar todos los jugadores con la puntuación máxima
	foreach ($jugadores as $nombre => $jug) {
		if ($jug['puntos'] == $puntosMax)
			$ganadores[] = $nombre;
	}

	// Mostrar el resultado según haya empate o no
	if (count($ganadores) > 1) {
		echo "<h2>Hay un empate con $puntosMax puntos entre los siguientes jugadores:</h2>";
		foreach ($ganadores as $ganador) {
			echo "$ganador<br>";
		}
	} else {
		echo "<h2>¡El ganador es {$ganadores[0]} con $puntosMax puntos!</h2>";
	}
}
?>