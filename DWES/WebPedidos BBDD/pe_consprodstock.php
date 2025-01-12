<?php
    session_start();

    include "includes/1_funcionesModelo.php";
    include "includes/2_funcionesVista.php";
    include "includes/3_funcionesControlador.php";

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
    <title>Consultar Stock de Producto</title>
</head>
<body>
    <h2>Consultar Stock de Producto</h2>
    <form method="POST">
        <label for="productName">Seleccionar Producto:</label>
        <select name="productName" required>
            <option value="">--Seleccione un producto--</option>
            <?php
                $sql = "SELECT productName FROM products";
                imprimirOpciones($sql, 'productName', 'productName');
            ?>
        </select><br><br>
        <input type="submit" name="consultar" value="Consultar Stock">
    </form>

    <a href="pe_inicio.php">Volver al inicio</a>

    <?php
        $conn = conexionBBDD();
        if (isset($_POST['consultar'])) {
            $productName = $_POST['productName'];

            $row = obtenerStockProducto($conn, $productName);

            imprimirStockProducto($row);
        }
    ?>
</body>
</html>
