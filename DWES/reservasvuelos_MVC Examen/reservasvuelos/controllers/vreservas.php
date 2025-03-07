<?php
include_once "../controllers/gestionSesiones.php";
include_once "../controllers/error.php";

include_once "../db/vconfig.php";
$conn = conexionBBDD();

include_once "../models/obtenerVuelos.php";
$vuelos = obtenerVuelos($conn);

// Inicializar carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

//Añadir al carrito
if (isset($_POST['agregar'])) {
    
    $numAsientos = (int)$_POST['asientos'];

    //$vuelosVal = unserialize(htmlspecialchars_decode($_POST['vuelos']));
    $vuelosVal = explode("|", $_POST['vuelos']);
    
    // Verificamos que la separación se haya hecho correctamente
    if (count($vuelosVal) === 7) {
        $vueloData = [
            'id_vuelo' => $vuelosVal[0],
            'origen' => $vuelosVal[1],
            'destino' => $vuelosVal[2],
            'fechahorasalida' => $vuelosVal[3],
            'fechahorallegada' => $vuelosVal[4],
            'precio_asiento' => $vuelosVal[5],
            'asientos_disponibles' => $vuelosVal[6],
            'asientos' => $numAsientos
        ];

        // Verificar si el vuelo ya está en el carrito
        $exists = false;
        foreach ($_SESSION['carrito'] as $i => $vuelo) {
            if ($vuelo['id_vuelo'] === $vuelosVal[0]) {
                if (($vuelo['asientos'] + $numAsientos) > $vuelo['asientos_disponibles']) {
                    trigger_error("Error: No hay suficientes asientos disponibles en este vuelo.", E_USER_WARNING);
                } else {
                    $_SESSION['carrito'][$i]['asientos'] += $numAsientos;
                }
                $exists = true;
                break;
            }
        }

        // Si no existe en el carrito, agregarlo
        if (!$exists) {
            $_SESSION['carrito'][] = $vueloData;
        }

    } else {
        trigger_error("Error al procesar el vuelo seleccionado.", E_USER_WARNING);
    }
}

// Calcular el precio total del carrito
$totalPrice = 0;
foreach ($_SESSION['carrito'] as $vuelo) {
    $totalPrice += $vuelo['precio_asiento'] * $vuelo['asientos'];
}

// Vaciar carrito
if (isset($_POST['vaciar'])) {
    $_SESSION['carrito'] = [];
    $totalPrice = 0;
}

// Procesar compra
if (isset($_POST['comprar']) && !empty($_SESSION['carrito'])) {
	include_once "../models/insertarReserva.php";
	include_once "../models/obtenerMaxId.php";
    include_once "../models/updateAsientos.php";

    try{
        $conn->beginTransaction();

        $id_reserva = obtenerMaxId($conn);

        $numero = substr($id_reserva, 1); 
        $numero = (int)$numero + 1;
        $id_reserva = 'R' . str_pad($numero, 4, '0', STR_PAD_LEFT);


        foreach ($_SESSION['carrito'] as $i => $vuelo) {
            $id_vuelo = $_SESSION['carrito'][$i]['id_vuelo'];
            $asientos = $_SESSION['carrito'][$i]['asientos'];
            $precioReserva = $asientos * $_SESSION['carrito'][$i]['precio_asiento'];

            //Insertar datos de la reserva
            insertarReserva(
                $conn, 
                $id_reserva, 
                $id_vuelo, 
                $_SESSION['usuario']['dni'],
                $asientos, 
                $precioReserva
            );

            //Actualizar asientos disponibles
            updateAsientos($conn, $id_vuelo, $asientos);

            //Actualizar al nuevo numero de id_reserva
            $numero = substr($id_reserva, 1); 
            $numero = (int)$numero + 1;
            $id_reserva = 'R' . str_pad($numero, 4, '0', STR_PAD_LEFT);
        }

        echo "Reserva realizada con exito";

        $conn->commit();

        // Limpiar el carrito después de la compra
        $_SESSION['carrito'] = [];

        $totalPrice = 0;
    }catch(Exception $e){
        $conn->rollBack();
        trigger_error("Error en la compra: " . $e->getMessage(), E_USER_WARNING);
    }
}

if (isset($_POST['volver'])) {
    header("Location: ../controllers/vinicio.php");
    exit();
}

include_once "../views/formReserva.php";

$conn = null;
?>


