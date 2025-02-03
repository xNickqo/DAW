<?php
include_once "../controllers/gestionSesiones.php";
//echo "<pre>";
//var_dump($_SESSION['usuario']);
//echo "</pre>";

include_once "../db/conexionBBDD.php";
$conn = conexionBBDD();

if (isset($_POST['modificar'])) {
    $emp_no = $_POST['emp_no'];
    $salario = $_POST['salario'];

    if (empty($emp_no) || empty($salario)) {
        $mensaje = "Por favor, complete todos los campos.";
    } else {
        try{
            $conn->beginTransaction();

            include "../models/verificarEmpleRRHH.php";
            $res = verificarEmpleRRHH($conn, $_SESSION['usuario']['emp_no']);
            if ($res > 0) {
                include "../models/actualizarSalario.php";
            } else {
                $mensaje = "No tienes permisos para cambiar el sueldo, no eres de Recursos Humanos";
            }

            $conn->commit();
        }catch(PDOException $e){
            $conn->rollBack();
            $mensaje = "Error: ".$e->getMessage();
        }
    }

    $conn = null;

    include_once "../views/formModSalario.php";
}
?>
