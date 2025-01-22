<?php
include_once "../controllers/gestionSesiones.php";

//Si el carrito no existe lo creamos
if (!isset($_SESSION['carrito']))
	$_SESSION['carrito'] = array();

include_once "../db/conexionBBDD.php";
$conn = conexionBBDD();

//Obtenemos los vehiculos disponibles para mostrarlo en un desplegable en la vista
include_once "../models/obtenerVehiculosDisponibles.php";
$resultado = obtenerVehiculosDisponibles($conn);


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
if(isset($_POST['alquilar'])) {
	if (count($_SESSION['carrito']) > 0) {
		include_once "../models/insertarActualizarAlquiler.php";
		$mensaje = insertarActualizarAlquiler($conn);

		$_SESSION['carrito'] = array();
	}
}

include_once "../views/formularioAlquilar.php";

$conn = null;
?>

