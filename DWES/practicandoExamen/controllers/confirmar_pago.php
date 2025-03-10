<?php
include_once "../controllers/gestionSesiones.php";
include_once "../apiRedsys/apiRedsys.php";
$miObj = new RedsysAPI;

/*
echo "<pre> CARRITO: <br>";
print_r($_SESSION['carrito']);
echo "</pre>";

echo "<pre> USUARIO: <br>";
print_r($_SESSION['usuario']);
echo "</pre>";

echo "<pre> PRECIO TOTAL: <br>";
print_r($_SESSION['totalPrice']);
echo "</pre>";
*/

if (!empty( $_POST ) ) {		
    $version = $_POST["Ds_SignatureVersion"];
    $datos = $_POST["Ds_MerchantParameters"];
    $signatureRecibida = $_POST["Ds_Signature"];

    $decodec = $miObj->decodeMerchantParameters($datos);	
    $kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'; //Clave recuperada de CANALES
    $firma = $miObj->createMerchantSignatureNotif($kc,$datos);	

    echo PHP_VERSION."<br/>";
    echo $firma."<br/>";
    echo $signatureRecibida."<br/>";

    if ($firma === $signatureRecibida){
        echo "Pago realizado con exito";
    } else {
        echo "FIRMA KO";
    }

} else {
    if (!empty( $_GET ) ) {
        $version = $_GET["Ds_SignatureVersion"];
        $datos = $_GET["Ds_MerchantParameters"];
        $signatureRecibida = $_GET["Ds_Signature"];	

        $decodec = $miObj->decodeMerchantParameters($datos);
        $kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'; //Clave recuperada de CANALES
        $firma = $miObj->createMerchantSignatureNotif($kc,$datos);

        if ($firma === $signatureRecibida){
            include_once "../db/conexionBBDD.php";
            $conn = conexionBBDD();

            // Datos del cliente y carrito
            $id_usuario = $_SESSION['usuario']['id'];
            $totalPrice = $_SESSION['totalPrice'];
            
            try {
                $conn->beginTransaction();

                include_once "../models/insertarPedido.php";
                insertarPedido($conn, $id_usuario, $totalPrice);

                $sql = "SELECT MAX(id) FROM pedidos";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $pedido_id = $stmt->fetch(PDO::FETCH_COLUMN);
                
                include_once "../models/insertarDetallePedido.php";
                include_once "../models/updateStock.php";
                foreach ($_SESSION['carrito'] as $item) {
                    $stock = $item['stock'];
                    $id_producto = $item['id'];
                    $precio_unidad = $item['precio'];
                    $cantidad = $item['cantidad'];

                    insertarDetallePedido($conn, $pedido_id, $id_producto, $cantidad, $precio_unidad * $cantidad);
                    updateStock($conn, $id_producto, $stock);
                }

                // Vaciar el carrito después de realizar la compra
                $_SESSION['carrito'] = [];

                $conn->commit();

                echo "Pago realizado con exito";
            } catch (PDOException $e) {
                $conn->rollBack();
                trigger_error("Error al procesar la factura: " . $e->getMessage(), E_USER_ERROR);
            }
            $conn = null;
        } else {
            trigger_error("Firma KO", E_USER_NOTICE);
        }
    } else {
        die("No se recibió respuesta");
    }
}

$conn = null;
?>
<html>
    <body>
        <br><br><a href="../controllers/inicio.php">Volver al inicio</a><br><br>
    </body>
</html>
