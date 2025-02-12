<?php
//Leer el contenido de la peticion POST
$dato=fopen('php://input','r'); 
$valor=fgets($dato); 

// Cargar el XML recibido
$muestra=simplexml_load_string($valor);

$precios = array(
    "LG" => array(
        "40pulgadas" => "300€",
        "45pulgadas" => "400€",
        "50pulgadas" => "500€",
        "55pulgadas" => "600€"
    ),
    "Samsung" => array(
        "40pulgadas" => "320€",
        "45pulgadas" => "420€",
        "50pulgadas" => "520€",
        "55pulgadas" => "620€"
    ),
    "Sony" => array(
        "40pulgadas" => "340€",
        "45pulgadas" => "440€",
        "50pulgadas" => "540€",
        "55pulgadas" => "640€"
    ),
    "Panasony" => array(
        "40pulgadas" => "360€",
        "45pulgadas" => "460€",
        "50pulgadas" => "560€",
        "55pulgadas" => "660€"
    )
);

//Accedemos a los valores del XML por separado
$marca = trim($muestra->DatosTelevisores->marca);
$dimensiones = trim($muestra->DatosTelevisores->dimensiones);
$precio = $precios[$marca][$dimensiones];

header('Content-Type:text/xml'); 
echo "<datos><DatosTelevisores><marca>".$marca."</marca><dimensiones>".$dimensiones."</dimensiones><precio>".$precio."</precio></DatosTelevisores></datos>";
?>

