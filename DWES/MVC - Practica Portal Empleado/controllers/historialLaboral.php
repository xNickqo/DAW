<?php
include_once "../controllers/gestionSesiones.php";
var_dump($_SESSION['usuario']);

include_once "../db/conexionBBDD.php";
$conn = conexionBBDD();

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $empleado = $_POST["empleados"];

    
}

$conn = null;
?>