<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Almacenes</title>
</head>
<body>
    <h2>Consulta de Productos por Almacén</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <label for="almacen">Selecciona un Almacén:</label>
        <select name="almacen" id="almacen" required>
            <?php
                include "../includes/funciones.php";

                $conn = conexionBBDD();

                $sql = "SELECT NUM_ALMACEN, LOCALIDAD FROM almacen";
                imprimirOpciones($sql, 'NUM_ALMACEN', 'LOCALIDAD');
            ?>
        </select>
        <br><br>
        <input type="submit" value="Consultar Almacén">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $alm = $_POST['almacen'];

        // Consulta para obtener los productos disponibles en el almacén
        $sql = "SELECT p.NOMBRE AS PRODUCTO, al.CANTIDAD 
                          FROM almacena al 
                          JOIN producto p ON al.ID_PRODUCTO = p.ID_PRODUCTO 
                          WHERE al.NUM_ALMACEN = :almacen";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':almacen', $alm, PDO::PARAM_INT);
        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Mostrar resultados
        if (count($resultados) > 0) {
            echo "<table border='1'>";
            echo "<tr><th>Producto</th><th>Cantidad</th></tr>";

            foreach ($resultados as $row) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['PRODUCTO']) . "</td>";
                echo "<td>" . htmlspecialchars($row['CANTIDAD']) . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No hay productos disponibles en el almacén seleccionado.</p>";
        }
    }
    ?>
</body>
</html>
