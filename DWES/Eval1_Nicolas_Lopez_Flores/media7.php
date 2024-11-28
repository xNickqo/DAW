<?php
	/* Nombre Alumno: NICOLAS LOPEZ FLORES */
		
	include "media7func.php";

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$numCartas = $_POST['numcartas'];

		$jugadores = obtenerJugadores();

		$todasLasCartas = array();
		$contadorCartas = 0;

		//Mientras el numero de dados sea menos que 10
		if($numCartas >= 2 && $numCartas <= 10)
		{
			echo "<h2>Resultados de los lanzamientos</h2>";

			//Recorremos los jugadores 
			foreach($jugadores as $nombre => &$jugador)
			{
				echo "<table border='1'><tr><td> $nombre </td>";

				$jugador['cartas'] = array();

				//Recorremos las cartas por cada jugador
				for($i = 0; $i < $jugador['numcartas']; $i++)
				{
					$num = rand(1, 10);
					if($num == 8)
						$num = "S";
					if($num == 9)
						$num = "C";
					if($num == 10)
						$num = "R";

					$letra = rand(1, 4);
					if($letra == 1)
						$letra = "O";
					if($letra == 2)
						$letra = "E";
					if($letra == 3)
						$letra = "B";
					if($letra == 4)
						$letra = "C";
					
					$carta =  (string)$num.$letra;

					if(!in_array($carta, $todasLasCartas)) {
						array_push($todasLasCartas, $carta);

						//Cartas por jugador
						array_push($jugador['cartas'], $carta);
						imprimirCartas($num, $letra);

						if($num == "S" || $num == "C" || $num == "R")
							$jugador['puntos'] += 0.5;
						else
							$jugador['puntos'] += $num;
					}
					else
						$i--;
				}

				echo "</tr></table>";
				echo ("$nombre tiene un total de <b>{$jugador['puntos']}</b> puntos<br><br>");
			}
			//var_dump($todasLasCartas);
			//var_dump($jugadores);

			$ganadores = mostrarGanador($jugadores);

			darPremios($ganadores, $jugadores);
		}
		else
		{
			trigger_error("Error en el numero de cartas por jugador", E_USER_ERROR);
		}
	}
?>
				