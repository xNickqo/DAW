<?php
include_once "../controllers/gestionSesiones.php";
//echo "<pre>";
//var_dump($_SESSION['usuario']);
//echo "</pre>";

include_once "../db/conexionBBDD.php";
$conn = conexionBBDD();

include_once "../models/obtenerAllDepts.php";
$depts = obtenerAllDepts($conn);

include_once "../models/obtenerEmpleados.php";
$employees = obtenerEmpleados($conn);

if(isset($_POST['cambiar'])){
    include_once "../models/verificarEmpleRRHH.php";
    $rrhh = verificarEmpleRRHH($conn, $_SESSION['usuario']['emp_no']);
    if ($rrhh === 0){
        $mensaje = "No tienes permisos para cambiar de departamento, no eres de Recursos Humanos.";
    } else {
        $emp_no = $_POST['emp_no'];
        $depto = $_POST['depto'];

        if (empty($emp_no) || empty($depto)) {
            $mensaje = "Por favor, complete todos los campos.";
        } else {
            
            include_once "../models/gestionJefeDept.php";

        }
    }
}
include_once "../views/formNuevoJefeDept.php";
$conn = null;
?>
