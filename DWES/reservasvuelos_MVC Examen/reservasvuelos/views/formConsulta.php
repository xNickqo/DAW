<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>RESERVAS VUELOS</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
 </head>
   
 <body>
   

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Consultar Reservas</div>
		<div class="card-body">
	  	  

	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
	
		<B>Email Cliente:</B>  <?php echo $_SESSION['usuario']['email']; ?>  <BR>
		<B>Nombre Cliente:</B>  <?php echo $_SESSION['usuario']['nombre']." ".$_SESSION['usuario']['apellidos']; ?>  <BR>
		<B>Fecha:</B>  <?php echo $_SESSION['usuario']['fecha_nacimiento']; ?>  <BR><BR>
		
		<B>Numero Reserva</B>
		<select name="reserva" class="form-control">
			<?php
				foreach($res as $id){
					echo "<option value=". $id['id_reserva'] .">".$id['id_reserva']."</option>";
				}
			?>
		</select>	


		<BR><BR><BR>


		<?php if(!empty($consultas)){ ?>
		<table border=1>
			<thead>
				<th>Aerolinea</th>
				<th>origen</th>
				<th>destino</th>
				<th>salida</th>
				<th>llegada</th>
				<th>asientos</th>
			</thead>
			<tbody>
				<?php
						foreach($consultas as $consulta){
							echo "<tr>";
								echo "<td>" . htmlspecialchars($consulta['id_aerolinea']) . "</td>";
								echo "<td>" . htmlspecialchars($consulta['origen']) . "</td>";
								echo "<td>" . htmlspecialchars($consulta['destino']) . "</td>";
								echo "<td>" . htmlspecialchars($consulta['fechahorasalida']) . "</td>";
								echo "<td>" . htmlspecialchars($consulta['fechahorallegada']) . "</td>";
								echo "<td>" . htmlspecialchars($consulta['num_asientos']) . "</td>";
							echo "</tr>";
						}
					}
				?>
			</tbody>
		</table>
		<BR><BR><BR>
		<div>
			<input type="submit" value="Consultar Reserva" name="consultar" class="btn btn-warning disabled">
			<input type="submit" value="Volver" name="volver" class="btn btn-warning disabled">
		</div>		
	</form>
	
	<!-- FIN DEL FORMULARIO -->
    <a href = "../controllers/logout.php">Cerrar Sesion</a>
  </body>
   
</html>
