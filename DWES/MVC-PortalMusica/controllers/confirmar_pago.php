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
            $customerId = $_SESSION['usuario']['CustomerId'];
            $totalPrice = $_SESSION['totalPrice'];

            // Datos de facturación
            $billingAddress = $_SESSION['usuario']['Address'];
            $billingCity = $_SESSION['usuario']['City'];
            $billingState = $_SESSION['usuario']['State'];
            $billingCountry = $_SESSION['usuario']['Country'];
            $billingPostalCode = $_SESSION['usuario']['PostalCode'];

            try {
                $conn->beginTransaction();

				include_once "../models/obtenerMaxId.php";
				$invoiceId = obtenerMaxInvoiceId($conn);

				// Insertar en Invoice
                include_once "../models/insertarInvoice.php";
                insertarInvoice($conn, $invoiceId, $customerId, $billingAddress, $billingCity, $billingState, $billingCountry, $billingPostalCode, $totalPrice);

				$invoiceLineId = obtenerMaxInvoiceLineId($conn);

                // Recorrer el carrito y agregar las líneas de la factura en InvoiceLine
                include_once "../models/insertarInvoiceLine.php";
                foreach ($_SESSION['carrito'] as $item) {
                    insertarInvoiceLine($conn, $invoiceLineId, $invoiceId, $item['TrackId'], $item['UnitPrice'], $item['quantity']);
                    $invoiceLineId++;
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
