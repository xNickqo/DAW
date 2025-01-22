<?php
function insertarActualizarAlquiler($conn){
    $conn->beginTransaction();
		try{
			include_once "../models/insertarAlquiler.php";
			insertarAlquiler($conn);

			include_once "../models/actualizarVehiculosDisponibles.php";
			actualizarVehiculosDisponibles($conn);
			
			$conn->commit();

			return "¡Alquiler realizado con exito!";
		}catch(PDOException $e){
			$conn->rollBack();
			return "mensaje en la consulta: ". $e->getMessage();
		}
}
?>