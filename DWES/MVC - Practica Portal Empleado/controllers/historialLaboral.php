<?php
include_once "../controllers/gestionSesiones.php";
var_dump($_SESSION['usuario']);

include_once "../db/conexionBBDD.php";
$conn = conexionBBDD();

include_once "../models/obtenerEmpleados.php";
$empleados = obtenerEmpleados($conn);

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $empleado = $_POST["emp"];

    include_once "../models/obtenerHistorialLab.php";
    $historial = obtenerHistorialLab($conn, $empleado);
    if (!$historial) {
        $mensaje = "Error: No se encontraron datos del historial laboral.";
        exit();
    }
}

include_once "../views/formHistorialLab.php";

$conn = null;
?>
