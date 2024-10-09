<?php

$decimal = isset($_POST["dec"]) ? (int)$_POST["dec"] : 0;
$opcion = isset($_POST["op"]) ? $_POST["op"] : '';

$binario = "";
$octal = "";
$hexadecimal = "";

if (!empty($opcion))
{
    if (is_numeric($decimal) && $decimal >= 0)
    {
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
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor numérico</title>
</head>
<body>
    <h1>Conversor numérico</h1>

    <?php if (empty($opcion)): ?>

        <form action="" method="post">
            <label>Número Decimal:</label>
            <input type="number" name="dec" id="decimal" value="<?php echo htmlspecialchars($decimal); ?>" required>
            <br><br>

            <label>Convertir a:</label><br>
            <input type="radio" name="op" value="bin"> Binario <br>
            <input type="radio" name="op" value="octal"> Octal <br>
            <input type="radio" name="op" value="hex"> Hexadecimal <br>
            <input type="radio" name="op" value="todos"> Todos los sistemas <br><br>

            <input type="submit" value="Enviar">
            <input type="reset" value="Borrar">
        </form>

    <?php else: ?>

        <label for="decimal">Número Decimal:</label>
        <input type="number" name="dec" id="decimal" value="<?php echo htmlspecialchars($decimal); ?>" required>
        <br><br>

        <table border="1">
            <tr>
                <td>Decimal</td>
                <td><?php echo htmlspecialchars($decimal); ?></td>
            </tr>
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

    <?php endif; ?>
    
</body>
</html>
