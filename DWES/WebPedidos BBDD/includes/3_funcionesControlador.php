<?php
    function procesarLogin($conn, $customerNumber, $clave) {
        $mensaje = '';

        try {
            // Consultar si el usuario existe en la base de datos
            $resultado = verificarUsuario($conn, $customerNumber);

            if (!empty($resultado)) {
                $row = $resultado[0];

                // Verificar si la clave ingresada es correcta
                if (($clave == $row['contactLastName']) || (password_verify($clave, $row['contactLastName']))) {
                    session_start();
                    $_SESSION['usuario'] = $row['customerNumber'];
                    header("Location: pe_inicio.php");
                    exit();
                } else {
                    $mensaje = "La clave es incorrecta.";
                }
            } else {
                $mensaje = "El usuario no existe.";
            }
        } catch (Exception $e) {
            $mensaje = "Error en la consulta: " . $e->getMessage();
        }

        return $mensaje;
    }


    function procesarRegistro($conn) {
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

            $mensaje = '';

            try {
                $customerNumber = consultarNumeroCliente($conn);
                $resultado = verificarUsuario($conn, $customerNumber);
                $hashedPassword = password_hash($contactLastName, PASSWORD_DEFAULT);

                if (empty($resultado)) {
                    try {
                        insertarRegistro($conn, $customerNumber, $customerName, $hashedPassword, $contactFirstName, $phone, $address, $address2, $city, $stateCode, $postalCode, $country, $salesRepEmployeeNumber, $creditLimit);
                        //echo "<br> Usuario: " . $customerNumber . "<br>". "Contraseña: " . $contactLastName ;
                        $mensaje = "Usuario registrado con éxito.";
                    } catch(PDOException $e) {
                        $mensaje = "Error al registrar el usuario: " . $e->getMessage();
                    }
                } else {
                    $mensaje = "El usuario ya existe.";
                }
            } catch(Exception $e) {
                $mensaje = "Error en la consulta: " . $e->getMessage();
            }
        }
        return $mensaje;
    }
    

    // Agrega los productos al carrito, en el caso de estar repetidos se agrupa la cantidad
    function agregarProductoAlCarrito(){
        $productCode = $_POST['productCode'];
        $quantity = $_POST['quantity'];
        $existe = false;

        // Verificar si el producto ya existe en el carrito, si existe sumamos la cantidad
        foreach ($_SESSION['carrito'] as &$item) {
            if ($item['productCode'] === $productCode) {
                $item['quantity'] += $quantity;
                $existe = true;
                break;
            }
        }

        // Si no existe lo añadimos al carrito
        if (!$existe) {
            $_SESSION['carrito'][] = array(
                'productCode' => $productCode,
                'quantity' => $quantity
            );
        }

        //var_dump($_SESSION['carrito']);
    }
    

    // Funcion para eliminar el producto al pulsar el boton
    function eliminarProductoDelCarrito(){
        $botonEliminar = $_POST['productCodeToRemove'];

        foreach ($_SESSION['carrito'] as $index => $item) {
            if ($item['productCode'] == $botonEliminar) {
                unset($_SESSION['carrito'][$index]);
                break;
            }
        }
        $_SESSION['carrito'] = array_values($_SESSION['carrito']);
        //var_dump($_SESSION['carrito']);
    }

?>