<?php

include_once "controllers/error.php";

if(isset($_POST['submit'])){
    $usuario = trim($_POST['usuario']);
    $clave = trim($_POST['password']);

    include_once "db/vconfig.php";
    //Nos conectamos con la base de datos al hacer la peticion
    $conn = conexionBBDD();

    //Comprobamos si existe el cliente con el email
    include_once "models/obtenerCliente.php";
    $cliente = obtenerCliente($conn, $usuario);

    if (!empty($cliente)) {
        if($clave != substr($cliente['dni'], 0, 4)) {
            trigger_error("Clave incorrecta", E_USER_WARNING);
        } else {         
            session_start();
            $_SESSION['usuario'] = $cliente;
            header("Location: controllers/vinicio.php");
            exit();
        }
    } else {
        trigger_error("El usuario no existe", E_USER_WARNING);
    }
}

include_once "views/formLogin.php";
$conn = null;

?>
