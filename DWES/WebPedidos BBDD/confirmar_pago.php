<?php
include_once "includes/apiRedsys.php";
include('includes/funciones.php');
include "includes/1_funcionesModelo.php";
include "includes/2_funcionesVista.php";
include "includes/3_funcionesControlador.php";

session_start();

$orderNumber = $_SESSION['orderNumber'];
$totalAmount = $_SESSION['totalAmount'];
$checkNumber = $_SESSION['checkNumber'];
$requiredDate = $_SESSION['requiredDate'];

$miObj = new RedsysAPI;

$conn = conexionBBDD();

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
        try {
			$conn->beginTransaction();
	
			$orderDate = date('Y-m-d');
	
			// Insertar datos del pedido
			$sqlOrder = "INSERT INTO orders (orderNumber, orderDate, requiredDate, shippedDate, status, customerNumber) 
						 VALUES (:orderNumber, :orderDate, :requiredDate, NULL, 'Pending', :customerNumber)";
			$stmt = $conn->prepare($sqlOrder);
			$stmt->bindValue(':orderNumber', $orderNumber);
			$stmt->bindValue(':orderDate', $orderDate);
			$stmt->bindValue(':requiredDate', $requiredDate);
			$stmt->bindValue(':customerNumber', $_SESSION['usuario']);
			$stmt->execute();

			imprimirDatosOrder($orderNumber, $orderDate, $requiredDate);
	
			$totalAmount = 0;
			$orderLineNumber = 1;
			// Insertar los detalles del pedido y actualizar el stock
			foreach ($_SESSION['carrito'] as $item) {
				// Obtener el precio de compra del producto
				$sql = "SELECT buyPrice FROM products WHERE productCode = :productCode";
				
				try {
					$stmt = $conn->prepare($sql);
					$stmt->bindValue(':productCode', $item['productCode']);
					$stmt->execute();
					$buyPrice = $stmt->fetchColumn();
				} catch (Exception $e) {
					throw new PDOException("Error al obtener el precio del producto: " . $e->getMessage());
				}
				
				// Insertar detalle del pedido
				$sql = "INSERT INTO orderdetails (orderNumber, productCode, quantityOrdered, priceEach, orderLineNumber) 
						VALUES (:orderNumber, :productCode, :quantityOrdered, :priceEach, :orderLineNumber)";
				$stmtDetails = $conn->prepare($sql);
				$stmtDetails->bindValue(':orderNumber', $orderNumber);
				$stmtDetails->bindValue(':productCode', $item['productCode']);
				$stmtDetails->bindValue(':quantityOrdered', $item['quantity']);
				$stmtDetails->bindValue(':priceEach', $buyPrice);
				$stmtDetails->bindValue(':orderLineNumber', $orderLineNumber);
				$stmtDetails->execute();

				imprimirDatosOrderDetails($orderNumber,  $item['productCode'], $item['quantity'], $buyPrice, $orderLineNumber);
	
				// Actualizar el stock del producto
				$sql = "UPDATE products SET quantityInStock = quantityInStock - :quantity WHERE productCode = :productCode";
				$stmt = $conn->prepare($sql);
				$stmt->bindValue(':quantity', $item['quantity']);
				$stmt->bindValue(':productCode', $item['productCode']);
				$stmt->execute();
	
				// Calcular el total
				$totalAmount += $buyPrice * $item['quantity'];
				$orderLineNumber++;
			}
	
			// Registrar el pago
			$sqlPayment = "INSERT INTO payments (customerNumber, checkNumber, paymentDate, amount) 
						   VALUES (:customerNumber, :checkNumber, :paymentDate, :amount)";
			$stmtPayment = $conn->prepare($sqlPayment);
			$stmtPayment->bindValue(':customerNumber', $_SESSION['usuario']);
			$stmtPayment->bindValue(':checkNumber', $checkNumber);
			$stmtPayment->bindValue(':paymentDate', $orderDate);
			$stmtPayment->bindValue(':amount', $totalAmount);
			$stmtPayment->execute();

			imprimirDatosPayment($_SESSION['usuario'], $checkNumber, $orderDate, $totalAmount);
	
			// Vaciar el carrito
			$_SESSION['carrito'] = array();
	
			$conn->commit();
	
			echo "Pedido realizado con éxito. Total: $" . number_format($totalAmount, 2);
		} catch (PDOException $e) {
			$conn->rollBack();
			echo "Error al realizar el pedido: " . $e->getMessage();
		}

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
			try {
				$conn->beginTransaction();
		
				$orderDate = date('Y-m-d');
		
				// Insertar datos del pedido
				$sqlOrder = "INSERT INTO orders (orderNumber, orderDate, requiredDate, shippedDate, status, customerNumber) 
							 VALUES (:orderNumber, :orderDate, :requiredDate, NULL, 'Pending', :customerNumber)";
				$stmt = $conn->prepare($sqlOrder);
				$stmt->bindValue(':orderNumber', $orderNumber);
				$stmt->bindValue(':orderDate', $orderDate);
				$stmt->bindValue(':requiredDate', $requiredDate);
				$stmt->bindValue(':customerNumber', $_SESSION['usuario']);
				$stmt->execute();
	
				imprimirDatosOrder($orderNumber, $orderDate, $requiredDate);
		
				$totalAmount = 0;
				$orderLineNumber = 1;
				// Insertar los detalles del pedido y actualizar el stock
				foreach ($_SESSION['carrito'] as $item) {
					// Obtener el precio de compra del producto
					$sql = "SELECT buyPrice FROM products WHERE productCode = :productCode";
					
					try {
						$stmt = $conn->prepare($sql);
						$stmt->bindValue(':productCode', $item['productCode']);
						$stmt->execute();
						$buyPrice = $stmt->fetchColumn();
					} catch (Exception $e) {
						throw new PDOException("Error al obtener el precio del producto: " . $e->getMessage());
					}
					
					// Insertar detalle del pedido
					$sql = "INSERT INTO orderdetails (orderNumber, productCode, quantityOrdered, priceEach, orderLineNumber) 
							VALUES (:orderNumber, :productCode, :quantityOrdered, :priceEach, :orderLineNumber)";
					$stmtDetails = $conn->prepare($sql);
					$stmtDetails->bindValue(':orderNumber', $orderNumber);
					$stmtDetails->bindValue(':productCode', $item['productCode']);
					$stmtDetails->bindValue(':quantityOrdered', $item['quantity']);
					$stmtDetails->bindValue(':priceEach', $buyPrice);
					$stmtDetails->bindValue(':orderLineNumber', $orderLineNumber);
					$stmtDetails->execute();
	
					imprimirDatosOrderDetails($orderNumber,  $item['productCode'], $item['quantity'], $buyPrice, $orderLineNumber);
		
					// Actualizar el stock del producto
					$sql = "UPDATE products SET quantityInStock = quantityInStock - :quantity WHERE productCode = :productCode";
					$stmt = $conn->prepare($sql);
					$stmt->bindValue(':quantity', $item['quantity']);
					$stmt->bindValue(':productCode', $item['productCode']);
					$stmt->execute();
		
					// Calcular el total
					$totalAmount += $buyPrice * $item['quantity'];
					$orderLineNumber++;
				}
		
				// Registrar el pago
				$sqlPayment = "INSERT INTO payments (customerNumber, checkNumber, paymentDate, amount) 
							   VALUES (:customerNumber, :checkNumber, :paymentDate, :amount)";
				$stmtPayment = $conn->prepare($sqlPayment);
				$stmtPayment->bindValue(':customerNumber', $_SESSION['usuario']);
				$stmtPayment->bindValue(':checkNumber', $checkNumber);
				$stmtPayment->bindValue(':paymentDate', $orderDate);
				$stmtPayment->bindValue(':amount', $totalAmount);
				$stmtPayment->execute();
	
				imprimirDatosPayment($_SESSION['usuario'], $checkNumber, $orderDate, $totalAmount);
		
				// Vaciar el carrito
				$_SESSION['carrito'] = array();
		
				$conn->commit();
		
				echo "Pedido realizado con éxito. Total: $" . number_format($totalAmount, 2);
			} catch (PDOException $e) {
				$conn->rollBack();
				echo "Error al realizar el pedido: " . $e->getMessage();
			}

		} else {
			echo "FIRMA KO";
		}

	} else {
		die("No se recibió respuesta");
	}
}

?>
<html>
	<body>
		<br><br><a href="pe_inicio.php">Volver al inicio</a><br><br>
	</body>
</html>
