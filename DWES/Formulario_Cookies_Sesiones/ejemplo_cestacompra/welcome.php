<?php 
   include('config.php');
   session_start();
   
   // Array que contiene una lista con los nombres de los productos para el select (desplegable)
   $peliculas = listapeliculas($db);
   
   
if (isset($_POST) && !empty($_POST)) 
{
  // AGREGAR A LA CESTA DE LA COMPRA
	if (isset($_POST['agregar']) && !empty($_POST['agregar'])) {
	  
	    if (!isset($_SESSION['$cesta'])) 
		   $_SESSION['$cesta']=array(array($_POST['pelicula'],$_POST['cantidad']));
		   
	    else
	       array_push($_SESSION['$cesta'],array($_POST['pelicula'],$_POST['cantidad']));
		   	
	}
	

var_dump($_SESSION['$cesta']);
}


  
   
?>

<html>
   
   <head>
      <title>Welcome </title>
   </head>
   
   <body>
		<h1>Bienvenido <?php echo $_SESSION['login_user']; ?></h1> 
		<!-- INICIO DEL FORMULARIO -->
	<form action="welcome.php" method="post">
		<h1>Peliculas:</h1>
		<div>
			<select name="pelicula">
				<?php forEach ($peliculas as $pelicula) : ?>
					<?php echo '<option>'. $pelicula['title'] . '</option>'; ?>
				<?php endforEach; ?>
			</select>
			<label for="cantidad1">Cantidad:</label>
			<input type="number" name="cantidad">
		</div>
		
		<div>
			<input type="submit" value="Comprar Pelicula" name="comprar">
			<input type="submit" value="Agregar a la Cesta" name="agregar">
			<input type="submit" value="Limpiar la Cesta" name="limpiar">
		</div>		
	</form>
	<!-- FIN DEL FORMULARIO -->
   </body>
   
</html>


<?php
function listapeliculas($db) {
	$peliculas = [];
	/*Extraigo todos los nombres de peliculas:*/
	$resultado = mysqli_query($db, "SELECT title FROM film");
	while ($fila = mysqli_fetch_assoc($resultado)) {
		$peliculas[] = $fila;
	}
	return $peliculas;
}
