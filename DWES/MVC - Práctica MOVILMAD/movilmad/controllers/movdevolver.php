<?php
include_once "../controllers/gestionSesiones.php";

include_once "../db/conexionBBDD.php";
$conn = conexionBBDD();

include_once "../models/obtenerVehiculosAlquilados.php";
$resultado = obtenerVehiculosAlquilados($conn);

//Si pulsamos en devolver vehiculo
if(isset($_POST['devolver'])){
	$fechaDevolucion = date('Y-m-d H:i:s');
    $matricula = $_POST['vehiculos'];
    try {
        include_once "../models/obtenerHorasAlquiler.php";
        $res = obtenerHorasAlquiler($conn, $fechaDevolucion, $matricula);
		$horasAlquiler = $res['horas_alquiler'];
		if($horasAlquiler == 0){
			$horasAlquiler = 1;
		}

		$preciobase = $res['preciobase'];
		$precioTotal = $horasAlquiler * $preciobase;
		$_SESSION['precioTotal'] = $precioTotal;
		$_SESSION['matricula'] = $_POST['vehiculos'];

		include_once "../apiRedsys/apiRedsys.php";
		$miObj = new RedsysAPI;
	
		$fuc="263100000";
		$terminal="6";
		$moneda="978";
		$trans="0";
		$url="";
		$urlOKKO="http://192.168.206.212/DAW/DWES/MVC%20-%20Pr%c3%a1ctica%20MOVILMAD/movilmad/controllers/confirmar_pago.php";
		$id=time();
		$amount=$precioTotal*100;
		
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

        $mensaje = "Vehículo devuelto exitosamente. Precio total: $precioTotal €.";
    } catch (Exception $e) {
        $mensaje = "Error al devolver el vehículo: " . $e->getMessage();
    }
	$conn = null;
}

//Si pulsamos el boton volver
if(isset($_POST['volver'])){
	header("Location: movwelcome.php");
	exit();
}

include "../views/formularioDevolver.php";

$conn = null;
?>






