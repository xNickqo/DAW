<?php
    session_start();

    include_once "includes/apiRedsys.php";

    include "includes/1_funcionesModelo.php";
    include "includes/2_funcionesVista.php";
    include "includes/3_funcionesControlador.php";

    if (!isset($_SESSION['usuario'])) {
        header("Location: pe_login.php");
        exit();
    }

    if (!isset($_SESSION['carrito']))
        $_SESSION['carrito'] = array();

    // Agregar productos al carrito
    if (isset($_POST['agregar']))
        agregarProductoAlCarrito();

    // Eliminar producto del carrito
    if (isset($_POST['eliminar']))
        eliminarProductoDelCarrito();

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
            foreach ($_SESSION['carrito'] as $item) {
                $productName = obtenerNombreProducto($conn, $item['productCode']);
                imprimirCarrito($productName, $item['quantity'], $item['productCode']);
            }
        ?>

    </table>

    <h3>Realizar Pedido</h3>
    <form method="POST">
        <label for="checkNumber">Número de Pago:</label>
        <input type="text" name="checkNumber" required>
        <br>
        <label for="requiredDate">Fecha de Solicitud:</label>
        <input type="date" name="requiredDate" value="<?php echo date('Y-m-d'); ?>" required>
        <br>
        <input type="submit" name="realizar_pedido" value="Confirmar Pedido">
    </form>

    <br><br><a href="pe_inicio.php">Volver al inicio</a><br><br>

    <?php
        if (isset($_POST['realizar_pedido'])){
            // Generar un nuevo numero de pedido
            $orderNumber = generarNumeroPedido($conn);

            // Obtener el precio total de la compra
            $totalAmount = precioTotal($conn);

            $_SESSION['orderNumber'] = $orderNumber;
            $_SESSION['totalAmount'] = $totalAmount;
            $_SESSION['checkNumber'] = $_POST['checkNumber'];
            $_SESSION['requiredDate'] = $_POST['requiredDate'];

            //Llamamos al objeto de la api de Redsys
            $miObj = new RedsysAPI;
            
            //Calcular el parámetro Ds_MerchantParameters
            $fuc="263100000";
            $terminal="5";
            $moneda="978";
            $trans="0";
            $url="";
	        $urlOKKO="http://localhost/DAW/DWES/WebPedidos%20BBDD/confirmar_pago.php";
            $id=time();
            $amount=strval($totalAmount*100);	
            
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
            
            //Se generan los parámetros de la petición
            $request = "";
            $params = $miObj->createMerchantParameters();
            $signature = $miObj->createMerchantSignature($kc);

            ?>

            <form style="opacity: 0" id="formu" action="https://sis-t.redsys.es:25443/sis/realizarPago" method="POST" >
                Ds_Merchant_SignatureVersion <input type="text" name="Ds_SignatureVersion" value="<?php echo $version; ?>"/></br>
                Ds_Merchant_MerchantParameters <input type="text" name="Ds_MerchantParameters" value="<?php echo $params; ?>"/></br>
                Ds_Merchant_Signature <input type="text" name="Ds_Signature" value="<?php echo $signature; ?>"/></br>
                <input type="submit" value="Enviar" >
            </form>

            <script type="text/javascript">
                document.getElementById('formu').submit();
            </script>
            <?php
        }
    ?>
</body>
</html>
