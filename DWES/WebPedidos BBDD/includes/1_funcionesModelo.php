<?php
/* MODELO SE ENCARGA DE LA LOGICA DE DATOS Y LAS INTERACCIONES CON LA BBDD */


// Función que establece la conexión con la base de datos.
function conexionBBDD(){
    try{
        $conn = new PDO("mysql:host=localhost;dbname=pedidos", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }catch(PDOException $e){
        echo "Error en la conexion con la BBDD: " . $e->getMessage();
        return null;
    }
}

// Función que verifica si un usuario existe en la base de datos, dado su número de cliente.
function verificarUsuario($conn, $customerNumber) {
    $sql = "SELECT * FROM customers WHERE customerNumber = :customerNumber";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':customerNumber', $customerNumber);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función que obtiene el siguiente número de cliente disponible, basado en el mayor número de cliente registrado.
function consultarNumeroCliente($conn){
    $sql = "SELECT MAX(customerNumber) FROM customers";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $customerNumber = $stmt->fetchColumn();
    $customerNumber += 1;
    return $customerNumber;
}

// Función que inserta un nuevo registro de cliente en la base de datos.
function insertarRegistro($conn, $customerNumber, $customerName, $contactLastName, $contactFirstName, $phone, $address, $address2, $city, $stateCode, $postalCode, $country,$salesRepEmployeeNumber, $creditLimit){
    $sql = "INSERT INTO customers (customerNumber, customerName, contactLastName, contactFirstName, phone, addrebLine1, addrebLine2, city, state_code, postalCode, country, salesRepEmployeeNumber, creditLimit) 
            VALUES (:customerNumber, :customerName, :contactLastName, :contactFirstName, :phone, :addrebLine1, :addrebLine2, :city, :stateCode, :postalCode, :country, :salesRepEmployeeNumber, :creditLimit)";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':customerNumber', $customerNumber);
    $stmt->bindValue(':customerName', $customerName);
    $stmt->bindValue(':contactLastName', $contactLastName);
    $stmt->bindValue(':contactFirstName', $contactFirstName);
    $stmt->bindValue(':phone', $phone);
    $stmt->bindValue(':addrebLine1', $address);
    $stmt->bindValue(':addrebLine2', $address2);
    $stmt->bindValue(':city', $city);
    $stmt->bindValue(':stateCode', $stateCode);
    $stmt->bindValue(':postalCode', $postalCode);
    $stmt->bindValue(':country', $country);
    $stmt->bindValue(':salesRepEmployeeNumber', $salesRepEmployeeNumber);
    $stmt->bindValue(':creditLimit', $creditLimit);

    $stmt->execute();
}

// Función que genera el siguiente número de pedido disponible basado en el mayor número de pedido registrado.
function generarNumeroPedido($conn){
    $sql = 'SELECT MAX(orderNumber) FROM orders';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $orderNumber = $stmt->fetchColumn();
    $orderNumber = (int)$orderNumber + 1;
    return $orderNumber;
}

// Función que calcula el precio total de la compra en el carrito de compras.
function precioTotal($conn){
    $totalAmount = 0;
    foreach ($_SESSION['carrito'] as $item) {
        try {
            $sql = "SELECT buyPrice FROM products WHERE productCode = :productCode";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':productCode', $item['productCode']);
            $stmt->execute();
            $buyPrice = $stmt->fetchColumn();
        } catch (Exception $e) {
            die("Error en la consulta: " . $e->getMessage());
        }
        
        $totalAmount += $buyPrice * $item['quantity'];
    }
    return $totalAmount;
}

// Función que obtiene el nombre de un producto dado su código de producto.
function obtenerNombreProducto($conn, $productCode) {
    $sql = "SELECT productName FROM products WHERE productCode = :productCode";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':productCode', $productCode);
    $stmt->execute();
    return $stmt->fetchColumn();
}


/* Esta funcion imprimira las opciones de un select con la sentencia sql que le mandes
el value y el texto.
Ejemplo de uso:
        $sql = "SELECT ID_PRODUCTO, NOMBRE FROM producto";
        imprimirOpciones($sql, 'ID_PRODUCTO', 'NOMBRE');
        
        Se mostrara como:
            <option value="id_producto"> nombre </option>*/
function imprimirOpciones($sql, $valor, $texto) {
    $conn = conexionBBDD();

    $stmt = $conn->query($sql);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value='" . $row[$valor] . "'>" . $row[$texto] . "</option>";
    }
}

// Función que obtiene los pedidos de un cliente, dada su identificación.
function obtenerPedidosPorCliente($conn, $customerNumber) {
    $sql = "SELECT o.orderNumber, o.orderDate, o.status, od.orderLineNumber, p.productName, od.quantityOrdered, od.priceEach
            FROM orders o
            JOIN orderdetails od ON o.orderNumber = od.orderNumber
            JOIN products p ON od.productCode = p.productCode
            WHERE o.customerNumber = :customerNumber
            ORDER BY od.orderLineNumber";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':customerNumber', $customerNumber);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función que obtiene el stock de un producto dado su nombre.
function obtenerStockProducto($conn, $productName) {
    $sql = "SELECT productName, quantityInStock 
            FROM products WHERE productName = :productName";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':productName', $productName);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Función que obtiene el stock de productos de una línea de productos.
function obtenerStockPorLinea($conn, $productLine) {
    $sql = "SELECT productName, quantityInStock 
            FROM products 
            WHERE productLine = :productLine ORDER BY quantityInStock DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':productLine', $productLine);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función que obtiene los pagos realizados por un cliente en un rango de fechas específico.
function obtenerPagos($conn, $customerNumber, $startDate, $endDate){
    $sql = "SELECT paymentDate, checkNumber, amount 
            FROM payments 
            WHERE customerNumber = :customerNumber 
            AND paymentDate BETWEEN :startDate AND :endDate";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':customerNumber', $customerNumber);
    $stmt->bindValue(':startDate', $startDate);
    $stmt->bindValue(':endDate', $endDate);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función que obtiene las unidades vendidas de productos en un rango de fechas específico.
function obtenerUnidadesVendidas($conn, $startDate, $endDate) {
    $sql = "SELECT p.productName, SUM(od.quantityOrdered) AS totalSold 
            FROM orderdetails od
            JOIN orders o ON od.orderNumber = o.orderNumber
            JOIN products p ON od.productCode = p.productCode
            WHERE o.orderDate BETWEEN :startDate AND :endDate
            GROUP BY p.productName";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':startDate', $startDate);
    $stmt->bindValue(':endDate', $endDate);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>