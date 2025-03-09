<?php
    session_start();

    if (!isset($_SESSION['usuario'])) {
        header("Location: portalCompras/comlogincli.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEB COMPRAS</title>
</head>
<body>
    <h3>Gestion Interna General</h3>
    <a href="gestionInternaGeneral/comaltacat.php">Alta de categorias</a><br>
    <a href="gestionInternaGeneral/comaltapro.php">Alta de productos</a><br>
    <a href="gestionInternaGeneral/comaltaalm.php">Alta de almacenes</a><br>
    <a href="gestionInternaGeneral/comaprpro.php">Aprovisionar Productos </a><br>
    <a href="gestionInternaGeneral/comconstock.php">Consulta de Stock</a><br>
    <a href="gestionInternaGeneral/comconsalm.php">Consulta de Almacenes</a><br>
    <a href="gestionInternaGeneral/comconscom.php">Consulta de Compras</a><br>
    <BR></BR>
    <h3>Gestion Interna Clientes</h3>
    <a href="gestionInternaClientes/comaltacli.php">Alta de clientes</a><br>
    <a href="gestionInternaClientes/compro.php">Compra de productos</a><br>
    <BR></BR>
    <h3>Portal compras</h3>
    <a href="portalCompras/comconscli.php">Consulta de compras</a><br>
    <a href="portalCompras/comlogincli.php">Login</a><br>
    <a href="portalCompras/comprocli.php">Compra de productos</a><br>
    <a href="portalCompras/comregcli.php">Registro de clientes</a><br>
</body>
</html>