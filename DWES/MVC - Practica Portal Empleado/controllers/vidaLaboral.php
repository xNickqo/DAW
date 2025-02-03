<?php
include_once "../controllers/gestionSesiones.php";
//echo "<pre>";
//var_dump($_SESSION['usuario']);
//echo "</pre>";

include_once "../db/conexionBBDD.php";
$conn = conexionBBDD();

include_once "../models/obtenerEmpleados.php";
$res=obtenerEmpleados($conn);

if (isset($_POST['emp_no'])) {
    $emp_no = $_POST['emp_no'];

    if (empty($emp_no)) {
        $mensaje = "Por favor, ingresa un número de empleado válido.";
    } else {
        include_once "../models/obtenerVidaLaboral.php";
    }
}

$conn = null;

include_once "../views/formVidaLab.php";
?>

