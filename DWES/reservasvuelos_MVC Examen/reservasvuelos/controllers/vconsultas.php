<?php
include_once "../controllers/gestionSesiones.php";
include_once "../controllers/error.php";

/*
echo "<pre> SESSION: <br>";
print_r($_SESSION['usuario']);
echo "</pre>";
*/

include_once "../db/vconfig.php";
$conn = conexionBBDD();

include_once "../models/obtenerReserva.php";
$res = obtenerReserva($conn);

if(isset($_POST['reserva'])){
    include_once "../models/consulta.php";
	$consultas = consulta($conn);
    echo $_POST['reserva'];
}

if (isset($_POST['volver'])) {
    header("Location: ../controllers/vinicio.php");
    exit();
}

include_once "../views/formConsulta.php";

$conn = null;
?>