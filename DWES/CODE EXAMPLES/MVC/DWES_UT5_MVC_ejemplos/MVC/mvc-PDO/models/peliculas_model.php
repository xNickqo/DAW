<?php
echo "Inicio modelo"."<br>";

// Modelo contiene la lógica de la aplicación: clases y métodos que se comunican
// con la Base de Datos

function obtenerPeliculas() {

	global $conexion;

	try {
		$obtenerInfo = $conexion->prepare("select * from film;");
		$obtenerInfo->execute();
		return $obtenerInfo->fetchAll(PDO::FETCH_ASSOC); 

	} catch (PDOException $ex) {
		echo "Error al recuperar peliculas". $ex->getMessage();
		return null;
	}

}

echo "Fin modelo"."<br>";
?>