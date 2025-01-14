<html>
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Bienvenido a MovilMAD</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
 </head>

 <body>
    <h1>Servicio de ALQUILER DE E-CARS</h1> 

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú Usuario - ALQUILAR VEHÍCULOS</div>
		<div class="card-body">
	  	  
	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
	
		<B>Bienvenido/a:</B> <?php echo $_SESSION['usuario']['email']?> <BR><BR>

		<B>Identificador Cliente:</B> <?php echo $_SESSION['usuario']['idcliente']?>  <BR><BR>
		
		<B>Vehiculos disponibles en este momento:</B> <?php echo date('Y-m-d H:i:s')?> <BR><BR>
		
			<B>Matricula/Marca/Modelo: </B>
			<select name="vehiculos" class="form-control">
				<?php
					include_once "db/conexionBBDD.php";
					$conn = conexionBBDD();

					include_once "models/obtenerVehiculosDisponibles.php";
					$resultado = obtenerVehiculosDisponibles($conn);

					if(count($resultado) > 0) {
						foreach ($resultado as $vehiculo){
							echo "<option value='" . $vehiculo['matricula'] . "'>" . $vehiculo['matricula'] . " " . $vehiculo['marca'] . " " . $vehiculo['modelo'] . "</option>";
						}
					} else {
						$mensaje = "No hay vehiculos disponibles";
					}
				?>
			</select>

			<BR><BR>

			<?php 
				if (isset($mensaje)) {
					echo "<p style='color: red'>" . $mensaje . "</p>";
				}
			?>

			<BR><BR>

			<?php
				foreach($_SESSION['carrito'] as $v){
					echo $v . "<br>";
				}
			?>

		<BR><BR><BR><BR><BR><BR>
		<div>
			<input type="submit" value="Agregar a Cesta" name="agregar" class="btn btn-warning disabled">
			<input type="submit" value="Realizar Alquiler" name="alquilar" class="btn btn-warning disabled">
			<input type="submit" value="Vaciar Cesta" name="vaciar" class="btn btn-warning disabled">
		</div>		
	</form>
  </body>
</html>
