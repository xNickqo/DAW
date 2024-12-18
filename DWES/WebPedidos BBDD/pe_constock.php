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
    <title>Consultar Stock por Línea de Producto</title>
</head>
<body>
    <h2>Consultar Stock Total por Línea de Producto</h2>
    <form method="POST">
        <label for="productLine">Seleccionar Línea de Producto:</label>
        <select name="productLine" required>
            <option value="">--Seleccione una línea de producto--</option>
            <?php
                $conn = conexionBBDD();
                
                $sql = "SELECT DISTINCT productLine FROM products";
                imprimirOpciones($sql, 'productLine', 'productLine');
            ?>
        </select>
        <br><br>
        <input type="submit" name="consultar" value="Consultar Stock">
    </form>

    <a href="pe_inicio.php">Volver al inicio</a>

    <?php
        $productLine = $_POST['productLine'];
        if (isset($_POST['consultar']))
            consultarStock($productLine);
    ?>
</body>
</html>
