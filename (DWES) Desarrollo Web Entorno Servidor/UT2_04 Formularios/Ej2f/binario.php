<?php

$binario = "";
$mostrarBinario = false;
$decimal = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["dec"]))
{
    $decimal = (int)$_POST["dec"];

    if (is_numeric($decimal) && $decimal >= 0)
    {
        $binario = decbin($decimal);
        $mostrarBinario = true;
    }
    else
    {
        $resultado = "Por favor, ingresa un número decimal válido (mayor o igual a 0).";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de Conversión</title>
</head>
<body>
    <h1>Conversor binario</h1>

    <form action="binario.php" method="post">
        Número Decimal: <input type="number" name="dec" value="<?php echo htmlspecialchars($decimal); ?>" required><br><br>

        <?php
        if ($mostrarBinario): ?>
            <label for="binario">Número Binario:</label>
            <input type="text" id="binario" value="<?php echo htmlspecialchars($binario); ?>" readonly><br><br>
        <?php endif; ?>

        <input type="submit" value="Enviar">
        <input type="reset" value="Borrar">
    </form>
</body>
</html>


