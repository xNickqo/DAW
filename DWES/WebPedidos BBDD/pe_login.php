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
        <label for="customerNumber">Usuario (customerNumber):</label>
        <input type="text" name="customerNumber" id="customerNumber" required><br><br>

        <label for="contactLastName">Password (contactLastName):</label>
        <input type="password" name="contactLastName" id="contactLastName" required><br><br>

        <input type="submit" value="Iniciar Sesión">
    </form>

    <a href="pe_reg.php">Si no tienes cuenta</a>

    <?php
        include "includes/1_funcionesModelo.php";
        include "includes/2_funcionesVista.php";
        include "includes/3_funcionesControlador.php";

        $conn = conexionBBDD();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $customerNumber = $_POST['customerNumber'];
            $clave = $_POST['contactLastName'];

            $mensaje = procesarLogin($conn, $customerNumber, $clave);
            if ($mensaje)
                echo "<p style='color: red;'>$mensaje</p>";
        }
    ?>
</body>
</html>
