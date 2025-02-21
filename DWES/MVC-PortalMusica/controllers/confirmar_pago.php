<?php
include_once "../controllers/gestionSesiones.php";
include_once "../apiRedsys/apiRedsys.php";
$miObj = new RedsysAPI;

include_once "../db/conexionBBDD.php";
$conn = conexionBBDD();

echo "<pre> CARRITO: <br>";
print_r($_SESSION['carrito']);
echo "</pre>";

echo "<pre> USUARIO: <br>";
print_r($_SESSION['usuario']);
echo "</pre>";

echo "<pre> PRECIO TOTAL: <br>";
print_r($_SESSION['totalPrice']);
echo "</pre>";

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

				function obtenerMaxInvoiceId($conn) {
                    try {
                        $sql = "SELECT MAX(InvoiceId) FROM invoice";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $invoiceId = $stmt->fetchColumn();
                        $invoiceId = (int)$invoiceId + 1;
                        echo "Nuevo invoiceId ". $invoiceId . "<br>";
                        return $invoiceId;
                    } catch(PDOException $e) {
                        trigger_error("Error al obtener el nuevo id en la tabla invoice: ".$e->getMessage(), E_ERROR);
                    }
                }
				
				$invoiceId = obtenerMaxInvoiceId($conn);


				// Insertar la factura (Invoice)
				$sqlInvoice = "INSERT INTO Invoice(InvoiceId, CustomerId, InvoiceDate, BillingAddress, BillingCity, BillingState, BillingCountry, BillingPostalCode, Total) 
								VALUES (:invoiceId, :customerId, NOW(), :billingAddress, :billingCity, :billingState, :billingCountry, :billingPostalCode, :totalPrice)";
				
				$stmtInvoice = $conn->prepare($sqlInvoice);

				$stmtInvoice->bindValue(':invoiceId', $invoiceId, PDO::PARAM_INT);
				$stmtInvoice->bindValue(':customerId', $customerId, PDO::PARAM_INT);
				$stmtInvoice->bindValue(':billingAddress', $billingAddress, PDO::PARAM_STR);
				$stmtInvoice->bindValue(':billingCity', $billingCity, PDO::PARAM_STR);
				$stmtInvoice->bindValue(':billingState', $billingState, PDO::PARAM_STR);
				$stmtInvoice->bindValue(':billingCountry', $billingCountry, PDO::PARAM_STR);
				$stmtInvoice->bindValue(':billingPostalCode', $billingPostalCode, PDO::PARAM_STR);
				$stmtInvoice->bindValue(':totalPrice', $totalPrice, PDO::PARAM_STR);
				
				$stmtInvoice->execute();


				function obtenerMaxInvoiceLineId($conn) {
					try{
						$sql = "SELECT MAX(InvoiceLineId) FROM invoiceline";
						$stmt = $conn->prepare($sql);
						$stmt->execute();
						$invoiceLineId = $stmt->fetchColumn();
						$invoiceLineId = (int)$invoiceLineId + 1;
						echo "Nuevo invoiceLineId ". $invoiceLineId . "\n";
						return $invoiceLineId;
					} catch(PDOException $e) {
						trigger_error("Error al obtener el nuevo id en la tabla invoiceLine".$e->getMessage(), E_ERROR);
					}
				}

		
				$invoiceLineId = obtenerMaxInvoiceLineId($conn);
				$quantity = 1;
                
				// Insertar en invoiceLine
				$sqlInvoiceLine = "INSERT INTO InvoiceLine(InvoiceLineId, InvoiceId, TrackId, UnitPrice, Quantity) 
				VALUES (:invoiceLineId, :invoiceId, :trackId, :unitPrice, :quantity)";
				
				$stmtInvoiceLine = $conn->prepare($sqlInvoiceLine);

				foreach ($_SESSION['carrito'] as $item) {
					var_dump($invoiceLineId, $invoiceId, $item['TrackId'], $item['UnitPrice'], $quantity);

					$stmtInvoiceLine->bindValue(':invoiceLineId', $invoiceLineId, PDO::PARAM_INT);
					$stmtInvoiceLine->bindValue(':invoiceId', $invoiceId, PDO::PARAM_INT);
					$stmtInvoiceLine->bindValue(':trackId', $item['TrackId'], PDO::PARAM_INT);
					$stmtInvoiceLine->bindValue(':unitPrice', $item['UnitPrice'], PDO::PARAM_STR);
					$stmtInvoiceLine->bindValue(':quantity', $quantity, PDO::PARAM_INT);
					$stmtInvoiceLine->execute();
					$invoiceLineId++;
				}


                // Vaciar el carrito después de realizar la compra
                $_SESSION['carrito'] = [];

                $conn->commit();

                echo "Pago realizado con exito";
                echo "\nFactura generada correctamente.";
            } catch (PDOException $e) {
                $conn->rollBack();
                trigger_error("Error al procesar la factura: " . $e->getMessage(), E_USER_ERROR);
            }
        } else {
            echo "FIRMA KO";
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
