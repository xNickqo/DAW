<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Cliente</title>
</head>
<body>
    <h2>Registro de Cliente</h2>

    <form action="comregcli.php" method="POST">
        <label for="nif">NIF:</label>
        <input type="text" name="nif" id="nif" required><br><br>

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required><br><br>

        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" id="apellido" required><br><br>

        <label for="cp">Código Postal:</label>
        <input type="text" name="cp" id="cp" required><br><br>

        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" id="direccion" required><br><br>

        <label for="ciudad">Ciudad:</label>
        <input type="text" name="ciudad" id="ciudad" required><br><br>

        <input type="submit" value="Registrar Cliente">
    </form>

    <a href="comlogincli.php">Si ya tienes cuenta</a>

    <?php
        include "../includes/funciones.php";

        $error = "";
        $mensaje = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nif = $_POST['nif'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $cp = $_POST['cp'];
            $direccion = $_POST['direccion'];
            $ciudad = $_POST['ciudad'];

            // Validación del NIF (asegurarse de que no esté vacío y siga el formato)
            if (empty($nif) || !preg_match("/^\d{8}[A-Z]$/", $nif)) {
                $error = "El NIF no es válido o está vacío.";
            }

            // Verificar si el cliente ya existe
            $conn = conexionBBDD();
            $sql_check = "SELECT * FROM cliente WHERE NIF = :nif";
            $stmt_check = $conn->prepare($sql_check);
            $stmt_check->bindParam(':nif', $nif, PDO::PARAM_STR);
            $stmt_check->execute();

            if ($stmt_check->rowCount() > 0) {
                $error = "Ya existe un cliente con este NIF.";
            }

            if (empty($error)) {
                $usuario = strtolower($nombre); // El usuario será el nombre en minúsculas
                $clave = strrev(strtolower($apellido)); // La clave será el apellido invertido y en minúsculas
                $valores = array(
                    "NIF" => $nif,
                    "NOMBRE" => $nombre,
                    "APELLIDO" => $apellido,
                    "CP" => $cp,
                    "DIRECCION" => $direccion,
                    "CIUDAD" => $ciudad,
                    "CLAVE" => password_hash($clave, PASSWORD_DEFAULT)
                );

                insertarDatos('cliente', $valores);
                
                //Registramos la sesion del cliente
                $_SESSION['usuario'] = $usuario;
                $_SESSION['NIF'] = $nif;

                $mensaje = "Cliente registrado correctamente. Su usuario es: $usuario y su clave es: $clave";
                echo $mensaje;
            } else {
                echo $error;
            }
        }
    ?>
</body>
</html>
