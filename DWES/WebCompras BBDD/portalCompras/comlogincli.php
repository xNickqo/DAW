<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Cliente</title>
</head>
<body>
    <h2>Login de Cliente</h2>

    <form action="comlogincli.php" method="POST">
        <label for="usuario">Nombre de Usuario:</label>
        <input type="text" name="usuario" id="usuario" required><br><br>

        <label for="clave">Clave:</label>
        <input type="password" name="clave" id="clave" required><br><br>

        <input type="submit" value="Iniciar Sesión">

        <a href="comregcli.php">Si no tienes cuenta</a>
    </form>

    <?php
        include "../includes/funciones.php";

        // Verificar si el usuario ya está logeado
        if (isset($_SESSION['usuario'])) {
            header("Location: ../index.php");
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuario = strtolower($_POST['usuario']);
            $clave = $_POST['clave'];

            $conn = conexionBBDD();

            // Consultar si el usuario existe en la base de datos
            $sql_check = "SELECT * FROM cliente WHERE NOMBRE = :usuario";
            $parametros = [':usuario' => $usuario];

            $resultado = ejecutarConsulta($sql_check, $parametros);

            // Si el usuario existe, verificar la clave
            if (!empty($resultado)) {
                $row = $resultado[0];

                // Verificar si la clave es correcta
                if (password_verify($clave, $row['CLAVE'])) {
                    $_SESSION['usuario'] = $row['NOMBRE'];
                    $_SESSION['NIF'] = $row['NIF'];
                    header("Location: ../index.php");
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
