<?php
echo "Inicio modelo"."<br>";

// Modelo contiene la lógica de la aplicación: clases y métodos que se comunican
// con la Base de Datos

// Función muestra las peliculas
function getPeliculas($db) {
	$peliculas = [];
	$sql = "select * from film";

	$resultado = mysqli_query($db, $sql);
	while ($row = mysqli_fetch_assoc($resultado)) {
		$peliculas[] = $row;
	}
	
	return $peliculas;
}

echo "Fin modelo"."<br>";
?>