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
    <title>Consultar Pedidos</title>
</head>
<body>
    <h2>Consultar Pedidos</h2>

    <!-- Formulario para seleccionar un número de cliente -->
    <form method="POST">
        <label for="customerNumber">Número de Cliente:</label>
        <select name="customerNumber" id="customerNumber">
            <?php
                $sql = "SELECT customerName, customerNumber FROM customers";
                imprimirOpciones($sql, 'customerNumber', 'customerName');
            ?>
        </select><br><br>
        <input type="submit" name="consultar" value="Consultar Pedidos">
    </form>

    <?php
    if (isset($_POST['consultar'])) {
        $customerNumber = $_POST['customerNumber'];

        $conn = conexionBBDD();

        // Consulta SQL para obtener los pedidos del cliente
        $sql = "SELECT o.orderNumber, o.orderDate, o.status, od.orderLineNumber, p.productName, od.quantityOrdered, od.priceEach
            FROM orders o
            JOIN orderdetails od ON o.orderNumber = od.orderNumber
            JOIN products p ON od.productCode = p.productCode
            WHERE o.customerNumber = :customerNumber
            ORDER BY od.orderLineNumber";
        
        // Preparar y ejecutar la consulta
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':customerNumber', $customerNumber);
        $stmt->execute();

        // Verificar si se encontraron pedidos
        if ($stmt->rowCount() > 0) {
            // Mostrar los resultados
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

            // Iterar sobre los resultados y mostrar los detalles
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
