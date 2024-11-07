<?php
    if ($_POST['op'] == "suma")
    {
        $signo = "+";
        $resultado = $_POST['op1'] + $_POST['op2'];
    }
    else if ($_POST['op'] == "resta")
    {
        $signo = "-";
        $resultado = $_POST['op1'] - $_POST['op2'];
    }
    else if ($_POST['op'] == "div")
    {
        $signo = "/";
        $resultado = $_POST['op1'] / $_POST['op2'];
    }
    else if ($_POST['op'] == "mult")
    {
        $signo = "*";
        $resultado = $_POST['op1'] * $_POST['op2'];
    }

    echo "Resultado operacion: " . $_POST["op1"] . " " . $signo . " " . $_POST["op2"] . " = " . $resultado;
?>