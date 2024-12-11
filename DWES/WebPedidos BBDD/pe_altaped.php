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
                        $sql = "SELECT productName FROM products WHERE productCode = :productCode";
                        $params = [':productCode' => $item['productCode']];
                        $productName = ejecutarConsulta($sql, $params, PDO::FETCH_ASSOC);
                        //var_dump($productName);
                        echo $productName[0]['productName'];
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
            //$_SESSION['carrito'] = array_values($_SESSION['carrito']);
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
            $sql = 'SELECT MAX(orderNumber) FROM orders';
            $orderNumber = ejecutarConsulta($sql)[0];
            $orderNumber = (int)$orderNumber + 1;

            $orderDate = date('Y-m-d');
            $requiredDate = $_POST['requiredDate'];

            $insertOrderData = [
                'orderNumber' => $orderNumber,
                'orderDate' => $orderDate,
                'requiredDate' => $requiredDate,
                'shippedDate' => null,
                'status' => 'Pending'
            ];
            insertarDatos('orders', $insertOrderData);


            // Insertar los detalles del pedido y actualizar el stock
            foreach ($_SESSION['carrito'] as $item) {
                $sql = "SELECT buyPrice FROM products WHERE productCode = :productCode";
                $params = array(':productCode' => $item['productCode']);
                $buyPrice = ejecutarConsulta($sql, $params)[0];

                $productCodee = $item['productCode'];
                $quantity = $item['quantity'];
                // Insertar detalle del pedido
                $insertOrderDetails = [
                    'orderNumber' => $orderNumber,
                    'productCode' => $productCodee,
                    'quantityOrdered' => $quantity,
                    'priceEach' => $buyPrice,
                    'orderLineNumber' => null
                ];
                insertarDatos('orderdetails', $insertOrderDetails);

                // Actualizar el stock del producto
                $sql = "UPDATE products SET quantityInStock = quantityInStock - :quantity WHERE productCode = :productCode";
                $params = array(
                    ':quantity' => $item['quantity'], 
                    ':productCode' => $item['productCode']
                );
                ejecutarConsulta($sql, $params);

                // Calcular el total
                $totalAmount = 0;
                $totalAmount += $buyPrice * $item['quantity'];
            }


            $customerNumber = $_SESSION['usuario'];
            $checkNumber = $_POST['checkNumber'];

            // Registrar el pago
            $insertPaymentData = [
                'customerNumber' => $customerNumber,
                'checkNumber' => $checkNumber,
                'paymentDate' => $orderDate,
                'amount' => $totalAmount
            ];
            insertarDatos('payments', $insertPaymentData);

            // Vaciar el carrito
            $_SESSION['carrito'] = array();

            echo "Pedido realizado con éxito. Total: $" . number_format($totalAmount, 2);
        }
    ?>
</body>
</html>
