<?php
include_once "includes/apiRedsys.php";
include('includes/funciones.php');

session_start();

$orderNumber = $_SESSION['orderNumber'];
$totalAmount = $_SESSION['totalAmount'];
$checkNumber = $_SESSION['checkNumber'];
$requiredDate = $_SESSION['requiredDate'];

$miObj = new RedsysAPI;

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

		$conn = conexionBBDD();
        realizarPedido($conn, $orderNumber, $requiredDate, $checkNumber);

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

			$conn = conexionBBDD();
			realizarPedido($conn, $orderNumber, $requiredDate, $checkNumber);

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
		<br><br><a href="pe_altaped.php">Volver a la pagina anterior</a><br><br>
	</body>
</html>
