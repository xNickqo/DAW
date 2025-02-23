<?php
include_once "controllers/error.php";

if(isset($_POST['submit'])){
    $username = trim($_POST['username']);
    $clave = trim($_POST['password']);

    include_once "db/conexionBBDD.php";
    $conn = conexionBBDD();

    include_once "models/obtenerCliente.php";
    $cliente = obtenerCliente($conn, $username);

    if (!empty($cliente)) {
        if($clave != $cliente['LastName']) {
            trigger_error("Clave incorrecta", E_USER_WARNING);
        } else {         
            session_start();
            $_SESSION['usuario'] = $cliente;
            header("Location: controllers/inicio.php");
            exit();
        }
    } else {
        trigger_error("El usuario no existe", E_USER_WARNING);
    }
}

include_once "views/formLogin.php";

$conn = null;
?>