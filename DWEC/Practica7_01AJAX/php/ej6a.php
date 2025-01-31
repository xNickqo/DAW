<?php
header("Content-Type: application/json");
$data = [
    "marcas" => ["Samsung", "LG", "Sony", "Whirlpool", "Bosch"],
    "electrodomesticos" => ["Refrigerador", "Lavadora","Televisor","Horno","Lavavajillas"
    ]
];
echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>