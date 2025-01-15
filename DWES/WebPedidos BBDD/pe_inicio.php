<?php
    session_start();

    if (!isset($_SESSION['usuario'])) {
        header("Location: pe_login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEB PEDIDOS</title>
</head>
<body>

    <a href="pe_altaped.php">Realizar un pedido</a><br>
    <a href="pe_consped.php">Consultar pedidos</a><br>
    <a href="pe_consprodstock.php">Consultar stock de un producto</a><br>
    <a href="pe_constock.php">Consulta de Stock de todos los productos de un tipo</a><br>
    <a href="pe_topprod.php">Productos vendidos entre dos fechas</a><br>
    <a href="pe_conspago.php">Relación de pagos realizados entre dos fechas</a><br>

    <br><br>
    <a href="pe_logout.php">Cerrar Sesion</a>
</body>
</html>