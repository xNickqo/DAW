<?php 
    session_start();
    include "includes/funciones.php";

    if (isset($_SESSION['usuario'])) {
        header("Location: pe_inicio.php");
        exit();
    }    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <form action="pe_login.php" method="POST">
        <label for="customerNumber">Usuario (customerName):</label>
        <input type="text" name="customerNumber" id="customerNumber" required><br><br>

        <label for="contactLastName">Password (contactLastName):</label>
        <input type="password" name="contactLastName" id="contactLastName" required><br><br>

        <input type="submit" value="Iniciar Sesión">
    </form>

    <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $customerNumber = $_POST['customerNumber'];
            $clave = $_POST['contactLastName'];

            $conn = conexionBBDD();

            // Consultar si el usuario existe en la base de datos
            $sql = "SELECT * FROM customers WHERE customerNumber = :customerNumber";
            $parametros = array(':customerNumber' => $customerNumber);
            $resultado = ejecutarConsulta($sql, $parametros);
            //var_dump($resultado);

            // Si el usuario existe, verificar la clave
            if (!empty($resultado)) {
                $row = $resultado[0];

                if ($clave == $row['contactLastName']) {
                    $_SESSION['usuario'] = $row['customerNumber'];
                    header("Location: pe_inicio.php");
                    exit();
                } else {
                    echo "La clave es incorrecta.";
                }
            } else {
                echo "El usuario no existe.";
            }
        }
    ?>
</body>
</html>