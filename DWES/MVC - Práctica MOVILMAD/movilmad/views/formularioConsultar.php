<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Bienvenido a MovilMAD</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
  </head>
   
 <body>
    <h1>Servicio de ALQUILER DE E-CARS</h1> 

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú Usuario - CONSULTA ALQUILERES </div>
		<div class="card-body">
	  
	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
		<B>Bienvenido/a:</B> <?php echo $_SESSION['usuario']['email']?>  <BR><BR>
		<B>Identificador Cliente:</B> <?php echo $_SESSION['usuario']['idcliente']?> <BR><BR>
		     
			 Fecha Desde: <input type='date' name='fechadesde' value='' size=10 placeholder="fechadesde" class="form-control">
			 Fecha Hasta: <input type='date' name='fechahasta' value='' size=10 placeholder="fechahasta" class="form-control"><br><br>
			
			 <?php
			 	if(isset($mensaje)){
					echo $mensaje;
				}
			 ?>

			 <table border="1">
				<?php
				if (isset($resultadoConsulta) && count($resultadoConsulta) > 0) {
					foreach ($resultadoConsulta as $vehiculo) {
						echo "<tr>
								<td>" . htmlspecialchars($vehiculo['matricula']) . "</td>
								<td>" . htmlspecialchars($vehiculo['marca']) . "</td>
								<td>" . htmlspecialchars($vehiculo['modelo']) . "</td>
								<td>" . htmlspecialchars($vehiculo['fecha_alquiler']) . "</td>
								<td>" . htmlspecialchars($vehiculo['fecha_devolucion']) . "</td>
								<td>" . number_format($vehiculo['preciototal'], 2) . " €</td>
							  </tr>";
					}
				}
				?>
			 </table>

			<br>

		<div>
			<input type="submit" value="Consultar" name="Consultar" class="btn btn-warning disabled">
			<input type="submit" value="Volver" name="Volver" class="btn btn-warning disabled">
		</div>		
	</form>
	<!-- FIN DEL FORMULARIO -->
    <a href = "logout.php">Cerrar Sesion</a>

  </body>
   
</html>
