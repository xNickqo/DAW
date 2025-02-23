<?php
include_once "../controllers/gestionSesiones.php";
include_once "../controllers/error.php";

/*
echo "<pre> SESSION: <br>";
print_r($_SESSION['usuario']);
echo "</pre>";
*/

if(isset($_POST['mostrar'])){
    $inicio = $_POST['inicio'];
    $fin = $_POST['fin'];

    include_once "../db/conexionBBDD.php";
    $conn = conexionBBDD();

    include_once "../models/obtenerRanking.php";
    $res = obtenerRanking($conn, $inicio, $fin);
    
    /*
    echo "<pre> SESSION: <br>";
    print_r($res);
    echo "</pre>";
    */
}

include_once "../views/formRanking.php";

$conn = null;
?>
