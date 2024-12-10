<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de stock</title>
</head>
<body>
    <h2>Consulta de Stock</h2>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <label for="producto">Selecciona el Producto:</label>
        <select name="producto" id="producto" required>
            <?php
                include "../includes/funciones.php";

                $conn = conexionBBDD();

                $sql = "SELECT ID_PRODUCTO, NOMBRE FROM producto";
                imprimirOpciones($sql, 'ID_PRODUCTO', 'NOMBRE');
            ?>
        </select>
        <br><br>

        <input type="submit" value="Mostrar stock del producto">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $producto = $_POST['producto'];

        // Consulta para obtener las cantidades por almacén
        $sql = "SELECT a.LOCALIDAD, al.CANTIDAD 
                      FROM almacena al 
                      JOIN almacen a ON al.NUM_ALMACEN = a.NUM_ALMACEN 
                      WHERE al.ID_PRODUCTO = :producto";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':producto', $producto, PDO::PARAM_STR);
        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Mostrar resultados
        if (count($resultados) > 0) {
            echo "<table border='1'>";
            echo "<tr><th>Almacén</th><th>Cantidad</th></tr>";

            foreach ($resultados as $row) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['LOCALIDAD']) . "</td>";
                echo "<td>" . htmlspecialchars($row['CANTIDAD']) . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No hay stock disponible para el producto seleccionado.</p>";
        }
    }
    ?>

</body>
</html>