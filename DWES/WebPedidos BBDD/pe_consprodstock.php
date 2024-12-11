<?php
session_start();
include('includes/funciones.php');

// Verificar si el usuario está autenticado (esto depende de tu sistema de autenticación)
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

    <!-- Formulario para seleccionar el nombre del producto -->
    <form method="POST">
        <label for="productName">Seleccionar Producto:</label>
        <select name="productName" required>
            <option value="">--Seleccione un producto--</option>
            <?php
                // Conexión a la base de datos
                $conn = conexionBBDD();

                // Consulta SQL para obtener los nombres de los productos
                $sql = "SELECT productName FROM products";
                imprimirOpciones($sql, 'productName', 'productName');
            ?>
        </select><br><br>

        <input type="submit" name="consultar" value="Consultar Stock">
    </form>

    <?php
    if (isset($_POST['consultar'])) {
        // Obtener el nombre del producto seleccionado
        $productName = $_POST['productName'];

        // Conexión a la base de datos
        $conn = conexionBBDD();

        // Consulta SQL para obtener el stock del producto seleccionado
        $sql = "SELECT productName, quantityInStock FROM products WHERE productName = :productName";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':productName', $productName);
        $stmt->execute();

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<h3>Stock de Producto: " . htmlspecialchars($row['productName']) . "</h3>";
            echo "<p>Cantidad en Stock: " . htmlspecialchars($row['quantityInStock']) . "</p>";
        } else {
            echo "<p>Producto no encontrado.</p>";
        }
    }
    ?>
</body>
</html>
