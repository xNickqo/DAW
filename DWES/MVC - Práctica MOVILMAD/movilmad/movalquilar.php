<?php
session_start();

if (!isset($_SESSION['usuario'])) {
	header("Location: movinicio.php");
	exit();
}

//Si el carrito no existe lo creamos
if (!isset($_SESSION['carrito']))
	$_SESSION['carrito'] = array();


// Agregar productos al carrito
if (isset($_POST['agregar'])) {
	$existe = false;

	if(isset($_SESSION['carrito'])){
		foreach ($_SESSION['carrito'] as $matricula) {
			if($matricula == $_POST['vehiculos'])
				$existe = true;
		}
	}

	if($existe == false){
		if(count($_SESSION['carrito']) < 3)
			$_SESSION['carrito'][] = $_POST['vehiculos'];
		else
			$mensaje = "Solo se puede añadir hasta un maximo de 3 vehiculos al carrito";
	} else {
		$mensaje = "El vehiculo ya se encuentra en el carrito";
	}
}

//Vaciar el carrito
if(isset($_POST['vaciar'])){
	$_SESSION['carrito'] = array();
}

//Realizar alquiler
if(isset($_POST['alquilar'])){
	if (count($_SESSION['carrito']) > 0) {
		include_once "db/conexionBBDD.php";
		$conn = conexionBBDD();

		try{
			include_once "models/actualizarVehiculosDisponibles.php";
			actualizarVehiculosDisponibles($conn);
			$_SESSION['carrito'] = array();
			$mensaje = "¡Alquiler realizado con exito!";
		}catch(PDOException $e){
			$mensaje = "mensaje en la consulta: ". $e->getMessage();
		}

		$conn = null;
	}
}

include_once "views/formularioAlquilar.php";
?>

