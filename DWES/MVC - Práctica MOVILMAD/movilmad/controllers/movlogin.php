<?php
session_start();

if (isset($_SESSION['usuario'])) {
    header("Location: controllers/movwelcome.php");
    exit();
}

include_once "db/conexionBBDD.php";
$conn = conexionBBDD();

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $clave = $_POST['password'];

    include_once "models/obtenerCliente.php";
    $resultado = obtenerCliente($conn, $email);

    if (!empty($resultado)) {
        if($clave != $resultado['idcliente'] || $clave != password_verify($resultado['clave'], PASSWORD_DEFAULT)) {
            $mensaje = "Clave incorrecta";
        }else if($resultado['fecha_baja'] != NULL){
            $mensaje = "Usted se dio de baja";
        }else if($resultado['pendiente_pago'] != 0){
            $mensaje = "Tiene pagos pendientes"; 
        }else {
            session_start();
            $_SESSION['usuario'] = $resultado;
            header("Location: controllers/movwelcome.php");
            exit();
        }
    } else {
        $mensaje =  "El usuario no existe.";
    }
}

if(isset($_POST['registro'])){
    header("Location: controllers/registro.php");
    exit();
}

include_once "views/formularioLogin.php";

$conn = null;
?>