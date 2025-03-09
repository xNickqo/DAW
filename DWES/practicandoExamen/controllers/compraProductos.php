<?php
include_once "../controllers/gestionSesiones.php";
include_once "../controllers/error.php";
include_once "../db/conexionBBDD.php";
$conn = conexionBBDD();

try{
    $sql = "SELECT * FROM productos";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    trigger_error("Error en la obtencion de los productos: ".$e->getMessage(), E_USER_ERROR);
}


if(!isset($_SESSION['carrito'])){
    $_SESSION['carrito'] = array();
}

if(isset($_POST['añadir']) && !empty($_POST['productos'])){
    $producto_serializado = htmlspecialchars_decode($_POST['productos']);
    $prod = unserialize($producto_serializado);

    $exist = false;
    foreach($_SESSION['carrito'] as $i => $car){
        if($prod['id'] == $car['id']){
            if($_SESSION['carrito'][$i]['stock'] > 0)
                $_SESSION['carrito'][$i]['stock'] -= 1;
            else
                echo "Ya no queda stock de este producto";
            $_SESSION['carrito'][$i]['cantidad'] += 1;
            $exist = true;
            break;
        }
    }
    
    if(!$exist){
        $prod['cantidad'] = 1;
        $_SESSION['carrito'][] = $prod;
        echo "Producto añadido al carrito";
    }

    echo "CARRITO: <pre>";
    print_r($_SESSION['carrito']);
    echo "</pre>";

}

if(isset($_POST['vaciar'])){
    $_SESSION['carrito'] = array();
}

$precioTotal = 0;
foreach($_SESSION['carrito'] as $item){
    $precioTotal += $item['cantidad'] * $item['precio'];
}

if(isset($_POST['comprar']) && $precioTotal != 0){
    include_once "../apiRedsys/apiRedsys.php";
    $miObj = new RedsysAPI;

    $fuc="263100000";
    $terminal="42";
    $moneda="978";
    $trans="0";
    $url="";
    $urlOKKO="http://localhost/DAW/DWES/practicandoExamen/controllers/confirmar_pago.php";
    $id=time();
    $amount = $precioTotal*100;

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
    $_SESSION['totalPrice'] = $precioTotal;

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra de productos</title>
</head>
<body>
    <h1>Compra de productos</h1>
    <form action="" method="post">
        <label for="productos">Producto:</label>
        <select name="productos" id="productos">
            <option value="">Selecciona un producto</option>
            <?php
                foreach($res as $prod){
                    $carrito = htmlspecialchars(serialize($prod));
                    echo "<option value='$carrito'>"
                            .htmlspecialchars($prod['nombre'])." | "
                            .htmlspecialchars($prod['descripcion']) ." | "
                            .htmlspecialchars($prod['precio'])."€ | Stock"
                            .htmlspecialchars($prod['stock'])."
                        </option>";
                
                }
            ?>
        </select>
        <br>
        <?php
            if(!empty($_SESSION['carrito'])){
                echo "<ul>";
                foreach($_SESSION['carrito'] as $prod){
                    echo "<li>{$prod['nombre']} - {$prod['precio']}€</li>";
                }
                echo "</ul>";
            }
        ?>
        <br>
        
        <b>Precio total: <?php if(isset($precioTotal)) echo $precioTotal;?>€</b>
        
        <br>
        <input type="submit" name="añadir" value="Añadir">
        <input type="submit" name="vaciar" value="Vaciar">
        <input type="submit" name="comprar" value="Comprar">
    </form>
    <br>
    <a href="../controllers/inicio.php">Volver al inicio</a>
    <a href="../controllers/logout.php">Cerrar sesion</a>
</body>
</html>