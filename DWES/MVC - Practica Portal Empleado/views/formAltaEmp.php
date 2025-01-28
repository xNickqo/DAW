<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Alta de empleados</title>
</head>
<body>
	<h1>Alta de empleado</h1>
	<form action="" method="post" id="">
		<label for="name">Nombre (first_name): </label>
			<input type="text" name="name" id="name"><br>
		<label for="apellido">Apellido (last_name): </label>
			<input type="text" name="apellido" id="apellido"><br>
		<label>
			<input type="radio" name="genero" value="M"> M
		</label><br>
		<label>
			<input type="radio" name="genero" value="F"> F
		</label><br>
		
		<label for="fechaNac">Fecha de nacimiento (birth_date): </label>
			<input type="date" name="fechaNac" id="fechaNac"><br><br>

		
		<label for="dpt">Departamento (dept_name): </label>
			<select name="dpt" id="dpt">
				<?php
					foreach ($departments as $dpt){
						echo "<option value='" . $dpt['dept_no'] . "'>" . $dpt['dept_name'] ."</option>";
					}
				?>
			</select><br>

		<label for="salario">Salario (salary): </label>
			<input type="text" name="salario" id="salario"><br>

		<label for="cargo">Cargo a desempeñar (title): </label>
			<input type="text" name="cargo" id="cargo"><br><br>

			<?php
				if(isset($mensaje))
					echo $mensaje;
			?>

			<br>

		<input type="submit" name="alta" value="Dar de alta">
	</form>

	<a href="../controllers/logout.php">Cerrar sesion</a><br>
	<a href="../controllers/inicio.php">Volver al inicio</a>
</body>
</html>
