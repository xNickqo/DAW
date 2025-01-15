<?php
include_once "db/conexionBBDD.php";
$conn = conexionBBDD();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST['email'];
    $clave = $_POST['password'];

    include_once "models/obtenerCliente.php";
    $resultado = obtenerCliente($conn, $email);
    echo "<pre>";
    var_dump($resultado);
    echo "</pre>";

    if (!empty($resultado)) {
        if ($clave != $resultado['idcliente']) {
            $mensaje =  "Clave incorrecta";
        } else if ($resultado['fecha_baja'] != NULL){
            $mensaje =  "Usted se dio de baja";
        } else if ($resultado['pendiente_pago'] != 0){
            $mensaje =  "Tiene pagos pendientes";
        } else {
            session_start();
            $_SESSION['usuario'] = $resultado;
            header("Location: movwelcome.php");
            exit();
        }
    } else {
        $mensaje =  "El usuario no existe.";
    }
}

include_once "views/formularioLogin.php";
?>