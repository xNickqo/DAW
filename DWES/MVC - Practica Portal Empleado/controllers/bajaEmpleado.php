<?php
    include_once ("../controllers/gestionSesiones.php");
    //var_dump($_SESSION);

    include_once ("../db/conexionBBDD.php");
    $conn = conexionBBDD();

    include_once "../models/obtenerEmpleados.php";
    $empleados = obtenerEmpleados($conn);

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $empleado = $_POST["empleados"];

        include_once "../models/actualizarBajaEmple.php";
    }

    include_once "../views/formBajaEmp.php";

    $conn = null;

?>
