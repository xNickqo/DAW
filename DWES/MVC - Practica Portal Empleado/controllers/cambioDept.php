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

    include_once "../models/verificarEmpleRRHH.php";
    $rrhh = verificarEmpleRRHH($conn, $_SESSION['usuario']['emp_no']);
    if ($rrhh === 0)
        $mensaje = "No tienes permisos para cambiar de departamento, no eres de Recursos Humanos.";


    if(isset($_POST['cambiar'])){
        $emp_no = $_POST['emp_no'];
        $nuevo_depto = $_POST['nuevo_depto'];

        if (empty($emp_no) || empty($nuevo_depto)) {
            $mensaje = "Por favor, complete todos los campos.";
        } else {
            include_once "../models/cambioEmpDept.php";
        }
    }

    include_once "../views/formCambioDept.php";

    $conn = null;

?>

