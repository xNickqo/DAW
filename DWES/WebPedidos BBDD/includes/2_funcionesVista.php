<?php

//Funcion para imprimir la tabla del carrito de compras
function imprimirCarrito($productName, $quantity, $productCode){
    echo "<tr>";
    echo "<td>" . htmlspecialchars($productName) . "</td>";
    echo "<td>" . htmlspecialchars($quantity) . "</td>";
    echo "<td>
            <form method='POST' action=''>
                <input type='hidden' name='productCodeToRemove' value='" . htmlspecialchars($productCode) . "'>
                <input type='submit' name='eliminar' value='Eliminar'>
            </form>
        </td>";
    echo "</tr>";
}

// Esta función imprime una tabla con los pedidos de un cliente
function imprimirPedidosPorCliente($pedidos, $customerNumber){
    if (!empty($pedidos)) {
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

        foreach ($pedidos as $pedido) {
            echo "<tr>
                    <td>" . htmlspecialchars($pedido['orderNumber']) . "</td>
                    <td>" . htmlspecialchars($pedido['orderDate']) . "</td>
                    <td>" . htmlspecialchars($pedido['status']) . "</td>
                    <td>" . htmlspecialchars($pedido['orderLineNumber']) . "</td>
                    <td>" . htmlspecialchars($pedido['productName']) . "</td>
                    <td>" . htmlspecialchars($pedido['quantityOrdered']) . "</td>
                    <td>" . number_format($pedido['priceEach'], 2) . "</td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "No se encontraron pedidos para este cliente.";
    }
}

// Esta función imprime la información de stock de un producto
function imprimirStockProducto($row){
    if ($row) {
        echo "<h3>Stock de Producto: " . htmlspecialchars($row['productName']) . "</h3>";
        echo "<p>Stock: " . htmlspecialchars($row['quantityInStock']) . "</p>";
    } else {
        echo "<p>Producto no encontrado.</p>";
    }
}

// Esta función imprime una tabla con los productos disponibles en una línea de productos
function imprimirStockPorLinea($productos, $productLine) {
    if (count($productos) > 0) {
        echo "<h3>Stock de Productos en la Línea: " . htmlspecialchars($productLine) . "</h3>";
        echo "<table border='1'>";
        echo "<tr><th>Producto</th><th>Cantidad en Stock</th></tr>";

        foreach ($productos as $producto) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($producto['productName']) . "</td>";
            echo "<td>" . htmlspecialchars($producto['quantityInStock']) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No se encontraron productos en la línea seleccionada.</p>";
    }
}

// Esta función imprime una tabla con los pagos realizados por el cliente
function imprimirPagos($pagos) {
    if (count($pagos) > 0) {
        echo "<h3>Pagos Realizados</h3>";
        echo "<table border='1'>";
        echo "<tr><th>Fecha</th><th>Número de Pago</th><th>Importe</th></tr>";

        $totalAmount = 0;

        foreach ($pagos as $pago) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($pago['paymentDate']) . "</td>";
            echo "<td>" . htmlspecialchars($pago['checkNumber']) . "</td>";
            echo "<td>$" . number_format($pago['amount'], 2) . "</td>";
            echo "</tr>";

            $totalAmount += $pago['amount'];
        }

        echo "</table>";
        echo "<p><b>Total Pagado:</b> $" . number_format($totalAmount, 2) . "</p>";
    } else {
        echo "<p>No se encontraron pagos para el cliente seleccionado en el rango de fechas proporcionado.</p>";
    }
}

// Esta función imprime una tabla con las unidades vendidas de productos en un rango de fechas específico
function imrpimirUnidadesVendidas($result) {
    if ($result && count($result) > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Producto</th><th>Unidades Vendidas</th></tr>";

        foreach ($result as $row) {
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


// Función para imprimir los datos de la tabla "orders"
function imprimirDatosOrder($orderNumber, $orderDate, $requiredDate) {
    echo "<br>";
    echo "<b>orders</b><br>";
    echo "OrderNumber: $orderNumber <br>";
    echo "OrderDate: $orderDate <br>";
    echo "RequiredDate: $requiredDate <br>";
    echo "shippedDate: null<br>";
    echo "status: Pending<br>";
    echo "CustomerNumber:". $_SESSION['usuario'] . "<br>";
    echo "<br><br>";
}


// Función para imprimir los datos de la tabla "orderdetails"
function imprimirDatosOrderDetails($orderNumber, $productCode, $quantity , $buyPrice, $orderLineNumber) {
    echo "<br>";
    echo "<b>orderDetails</b><br>";
    echo "OrderNumber: $orderNumber <br>";
    echo "productCode: ". $productCode . "<br>";
    echo "quantityOrdered: ". $quantity . "<br>";
    echo "buyPrice: $buyPrice <br>";
    echo "orderLineNumber: $orderLineNumber";
    echo "<br><br>";
}


// Función para imprimir los datos de la tabla "payments"
function imprimirDatosPayment($customerNumber, $checkNumber, $orderDate, $totalAmount) {
    echo "<br>";
    echo "<b>payments</b><br>";
    echo "CustomerNumber: $customerNumber <br>";
    echo "checkNumber: $checkNumber <br>";
    echo "paymentDate: $orderDate <br>";
    echo "amount: $totalAmount <br>";
    echo "<br><br>";
}
?>