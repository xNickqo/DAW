<?php
include_once "controllers/error.php";

if(isset($_POST['submit'])){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    include_once "db/conexionBBDD.php";
    $conn = conexionBBDD();

    include_once "models/obtenerUsuario.php";
    $usuario = obtenerUsuario($conn, $email);

    if(!empty($usuario)) {
        if(!password_verify($password, $usuario['password'])) {
            trigger_error("Clave incorrecta", E_USER_WARNING);
        } else {         
            session_start();
            $_SESSION['usuario'] = $usuario;
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