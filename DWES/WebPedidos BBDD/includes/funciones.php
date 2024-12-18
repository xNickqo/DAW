<?php
function conexionBBDD(){
    try{
        $conn = new PDO("mysql:host=localhost;dbname=pedidos", "root", "rootroot");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }catch(PDOException $e){
        echo "Error en la conexion: " . $e->getMessage();
        return null;
    }
}

/* Funcion para ingresar datos, recibe como parametros el nombre de la tabla,
 un array assoc que seran los campos con los valores a introducir y devolvera el 
 ultimo ID insertado
 
 Ejemplo de uso:
    $idProducto = 'P001';
    $nombreProducto = 'Pelota';
    $precio = 10.99;
    $idCategoria = 'C001';

    insertarDatos('producto', [
        'ID_PRODUCTO' => $idProducto,
        'NOMBRE' => $nombreProducto,
        'PRECIO' => $precio,
        'ID_CATEGORIA' => $idCategoria,
    ]);

    echo "Producto insertado exitosamente.";
*/
function insertarDatos($tabla, $camposValores) {
    try {
        $conn = conexionBBDD();

        $columnas = implode(', ', array_keys($camposValores));
        $placeholders = ':' . implode(', :', array_keys($camposValores));

        $sql = "INSERT INTO $tabla ($columnas) VALUES ($placeholders)";
        $stmt = $conn->prepare($sql);

        foreach ($camposValores as $campo => $valor) {
            $stmt->bindValue(':' . $campo, $valor);
        }

        $stmt->execute();
        echo "Datos insertados correctamente";
    } catch (PDOException $e) {
        echo "Error al insertar datos: " . $e->getMessage();
    }
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

/* Funcion que ejecutara cualquier consulta select dando la opcion de como devuelve los datos
Ejemplo de uso:
  -CONSULTA BASICA
    $sql = "SELECT * FROM producto";
    $resultado = ejecutarConsulta($sql);
    
  -CONSULTA CON WHERE  
    $sql = "SELECT * FROM producto WHERE ID_PRODUCTO = :id";
    $parametros = [':id' => 10];
    $resultado = ejecutarConsulta($sql, $parametros);
    
  -CONSULTA CON JOIN
    $sql = "
        SELECT p.NOMBRE AS nombre_producto, c.NOMBRE AS nombre_categoria
        FROM producto p
        INNER JOIN categoria c ON p.ID_CATEGORIA = c.ID_CATEGORIA
        WHERE p.ID_PRODUCTO = :id_producto";
    $parametros = [':id_producto' => $id_producto];
    $resultados = ejecutarConsulta($sql, $parametros);  
    
SI NECESITAS DEVOLVER LOS DATOS DE OTRO TIPO SOLO DEBERAS ESPECIFICARLO EN FETCHMODE*/
function ejecutarConsultaValores($sql, $parametros = [], $fetchMode = PDO::FETCH_ASSOC) {
    $conn = conexionBBDD();

    try {
        $stmt = $conn->prepare($sql);
        foreach ($parametros as $clave => $valor) {
            $stmt->bindValue($clave, $valor);
        }
        $stmt->execute();
        return $stmt->fetchAll($fetchMode);
    } catch (Exception $e) {
        die("Error en la consulta: " . $e->getMessage());
    }
}

// Devuelve el primer valor de la primera columna
function ejecutarConsultaValor($sql, $parametros = []) {
    $conn = conexionBBDD();

    try {
        $stmt = $conn->prepare($sql);
        foreach ($parametros as $clave => $valor) {
            $stmt->bindValue($clave, $valor);
        }
        $stmt->execute();

        return $stmt->fetchColumn();
    } catch (Exception $e) {
        die("Error en la consulta: " . $e->getMessage());
    }
}


// Agrega los productos al carrito, en el caso de estar repetidos se agrupa la cantidad
function agregarProd($productCode, $quantity){
    $existe = false;

    // Verificar si el producto ya existe en el carrito, si existe sumamos la cantidad
    foreach ($_SESSION['carrito'] as &$item) {
        if ($item['productCode'] === $productCode) {
            $item['quantity'] += $quantity;
            $existe = true;
            break;
        }
    }

    // Si no existe lo añadimos al carrito
    if (!$existe) {
        $_SESSION['carrito'][] = array(
            'productCode' => $productCode,
            'quantity' => $quantity
        );
    }

    //var_dump($_SESSION['carrito']);
}

// Funcion para eliminar el producto al pulsar el boton
function eliminarProductoDelCarrito($botonEliminar){
    foreach ($_SESSION['carrito'] as $index => $item) {
        if ($item['productCode'] == $botonEliminar) {
            unset($_SESSION['carrito'][$index]);
            break;
        }
    }
    $_SESSION['carrito'] = array_values($_SESSION['carrito']);
    //var_dump($_SESSION['carrito']);
}


// Función para mostrar la tabla de productos en el carrito
function mostrarCarrito() {
    foreach ($_SESSION['carrito'] as $item) {
        $sql = "SELECT productName FROM products WHERE productCode = :productCode";
        $parametros = array('productCode' => $item['productCode']);
        $productName = ejecutarConsultaValor($sql, $parametros);
        
        echo "<tr>";
        echo "<td>" . $productName . "</td>";
        echo "<td>" . $item['quantity'] . "</td>";
        echo "<td>
                <form method='POST' action=''>
                    <input type='hidden' name='productCodeToRemove' value='" . $item['productCode'] . "'>
                    <input type='submit' name='eliminar' value='Eliminar'>
                </form>
            </td>";
        echo "</tr>";
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
    echo "<br>";
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
    echo "<br>";
}

// Función para imprimir los datos de la tabla "payments"
function imprimirDatosPayment($customerNumber, $checkNumber, $orderDate, $totalAmount) {
    echo "<br>";
    echo "<b>payments</b><br>";
    echo "CustomerNumber: $customerNumber <br>";
    echo "checkNumber: $checkNumber <br>";
    echo "paymentDate: $orderDate <br>";
    echo "amount: $totalAmount <br>";
    echo "<br>";
}

// Función para actualizar el stock de un producto
function actualizarStockProducto($conn, $productCode, $quantity) {
    $sql = "UPDATE products SET quantityInStock = quantityInStock - :quantity WHERE productCode = :productCode";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':quantity', $quantity);
    $stmt->bindValue(':productCode', $productCode);
    $stmt->execute();
}

function realizarPedido($conn){
    try {
        $conn->beginTransaction();

        $sql = 'SELECT MAX(orderNumber) FROM orders';
        $orderNumber = ejecutarConsultaValor($sql);
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
        imprimirDatosOrder($orderNumber, $orderDate, $requiredDate);

        $totalAmount = 0;
        $orderLineNumber = 1;
        // Insertar los detalles del pedido y actualizar el stock
        foreach ($_SESSION['carrito'] as $item) {
            // Obtener el precio de compra del producto
            $sql = "SELECT buyPrice FROM products WHERE productCode = :productCode";
            $parametros = array('productCode' => $item['productCode']);
            $buyPrice = ejecutarConsultaValor($sql, $parametros);
            
            // Insertar detalle del pedido
            $insertOrderDetails = [
                'orderNumber' => $orderNumber,
                'productCode' => $item['productCode'],
                'quantityOrdered' => $item['quantity'],
                'priceEach' => $buyPrice,
                'orderLineNumber' => $orderLineNumber
            ];
            insertarDatos('orderdetails', $insertOrderDetails);
            imprimirDatosOrderDetails($orderNumber,  $item['productCode'], $item['quantity'], $buyPrice, $orderLineNumber);

            // Actualizar el stock del producto
            actualizarStockProducto($conn, $item['productCode'], $item['quantity']);

            // Calcular el total
            $totalAmount += $buyPrice * $item['quantity'];
            $orderLineNumber++;
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
        imprimirDatosPayment($_SESSION['usuario'], $checkNumber, $orderDate, $totalAmount);

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