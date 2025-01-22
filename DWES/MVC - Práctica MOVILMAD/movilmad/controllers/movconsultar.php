<?php
include_once "../controllers/gestionSesiones.php";

include_once "../db/conexionBBDD.php";
$conn = conexionBBDD();

if(isset($_POST['Consultar'])){
	include_once "../models/consultaAlquileres.php";
	$resultadoConsulta = consultaAlquileres($conn);
}

if(isset($_POST['Volver'])){
	header("Location: movwelcome.php");
	exit();
}

include_once "../views/formularioConsultar.php";

$conn = null;
?>

