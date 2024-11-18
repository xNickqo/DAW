<HTML>
	<HEAD> 
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">

		<title>JUEGO DADOS - PRÁCTICA OBLIGATORIA</title>
		
		<link rel="stylesheet" href="./bootstrap.min.css">
	</HEAD>

<BODY>
	<form name='juegodados' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method='POST'>
		<div class="container ">
			<div class="card border-success mb-3" style="max-width: 30rem;">
				<div class="card-header"><B>JUEGO DADOS</B> </div>
					<div class="card-body">
						<B>Numero Dados: </B><input type='text' name='numdados' value='' size=5><br><br>

						<B>Pulsa para Tirar Dados: </B>
						<div>
							<input type="submit" value="Tirar Dados" name="tirar" class="btn btn-warning disabled">
						</div>
						<br>
						<div>
							<a name="almacenarJugadores" href="capturaDatos.php">¡Añade mas jugadores aqui!</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>

	<div>
		<?php
			include "functions.php";

			if($_SERVER['REQUEST_METHOD'] == 'POST')
			{
				$numDados = $_POST['numdados'];

				$jugs = obtenerJugadores();

				//Mientras el numero de dados sea menos que 10
				if($numDados > 0 && $numDados <= 10)
				{

					echo "<h2>Resultados de los lanzamientos</h2>";

					//Introducir los valores de los dados en el array por cada jugador
					foreach($jugs as $nombre => &$jug)
					{
						echo "<table border='1'><tr><td> $nombre </td>";

						for($i = 0; $i < $jug['num_dados']; $i++)
						{
							$num = rand(1, 6);
							imprimirDados($num);
							$jug['res'][$i] = $num;
							$jug['puntos'] += $num;
						}
						
						if($jug['num_dados'] > 1)
							checker($jug);

						echo "</tr></table>";
						echo ("$nombre tiene un total de <b>{$jug['puntos']}</b> puntos<br><br>");
					}
					//var_dump($jugs);
					mostrarGanador($jugs);
				}
				else
				{
					trigger_error("Error en el numero de dados", E_USER_ERROR);
				}
			}
		?>
	</div>

</BODY>
</HTML>