<?php
// Leer la entrada JSON
$entrada = file_get_contents('php://input');
$datos = json_decode($entrada, true);

$electrodomestico = $datos["electrodomestico"];

$data = [
    "Refrigerador" => 
        ["ancho" => "1m", 
        "altura" => "3m", 
        "fondo" => "500cm"], 
    "Lavadora" => 
        ["ancho" => "1m", 
        "altura" => "1m", 
        "fondo" => "400cm"],
    "Televisor" => 
        ["ancho" => "1.5m", 
        "altura" => "500cm", 
        "fondo" => "6cm"],
    "Horno" => 
        ["ancho" => "1m", 
        "altura" => "700m", 
        "fondo" => "400cm"],
    "Lavavajillas" => 
        ["ancho" => "1m", 
        "altura" => "1m", 
        "fondo" => "400cm"]
];

echo json_encode($data[$electrodomestico], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>
