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

echo "<pre> ESTRUCTURA CANCIONES: <br>";
print_r($canciones[0]);
echo "</pre>";


if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if (isset($_POST['añadir'])) {
    //$track = unserialize(htmlspecialchars_decode($_POST['canciones']));

    // Separar los datos de la canción seleccionada usando explode()
    $trackData = explode("|", $_POST['canciones']);

    // Verificamos que la separación se haya hecho correctamente
    if (count($trackData) === 6) {
        $track = [
            'TrackId' => $trackData[0],
            'Name' => $trackData[1],
            'Composer' => $trackData[2],
            'Milliseconds' => $trackData[3],
            'Bytes' => $trackData[4],
            'UnitPrice' => $trackData[5]
        ];

        // Verificar si la canción ya está en el carrito (por el nombre de la canción)
        $exists = false;
        foreach ($_SESSION['carrito'] as $existingTrack) {
            if ($existingTrack['Name'] === $track['Name']) {
                $exists = true;
                break;
            }
        }

        // Si la canción no existe, añadirla al carrito
        if (!$exists) {
            $_SESSION['carrito'][] = $track;
        } else {
            trigger_error("La canción ya está en el carrito.", E_USER_WARNING);
        }

    } else {
        trigger_error("Error al procesar la canción seleccionada.", E_USER_WARNING);
    }
}


echo "<pre> CARRITO: <br>";
print_r($_SESSION['carrito']);
echo "</pre>";


// Calcular el precio total
$totalPrice = 0;
foreach ($_SESSION['carrito'] as $track) {
    $totalPrice += $track['UnitPrice'];
}

if (isset($_POST['comprar'])) {
    include_once "../apiRedsys/apiRedsys.php";
    $miObj = new RedsysAPI;

    $fuc="263100000";
    $terminal="42";
    $moneda="978";
    $trans="0";
    $url="";
    $urlOKKO="http://localhost/DAW/DWES/MVC-PortalMusica/controllers/confirmar_pago.php";
    $id=time();
    $amount=$totalPrice*100;

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

if(isset($_POST['vaciar'])){
    $_SESSION['carrito'] = [];
    
}

?>

<html>
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Descarga de música</title>
 </head>

<body>

    <form action="" method="post">
        <h2>Compra de caciones</h2>  
        Elije una canción 
        <select name="canciones" id="canciones">
            <option value="">Selecciona una canción</option>
            <?php
                foreach ($canciones as $track) {
                    //$trackValue = htmlspecialchars(serialize($_POST['canciones']));
                    $trackValue = $track["TrackId"] . "|" . $track["Name"] . "|" . $track["Composer"] . "|" . $track["Milliseconds"] . "|" . $track["Bytes"] . "|" . $track["UnitPrice"];
                    echo "<option value='".$trackValue."'>".$track["Name"]." | ".$track["Composer"]." | ".$track['Milliseconds']."ms | ".$track['Bytes']."Bytes | ".$track['UnitPrice']."€</option>";
                }
            ?>
        </select>

        <!-- Mostrar el carrito -->
        <?php 
            if (!empty($_SESSION['carrito'])) {
                echo '<ul>';
                foreach ($_SESSION['carrito'] as $track) {
                    echo '<li><b>' . $track['Name'] . '</b> | '. $track['UnitPrice'] . '€</li>';
                }
                echo '</ul>';
            } else {
                echo '<p>No hay canciones en el carrito.</p>';
            }
        ?>

        <br>
        <input type="submit" name="añadir" value="Añadir">
        <br>
        <input type="submit" name="vaciar" value="Vaciar Carrito">
        <br><br><br>

        <?php
            if(isset($totalPrice))
                echo "<b>Precio total: ".number_format($totalPrice, 2)."€</b>";
        ?>

        <br>
        <input type="submit" name="comprar" value="Comprar">
    </form>
    
    <a href="../controllers/inicio.php">Volver a la Página Principal</a><br>
    <a href="../controllers/logout.php">Cerrar Sesión</a>

</body>
</html>
