<?php

include_once "../controllers/error.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include_once "../db/conexionBBDD.php";
    $conn = conexionBBDD();

    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(!empty($nombre) && !empty($email) && !empty($password)){
        include_once "../models/insertarUsuario.php";
        $password_enc = password_hash($password, PASSWORD_DEFAULT);
        insertarUsuario($conn, $nombre, $email, $password_enc);

        echo "Usuario insertado con exito";
    } else {
        trigger_error("Los campos no pueden estar vacios", E_USER_WARNING);
    }

    $conn = null;
}

include_once "../views/formRegistro.php";

?>