<?php

    $decimal = (int)$_POST["dec"];
    $opcion = $_POST["op"];
    $binario = "";
    $octal = "";
    $hexadecimal = "";

    if ($opcion == "bin")
    {
        $binario = decbin($decimal);
    }
    elseif ($opcion == "octal")
    {
        $octal = decoct($decimal);
    }
    elseif ($opcion == "hex")
    {
        $hexadecimal = dechex($decimal);
    }
    elseif ($opcion == "todos")
    {
        $binario = decbin($decimal);
        $octal = decoct($decimal);
        $hexadecimal = dechex($decimal);
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor numerico</title>
</head>
<body>
    <h1>Conversor numerico</h1>

    <label for="decimal">Número Decimal:</label>
    <input type="number" name="dec" id="decimal" value="<?php echo htmlspecialchars($decimal); ?>" required>
    <br><br>

    <table border="1">
        <?php if ($opcion == "bin" || $opcion == "todos"): ?>
        <tr>
            <td>Binario</td>
            <td><?php echo htmlspecialchars($binario); ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($opcion == "octal" || $opcion == "todos"): ?>
        <tr>
            <td>Octal</td>
            <td><?php echo htmlspecialchars($octal); ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($opcion == "hex" || $opcion == "todos"): ?>
        <tr>
            <td>Hexadecimal</td>
            <td><?php echo htmlspecialchars($hexadecimal); ?></td>
        </tr>
        <?php endif; ?>
    </table>
</body>
</html>
