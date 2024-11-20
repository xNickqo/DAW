<?php
function errores($errno, $errstr, $errfile, $errline)
{
	echo "<b>Error [$errno]:</b> $errstr 
			en la línea <b>$errline</b> 
			en el archivo <b>$errfile</b>.<br>";

	die();
}
set_error_handler("errores");


function recogerDatos()
{
	$nombre = $_POST['nombre'];
	$apellido= $_POST['apellido'];
	$email= $_POST['email'];

	return $nombre . "#" . $apellido . "#" . $email . "\n";
}


/* Funcion que almacena los jugadores en un array multidimensional y le asigna 
	el numero de dados.

			jugs = array('num_dados', 'res' = array(), 'puntos') 
	
	--->Devuelve un array con el nombre del jugador asociado a un numero de dados*/
function obtenerJugadores()
{
	$jugs = array();
	$file = file("fichero.txt");
	$numDados = $_POST['numdados'];

	$i = 0;
	while($i < count($file))
	{
		$linea = explode("#", $file[$i]);

		$jugs[$linea[0]] = array(
									'num_dados' => $numDados,
									'res' => array(),
									'puntos' => 0
								);
		$i++;
	}

	//Si el numero de jugadores en menor que 2, ERROR
	if (count($jugs) < 2)
		trigger_error("Debe haber minimo 2 jugadores", E_USER_ERROR);

	return $jugs;
}



/* Imprime una imagen del numero que sale en el dado */
function imprimirDados($num)
{
	echo "<td><img src='images/$num.PNG'></td>";
}



/* Verifica si todos los dados de un jugador son iguales, en el caso 
	de ser todos iguales, la puntuacion del jugador sera 100 puntos 
	
	--->Almacena el numero de puntos*/
function checker(&$jug)
{
	$num_check = $jug['res'][0];
	$count = 0;

	for($j = 0; $j < count($jug['res']); $j++)
	{
		if($num_check == $jug['res'][$j])
		$count++;
	}

	if($count == count($jug['res']))
		$jug['puntos'] = 100;
}



/* Esta funcion consiste en mostrar el ganador, teniendo en cuenta el empate 
	
--->Devolvera un 'echo' imprimiendo el ganador/es*/
function mostrarGanador($jugs)
{
	$puntosMax = 0;
	$ganadores = array();

	//Recorremos el array y encontramos la puntuación máxima
	foreach ($jugs as $nombre => $jug)
	{
		if ($jug['puntos'] > $puntosMax)
			$puntosMax = $jug['puntos'];
	}
	
	//Encontrar todos los jugadores con la puntuación máxima
	foreach ($jugs as $nombre => $jug)
	{
		if ($jug['puntos'] == $puntosMax)
			$ganadores[] = $nombre;
	}

	// Mostrar el resultado según haya empate o no
	if (count($ganadores) > 1)
	{
		echo "<h2>Hay un empate con $puntosMax puntos entre los siguientes jugadores:</h2>";
		foreach ($ganadores as $ganador) {
			echo "$ganador<br>";
		}
	}
	else
	{
		echo "<h2>¡El ganador es {$ganadores[0]} con $puntosMax puntos!</h2>";
	}
}
?>