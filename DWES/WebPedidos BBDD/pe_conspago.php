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
    <title>Consultar Pagos Realizados</title>
</head>
<body>
    <h2>Consultar Pagos Realizados</h2>
    <form method="POST">
        <label for="customerNumber">Cliente:</label>
        <select name="customerNumber" required>
            <?php
                $conn = conexionBBDD();
                $sql = "SELECT customerNumber, customerName FROM customers";
                imprimirOpciones($sql, 'customerNumber', 'customerName');
            ?>
        </select>
        <br>
        <label for="startDate">Fecha Inicio:</label>
        <input type="date" name="startDate">
        <br>
        <label for="endDate">Fecha Fin:</label>
        <input type="date" name="endDate">
        <br><br>
        <input type="submit" name="consultar" value="Consultar">
    </form>

    <a href="pe_inicio.php">Volver al inicio</a>

    <?php
        if (isset($_POST['consultar']) && (!empty($startDate) && !empty($endDate))) {
            $customerNumber = $_POST['customerNumber'];
            $startDate = $_POST['startDate'];
            $endDate = $_POST['endDate'];

            $sql = "SELECT paymentDate, checkNumber, amount 
                FROM payments 
                WHERE customerNumber = :customerNumber
                AND paymentDate BETWEEN :startDate AND :endDate";

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':customerNumber', $customerNumber);
            if (!empty($startDate) && !empty($endDate)) {
                $stmt->bindValue(':startDate', $startDate);
                $stmt->bindValue(':endDate', $endDate);
            }
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "<h3>Pagos Realizados</h3>";
                echo "<table border='1'>";
                echo "<tr><th>Fecha</th><th>Número de Pago</th><th>Importe</th></tr>";

                $totalAmount = 0;

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['paymentDate']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['checkNumber']) . "</td>";
                    echo "<td>$" . number_format($row['amount'], 2) . "</td>";
                    echo "</tr>";

                    $totalAmount += $row['amount'];
                }

                echo "</table>";
                echo "<p><b>Total Pagado:</b> $" . number_format($totalAmount, 2) . "</p>";
            } else {
                echo "<p>No se encontraron pagos para el cliente seleccionado en el rango de fechas proporcionado.</p>";
            }
        }
    ?>
</body>
</html>
