<?php
include_once "../controllers/gestionSesiones.php";

echo "<pre> SESSION: <br>";
print_r($_SESSION['usuario']);
echo "</pre>";

include_once "../controllers/error.php";

include_once "../db/conexionBBDD.php";
$conn = conexionBBDD();

include_once "../models/obtenerAllTracks.php";
$canciones = obtenerAllTracks($conn);

/*
echo "<pre> ESTRUCTURA CANCIONES: <br>";
print_r($canciones[0]);
echo "</pre>";
*/

//Si el carrito no existe lo creamos
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

//Añadir canciones al carrito
if (isset($_POST['añadir'])) {
    //$track = unserialize(htmlspecialchars_decode($_POST['canciones']));

    // Separar los datos de la canción seleccionada usando explode()
    $trackData = explode("|", $_POST['canciones']);

    // Verificamos que la separación se haya hecho correctamente
    if (count($trackData) === 3) {

        $track = [
            'TrackId' => $trackData[0],
            'Name' => $trackData[1],
            'UnitPrice' => $trackData[2],
            'quantity' => 1
        ];

        // Verificar si la canción ya está en el carrito
        $exists = false;
        foreach ($_SESSION['carrito'] as &$existingTrack) { 
            if ($existingTrack['TrackId'] === $trackData[0]) {
                //Si ya existe en el carrito le sumamos la cantidad
                $existingTrack['quantity'] += 1;
                $exists = true;
                break;
            }
        }

        // Si la canción no existe en el carrito, agregarla
        if (!$exists) {
            $_SESSION['carrito'][] = $track;
        }

    } else {
        trigger_error("Error al procesar la canción seleccionada.", E_USER_WARNING);
    }
}

/*
echo "<pre> CARRITO: <br>";
print_r($_SESSION['carrito']);
echo "</pre>";
*/

// Calcular el precio total considerando la cantidad
$totalPrice = 0;
foreach ($_SESSION['carrito'] as $track) {
    $totalPrice += $track['UnitPrice'] * $track['quantity'];
}

// Compra con Redsys
if (isset($_POST['comprar']) && $totalPrice != 0) {
    include_once "../apiRedsys/apiRedsys.php";
    $miObj = new RedsysAPI;

    $fuc="263100000";
    $terminal="42";
    $moneda="978";
    $trans="0";
    $url="";
    $urlOKKO="http://localhost/DAW/DWES/MVC-PortalMusica/controllers/confirmar_pago.php";
    $id=time();
    $amount = $totalPrice*100;

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

    //Creamos una sesion nueva con el precioTotal para usarla en confirmar_compra.php
    $_SESSION['totalPrice'] = $totalPrice;

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

// Si pulsamos en el boton vaciar, se vaciara la sesion del carrito
if(isset($_POST['vaciar'])){
    $_SESSION['carrito'] = [];
    $totalPrice = 0;
}

// Vista
include_once "../views/formDownmusic.php";

$conn = null;
?>
