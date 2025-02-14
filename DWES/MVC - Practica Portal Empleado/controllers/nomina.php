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
    
    include_once "../models/obtenerNomina.php";
    $res = obtenerNomina($conn, $empleado);
    var_dump($res);

    // Cálculo de salario neto
    $salario_bruto = $res['salary'];
    $seguridad_social = $salario_bruto * 0.075;

    // Calcular IRPF
    if ($salario_bruto < 40000) {
        $irpf = $salario_bruto * 0.10;
    } elseif ($salario_bruto >= 40000 && $salario_bruto <= 70000) {
        $irpf = $salario_bruto * 0.20;
    } else {
        $irpf = $salario_bruto * 0.30;
    }

    // Complemento Engineer
    $complemento = 0;
    if (strpos(strtolower($res['title']), 'engineer') !== false) {
        $complemento = 10000;
    }

    $salario_neto = $salario_bruto - $seguridad_social - $irpf + $complemento;
    
}
include_once "../views/formNomina.php";

$conn = null;
?>
