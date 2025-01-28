<?php
include_once "../controllers/gestionSesiones.php";
var_dump($_SESSION['usuario']);

include_once "../db/conexionBBDD.php";
$conn = conexionBBDD();

include_once "../models/obtenerAllDepts.php";
$departments = obtenerAllDepts($conn);

if (isset($_POST['alta'])) {
	$nombre = $_POST['name'];
	$apellido = $_POST['apellido'];
	$genero = $_POST['genero'];
	$fechaNac = $_POST['fechaNac'];
	$dpt = $_POST['dpt'];
	$salario = $_POST['salario'];
	$cargo = $_POST['cargo'];

	include_once "../models/altaEmple.php";
}

include_once "../views/formAltaEmp.php";

$conn = null;
?>
