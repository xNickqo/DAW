<?php
    include_once "includes/apiRedsys.php";
    session_start();

    include('includes/funciones.php');

    if (!isset($_SESSION['usuario'])) {
        header("Location: pe_login.php");
        exit();
    }

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }

    // Agregar productos al carrito
    if (isset($_POST['agregar'])) {
        $productCode = $_POST['productCode'];
        $quantity = $_POST['quantity'];
        agregarProd($productCode, $quantity);
    }

    // Eliminar producto del carrito
    if (isset($_POST['eliminar'])) {
        $botonEliminar = $_POST['productCodeToRemove'];
        eliminarProductoDelCarrito($botonEliminar);
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

    <h3>Carrito de Compras</h3>
    <table border="1">
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Acción</th>
        </tr>
        <?php
            $conn = conexionBBDD();

            mostrarCarrito();
        ?>
    </table>

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

    <a href="pe_inicio.php">Volver al inicio</a><br><br>

    <?php
        if (isset($_POST['realizar_pedido'])){
            $sql = 'SELECT MAX(orderNumber) FROM orders';
            $orderNumber = ejecutarConsultaValor($sql);
            $orderNumber = (int)$orderNumber + 1;

            $totalAmount = realizarPedido($conn, $orderNumber);

            $miObj = new RedsysAPI;

            // Valores de entrada que no hemos cmbiado para ningun ejemplo
            $fuc="263100000";
            $terminal="15";
            $moneda="978";
            $trans="0";
            $url="";
            $urlOKKO="";
            $id=time();
            $amount=strval($totalAmount*100);	
            
            // Se Rellenan los campos
            $miObj->setParameter("DS_MERCHANT_AMOUNT", $amount);
            $miObj->setParameter("DS_MERCHANT_ORDER", $id);
            $miObj->setParameter("DS_MERCHANT_MERCHANTCODE", $fuc);
            $miObj->setParameter("DS_MERCHANT_CURRENCY", $moneda);
            $miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE", $trans);
            $miObj->setParameter("DS_MERCHANT_TERMINAL", $terminal);
            $miObj->setParameter("DS_MERCHANT_MERCHANTURL", $url);
            $miObj->setParameter("DS_MERCHANT_URLOK", $urlOKKO);
            $miObj->setParameter("DS_MERCHANT_URLKO", $urlOKKO);

            //Datos de configuración
            $version="HMAC_SHA256_V1";
            $kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';
            
            // Se generan los parámetros de la petición
            $request = "";
            $params = $miObj->createMerchantParameters();
            $signature = $miObj->createMerchantSignature($kc);

            ?>

            <form style="opacity: 0" id="formu" action="https://sis-t.redsys.es:25443/sis/realizarPago" method="POST" target="_blank">
                Ds_Merchant_SignatureVersion <input type="text" name="Ds_SignatureVersion" value="<?php echo $version; ?>"/></br>
                Ds_Merchant_MerchantParameters <input type="text" name="Ds_MerchantParameters" value="<?php echo $params; ?>"/></br>
                Ds_Merchant_Signature <input type="text" name="Ds_Signature" value="<?php echo $signature; ?>"/></br>
                <input type="submit" value="Enviar" >
            </form>
            
            <?php
            echo "<script type='text/javascript'>document.getElementById('formu').submit();</script>";
        }
    ?>
</body>
</html>
