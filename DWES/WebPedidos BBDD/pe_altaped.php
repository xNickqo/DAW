<?php
session_start();
include('includes/funciones.php');

if (!isset($_SESSION['usuario'])) {
    header("Location: pe_login.php");
    exit();
}

// Si el carrito no existe en la sesión, lo inicializamos
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Pedido</title>
</head>
<body>
    <h2>Realizar Pedido</h2>

    <h3>Seleccionar Productos</h3>
    <form method="POST">
        <label for="productCode">Producto:</label>
        <select name="productCode" required>
            <?php
                $sql = "SELECT productCode, productName FROM products WHERE quantityInStock > 0";
                imprimirOpciones($sql, 'productCode', 'productName');
            ?>
        </select>
        <br>
        <label for="quantity">Cantidad:</label>
        <input type="number" name="quantity" min="1" required><br>
        <input type="submit" name="agregar" value="Agregar al carrito">
    </form>

    <?php
        //Agregamos a la sesion del carrito los productos y su cantidad
        if (isset($_POST['agregar'])) {
            $productCode = $_POST['productCode'];
            $quantity = $_POST['quantity'];

            $_SESSION['carrito'][] = array(
                'productCode' => $productCode, 
                'quantity' => $quantity
            );
        }
    ?>

    <h3>Carrito de Compras</h3>
    <table border="1">
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Acción</th>
        </tr>
        <?php foreach ($_SESSION['carrito'] as $item): ?>
            <tr>
                <td>
                    <?php
                        // Obtener nombre del producto
                        $conn = conexionBBDD();
                        $sql = "SELECT productName FROM products WHERE productCode = :productCode";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindValue(':productCode', $item['productCode']);
                        $stmt->execute();
                        $productName = $stmt->fetch(PDO::FETCH_ASSOC);
                        echo $productName['productName'];
                    ?>
                </td>
                <td><?= $item['quantity'] ?></td>
                <td>
                    <form method="POST" action="">
                        <input type="hidden" name="productCodeToRemove" value="<?= $item['productCode'] ?>">
                        <input type="submit" name="eliminar" value="Eliminar">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php
        // Eliminar producto del carrito
        if (isset($_POST['eliminar'])) {
            $productCodeToRemove = $_POST['productCodeToRemove'];

            // Buscar el producto en el carrito y eliminarlo
            foreach ($_SESSION['carrito'] as $key => $item) {
                if ($item['productCode'] == $productCodeToRemove) {
                    unset($_SESSION['carrito'][$key]);
                    break;
                }
            }

            // Reindexar el carrito para evitar claves no consecutivas
            $_SESSION['carrito'] = array_values($_SESSION['carrito']);
        }

    ?>

    <h3>Realizar Pedido</h3>
    <form method="POST">
        <label for="checkNumber">Número de Pago:</label>
        <input type="text" name="checkNumber" required>
        <br>
        <label for="requiredDate">Fecha de Solicitud:</label>
        <input type="date" name="requiredDate" required>
        <br>
        <input type="submit" name="realizar_pedido" value="Confirmar Pedido">
    </form>

    <?php
        // Procesar el pedido
        if (isset($_POST['realizar_pedido'])) {
            try {
                // Obtener el siguiente número de pedido
                $conn = conexionBBDD();

                $conn->beginTransaction();

                $sql = 'SELECT MAX(orderNumber) FROM orders';
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $orderNumber = $stmt->fetchColumn();
                $orderNumber = (int)$orderNumber + 1;

                $orderDate = date('Y-m-d');
                $requiredDate = $_POST['requiredDate'];

                // Insertar datos del pedido
                $insertOrderData = [
                    'orderNumber' => $orderNumber,
                    'orderDate' => $orderDate,
                    'requiredDate' => $requiredDate,
                    'shippedDate' => null,
                    'status' => 'Pending',
                    'customerNumber' => $_SESSION['usuario']
                ];
                insertarDatos('orders', $insertOrderData);

                echo "<br>";
                echo "<b>orders</b><br>";
                echo "OrderNumber: $orderNumber <br>";
                echo "OrderDate: $orderDate <br>";
                echo "RequiredDate: $requiredDate <br>";
                echo "CustomerNumber: $orderNumber <br>";
                echo "<br>";

                $totalAmount = 0;

                // Insertar los detalles del pedido y actualizar el stock
                foreach ($_SESSION['carrito'] as $item) {
                    // Obtener el precio de compra del producto
                    $sql = "SELECT buyPrice FROM products WHERE productCode = :productCode";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindValue(':productCode', $item['productCode']);
                    $stmt->execute();
                    $buyPrice = $stmt->fetchColumn();

                    // Insertar detalle del pedido
                    $insertOrderDetails = [
                        'orderNumber' => $orderNumber,
                        'productCode' => $item['productCode'],
                        'quantityOrdered' => $item['quantity'],
                        'priceEach' => $buyPrice,
                        'orderLineNumber' => 1
                    ];
                    insertarDatos('orderdetails', $insertOrderDetails);

                    echo "<br>";
                    echo "<b>orderDetails</b><br>";
                    echo "OrderNumber: $orderNumber <br>";
                    echo "precio: $buyPrice <br>";
                    echo "<br>";

                    // Actualizar el stock del producto
                    $sql = "UPDATE products SET quantityInStock = quantityInStock - :quantity WHERE productCode = :productCode";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindValue(':quantity', $item['quantity']);
                    $stmt->bindValue(':productCode', $item['productCode']);
                    $stmt->execute();

                    // Calcular el total
                    $totalAmount += $buyPrice * $item['quantity'];
                }

                // Registrar el pago
                $checkNumber = $_POST['checkNumber'];
                $insertPaymentData = [
                    'customerNumber' => $_SESSION['usuario'],
                    'checkNumber' => $checkNumber,
                    'paymentDate' => $orderDate,
                    'amount' => $totalAmount
                ];
                insertarDatos('payments', $insertPaymentData);

                echo "<br>";
                echo "<b>payments</b><br>";
                echo $_SESSION['usuario'];
                echo "checkNumber: $checkNumber <br>";
                echo "paymentDate: $orderDate <br>";
                echo "amount: $totalAmount <br>";
                echo "<br>";

                // Vaciar el carrito
                $_SESSION['carrito'] = array();

                $conn->commit();

                echo "Pedido realizado con éxito. Total: $" . number_format($totalAmount, 2);
            }
            catch (PDOException $e) {
                $conn->rollBack();
                echo "Error al realizar el pedido: " . $e->getMessage();
            }
        }
    ?>
</body>
</html>
