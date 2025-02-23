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

    if ($inicio > $fin) {
        trigger_error("La fecha de inicio no puede ser posterior a la fecha de fin.", E_USER_WARNING);
    }

    include_once "../db/conexionBBDD.php";
    $conn = conexionBBDD();

    include_once "../models/obtenerRanking.php";
    $res = obtenerRanking($conn, $inicio, $fin);
    if(!$res){
        trigger_error("No hay canciones descargadas entre esas fechas", E_USER_WARNING);
    }
    
    /*
    echo "<pre> SESSION: <br>";
    print_r($res);
    echo "</pre>";
    */
}

include_once "../views/formRanking.php";

$conn = null;
?>
