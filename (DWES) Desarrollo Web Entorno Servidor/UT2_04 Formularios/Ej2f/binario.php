<?php
// Verificar si se está enviando una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["dec"]) && isset($_POST["op"])) {
    $decimal = (int)$_POST["dec"];
    $opcion = $_POST["op"];

    if (is_numeric($decimal) && $decimal >= 0) {
        echo "<h2>Resultados de la conversión para el número decimal: $decimal</h2>";
        // Conversión según la opción seleccionada
        if ($opcion == "bin") {
            echo "Binario: " . decbin($decimal) . "<br>";
        } elseif ($opcion == "octal") {
            echo "Octal: " . decoct($decimal) . "<br>";
        } elseif ($opcion == "hex") {
            echo "Hexadecimal: " . dechex($decimal) . "<br>";
        } elseif ($opcion == "todos") {
            echo "Binario: " . decbin($decimal) . "<br>";
            echo "Octal: " . decoct($decimal) . "<br>";
            echo "Hexadecimal: " . dechex($decimal) . "<br>";
        }
    } else {
        echo "Por favor, ingresa un número decimal válido (mayor o igual a 0).";
    }
} else {
    echo "Por favor, completa el formulario y selecciona una opción de conversión.";
}
?>
