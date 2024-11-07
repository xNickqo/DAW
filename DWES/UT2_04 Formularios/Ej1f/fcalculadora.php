<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        Operando 1: <input type="text" name="op1" value="' . htmlspecialchars($op1) . '"><br>
        Operando 2: <input type="text" name="op2" value="' . htmlspecialchars($op2) . '"><br>
        Selecciona operación: <br>
        <input type="radio" name="op" value="suma"> Suma <br>
        <input type="radio" name="op" value="resta"> Resta <br>
        <input type="radio" name="op" value="div"> División <br>
        <input type="radio" name="op" value="mult"> Multiplicación <br>
        <input type="submit" value="Enviar">
        <input type="reset" value="Borrar">
    </form>
</body>
</html>

<?php
    function procesarOperacion($op1, $op2, $operacion)
    {
        $resultado = 0;
        $signo = "";

        switch ($operacion)
        {
            case "suma":
                $resultado = $op1 + $op2;
                $signo = "+";
                break;

            case "resta":
                $resultado = $op1 - $op2;
                $signo = "-";
                break;

            case "div":
                if ($op2 != 0)
                {
                    $resultado = $op1 / $op2;
                    $signo = "/";
                }
                else
                    $resultado = "Error: División entre cero no permitida.";

                break;

            case "mult":
                $resultado = $op1 * $op2;
                $signo = "*";
                break;

            default:
                $resultado = "Operación no válida";
        }

        return array($resultado, $signo);
    }

    $op1 = "";
    $op2 = "";
    $resultado = "";
    $signo = "";

    //Solo si el formulario se ha enviado se ejecutara el codigo
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $op1 = (float) $_POST["op1"];
        $op2 = (float) $_POST["op2"];

        list($resultado, $signo) = procesarOperacion($op1, $op2, $_POST["op"]);
    }

    if (!empty($resultado) && is_numeric($resultado))
        echo "Resultado operación: $op1 $signo $op2 = $resultado";
    else
        echo $resultado;
?>

