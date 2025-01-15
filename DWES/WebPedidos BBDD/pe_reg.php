<?php 
    session_start();
    
    include "includes/1_funcionesModelo.php";
    include "includes/2_funcionesVista.php";
    include "includes/3_funcionesControlador.php";

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
    <title>Registro</title>
</head>
<body>
    <h2>Registro de Usuarios</h2>

    <form action="pe_reg.php" method="POST">   
        <label for="customerName">Usuario (customerName):</label>
        <input type="text" name="customerName" id="customerName" required><br>

        <label for="contactLastName">Apellido/Password (contactLastName):</label>
        <input type="text" name="contactLastName" id="contactLastName" required><br>

        <label for="contactFirstName">Nombre (contactFirstName):</label>
        <input type="text" name="contactFirstName" id="contactFirstName" required><br>

        <label for="phone">Telefono (phone):</label>
        <input type="text" name="phone" id="phone" required><br>

        <label for="address">Direccion (address):</label>
        <input type="text" name="address" id="address" required><br>

        <label for="address2"> 2ª Direccion (address2):</label>
        <input type="text" name="address2" id="address2" ><br>

        <label for="city"> Ciudad (city):</label>
        <input type="text" name="city" id="city" required><br>

        <label for="stateCode"> Codigo de Estado (stateCode):</label>
        <input type="text" name="stateCode" id="stateCode" ><br>

        <label for="postalCode"> Codigo postal (postalCode):</label>
        <input type="text" name="postalCode" id="postalCode" ><br>

        <label for="country"> Pais (country):</label>
        <input type="text" name="country" id="country" required><br>

        <label for="salesRepEmployeeNumber">(salesRepEmployeeNumber):</label>
        <input type="text" name="salesRepEmployeeNumber" id="salesRepEmployeeNumber" value="1002"><br>

        <label for="creditLimit">(creditLimit):</label>
        <input type="text" name="creditLimit" id="creditLimit" value="110000.00"><br>

        <input type="submit" value="Registrar usuario">
    </form>

    <a href="pe_login.php">Si ya tienes cuenta</a>

    <?php
        $conn = conexionBBDD();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $mensaje = procesarRegistro($conn);
            if ($mensaje != '') {
                echo "<p>$mensaje</p>";
            }
        }
    ?>
</body>
</html>
