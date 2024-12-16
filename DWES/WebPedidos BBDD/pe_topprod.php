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
    <title>Productos Más Vendidos</title>
</head>
<body>
    <h2>Consultar Unidades Totales Vendidas por Producto</h2>
    <form method="POST">
        <label for="startDate">Fecha Inicio:</label>
        <input type="date" name="startDate" required>
        <br>
        <label for="endDate">Fecha Fin:</label>
        <input type="date" name="endDate" required>
        <br><br>
        <input type="submit" name="consultar" value="Consultar">
    </form>

    <?php
    if (isset($_POST['consultar'])) {
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];

        // Validar que las fechas sean correctas
        if ($startDate > $endDate) {
            echo "<p style='color:red;'>La fecha de inicio no puede ser posterior a la fecha de fin.</p>";
        } else {
            $conn = conexionBBDD();

            // Consulta SQL para obtener las unidades totales vendidas por producto entre las fechas
            $sql = "SELECT p.productName, SUM(od.quantityOrdered) AS totalSold 
                FROM orderdetails od
                JOIN orders o ON od.orderNumber = o.orderNumber
                JOIN products p ON od.productCode = p.productCode
                WHERE o.orderDate BETWEEN :startDate AND :endDate";

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':startDate', $startDate);
            $stmt->bindValue(':endDate', $endDate);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "<table border='1'>";
                echo "<tr><th>Producto</th><th>Unidades Vendidas</th></tr>";

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['productName']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['totalSold']) . "</td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<p>No se encontraron ventas en el rango de fechas seleccionado.</p>";
            }
        }
    }
    ?>
</body>
</html>
