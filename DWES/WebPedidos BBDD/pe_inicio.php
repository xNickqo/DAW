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

    <a href="pe_altaped.php">Alta de pedidos</a><br>
    <a href="pe_consped.php">Consultar pedidos</a><br>
    <a href="pe_consprodstock.php">Consultar Stock d un producto</a><br>
    <a href="pe_constock.php">Consulta de Stock de todos los productos</a><br>
    <a href="pe_topprod.php">Unidades totales de cada uno de los productos vendidos entre dos fechas</a><br>
    <a href="pe_conspago.php">Relación de pagos realizados entre dos fechas, así como el importe total de los mismos</a><br>

</body>
</html>