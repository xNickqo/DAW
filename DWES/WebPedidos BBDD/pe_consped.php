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

            $conn = conexionBBDD();

            // obtener los pedidos del cliente
            $sql = "SELECT o.orderNumber, o.orderDate, o.status, od.orderLineNumber, p.productName, od.quantityOrdered, od.priceEach
                FROM orders o
                JOIN orderdetails od ON o.orderNumber = od.orderNumber
                JOIN products p ON od.productCode = p.productCode
                WHERE o.customerNumber = :customerNumber
                ORDER BY od.orderLineNumber";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':customerNumber', $customerNumber);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "<h3>Pedidos de Cliente: $customerNumber</h3>";
                echo "<table border='1'>
                        <tr>
                            <th>Número Pedido</th>
                            <th>Fecha Pedido</th>
                            <th>Estado</th>
                            <th>Número de Línea</th>
                            <th>Nombre Producto</th>
                            <th>Cantidad Pedida</th>
                            <th>Precio Unidad</th>
                        </tr>";

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['orderNumber']) . "</td>
                            <td>" . htmlspecialchars($row['orderDate']) . "</td>
                            <td>" . htmlspecialchars($row['status']) . "</td>
                            <td>" . htmlspecialchars($row['orderLineNumber']) . "</td>
                            <td>" . htmlspecialchars($row['productName']) . "</td>
                            <td>" . htmlspecialchars($row['quantityOrdered']) . "</td>
                            <td>" . number_format($row['priceEach'], 2) . "</td>
                        </tr>";
                }

                echo "</table>";
            } else {
                echo "No se encontraron pedidos para este cliente.";
            }
        }
    ?>
</body>
</html>
