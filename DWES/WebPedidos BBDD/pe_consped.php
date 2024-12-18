<?php
    session_start();
    include('includes/funciones.php');

    if (!isset($_SESSION['usuario'])) {
        header("Location: pe_login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Pedidos</title>
</head>
<body>
    <h2>Consultar Pedidos</h2>
    <form method="POST">
        <input type="submit" name="consultar" value="Consultar Pedidos">
    </form>

    <a href="pe_inicio.php">Volver al inicio</a>

    <?php
        if (isset($_POST['consultar'])) {
            $customerNumber = $_SESSION['usuario'];
            consultarPedidos($customerNumber);
        }
    ?>
</body>
</html>
