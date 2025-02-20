<?php
include_once "db/conexionBBDD.php";
$conn = conexionBBDD();

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $clave = $_POST['password'];

    include_once "models/obtenerCliente.php";
    $resultado = obtenerCliente($conn, $username);

    var_dump($resultado);

    if (!empty($resultado)) {
        
        if($clave != $resultado['last_name']) {
            $mensaje = "Clave incorrecta";
        } else {
            
            session_start();
            $_SESSION['usuario'] = $resultado;
            header("Location: controllers/inicio.php");
            exit();
            
        }
    } else {
        $mensaje =  "El usuario no existe.";
    }
}

include_once "views/formLogin.php";

$conn = null;
?>