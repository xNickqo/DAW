<?php

session_start();

include_once "apiRedsys/apiRedsys.php";
$miObj = new RedsysAPI;

include_once "../db/conexionBBDD.php";
$conn = conexionBBDD();

$fechaDevolucion = date('Y-m-d H:i:s');
$precioTotal = $_SESSION['precioTotal'];
$matricula = $_SESSION['matricula'];

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
		include_once "../models/actualizarAlquileres.php";
		actualizarAlquileres($conn, $fechaDevolucion, $precioTotal, $matricula);
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
			include_once "../models/actualizarAlquileres.php";
			actualizarAlquileres($conn, $fechaDevolucion, $precioTotal, $matricula);
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
