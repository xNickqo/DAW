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

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $customerName = $_POST['customerName'];
            $contactLastName = $_POST['contactLastName'];
            $contactFirstName = $_POST['contactFirstName'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $address2 = $_POST['address2'];
            $city = $_POST['city'];
            $stateCode = $_POST['stateCode'];
            $postalCode = $_POST['postalCode'];
            $country = $_POST['country'];
            $salesRepEmployeeNumber = $_POST['salesRepEmployeeNumber'];
            $creditLimit = $_POST['creditLimit'];


            $conn = conexionBBDD(); 

            $sql = "SELECT MAX(customerNumber) FROM customers";
            $customerNumber = ejecutarConsultaValor($sql);
            $customerNumber += 1;
            //var_dump($customerNumber);

            // Consultar si el usuario existe en la base de datos
            $sql = "SELECT * FROM customers WHERE customerNumber = :customerNumber";
            $parametros = array(':customerNumber' => $customerNumber);
            $resultado = ejecutarConsultaValor($sql, $parametros);
            //var_dump($resultado);

            if (empty($resultado)) {
                try{
                    $conn->beginTransaction();

                    $params = array(
                                'customerNumber' => $customerNumber,
                                'customerName' => $customerName,
                                'contactLastName' => password_hash($contactLastName, PASSWORD_DEFAULT),
                                'contactFirstName' => $contactFirstName,
                                'phone' => $phone,
                                'addrebLine1' => $address,
                                'addrebLine2' => $address2,
                                'city' => $city,
                                'state_code' => $stateCode,
                                'postalCode' => $postalCode,
                                'country' => $country,
                                'salesRepEmployeeNumber' => $salesRepEmployeeNumber,
                                'creditLimit' => $creditLimit
                    );

                    insertarDatos('customers', $params);

                    $conn->commit();
                }catch(PDOException $e){
                    $conn->rollBack();
                    $e->getMessage();
                }
            } else {
                echo "El usuario ya existe.";
            }
        }
    ?>
</body>
</html>
