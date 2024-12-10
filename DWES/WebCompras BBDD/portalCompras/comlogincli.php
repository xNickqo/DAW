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
    </form>

    <?php
        session_start();
        include "../includes/funciones.php";

        $error = "";
        $mensaje = "";

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
            $stmt_check = $conn->prepare($sql_check);
            $stmt_check->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $stmt_check->execute();

            // Si el usuario existe, verificar la clave
            if ($stmt_check->rowCount() > 0) {
                $row = $stmt_check->fetch(PDO::FETCH_ASSOC);

                // Verificar si la clave es correcta
                if (password_verify($clave, $row['CLAVE'])) {
                    $_SESSION['usuario'] = $row['USUARIO'];
                    header("Location: ../index.php");
                    exit();
                } else {
                    $error = "La clave es incorrecta.";
                }
            } else {
                $error = "El usuario no existe.";
            }
        }
    ?>

    <?php if ($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
</body>
</html>
