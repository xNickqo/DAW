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
    <title>Consultar Stock de Producto</title>
</head>
<body>
    <h2>Consultar Stock de Producto</h2>
    <form method="POST">
        <label for="productName">Seleccionar Producto:</label>
        <select name="productName" required>
            <option value="">--Seleccione un producto--</option>
            <?php
                $conn = conexionBBDD();
                $sql = "SELECT productName FROM products";
                imprimirOpciones($sql, 'productName', 'productName');
            ?>
        </select><br><br>
        <input type="submit" name="consultar" value="Consultar Stock">
    </form>

    <a href="pe_inicio.php">Volver al inicio</a>

    <?php
        if (isset($_POST['consultar'])) {
            $productName = $_POST['productName'];

            // obtener el stock del producto seleccionado
            $sql = "SELECT productName, quantityInStock FROM products WHERE productName = :productName";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':productName', $productName);
            $stmt->execute();

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<h3>Stock de Producto: " . htmlspecialchars($row['productName']) . "</h3>";
                echo "<p>Stock: " . htmlspecialchars($row['quantityInStock']) . "</p>";
            } else {
                echo "<p>Producto no encontrado.</p>";
            }
        }
    ?>
</body>
</html>
