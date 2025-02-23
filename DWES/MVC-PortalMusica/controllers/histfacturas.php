<?php
include_once "../controllers/gestionSesiones.php";
include_once "../controllers/error.php";

/*
echo "<pre> SESSION: <br>";
print_r($_SESSION['usuario']);
echo "</pre>";
*/

if(isset($_POST['mostrar'])){
    include_once "../db/conexionBBDD.php";
    $conn = conexionBBDD();

    include_once "../models/obtenerInvoice.php";
    $res = obtenerInvoice($conn);
}

include_once "../views/formHistFacturas.php";

$conn = null;
?>
