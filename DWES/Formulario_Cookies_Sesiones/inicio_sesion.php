<?php
include "funciones.php";

// Iniciar sesión
session_start();

$mensaje = "";

// Crear conexión a la base de datos
$conn = ConexionBBDD();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['logout'])) {
        //Elimina la sesion
        session_unset();
        session_destroy();

        // Elimina la cookie
        setcookie("usuario", "", time() - 3600, "/");

        $mensaje = "Has cerrado sesión correctamente.";
    } else {
        // Proceso de inicio de sesión
        $nombre = trim($_POST['nombre']);
        $password = trim($_POST['pass']);

        $sql = "SELECT * FROM usuarios WHERE nombre = :nombre";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            // Crear cookie y sesión
            setcookie("usuario", $nombre, time() + (86400 * 30), "/"); // 30 días
            $_SESSION['usuario'] = $nombre;

            $mensaje = "Inicio de sesión exitoso. ¡Bienvenido, $nombre!";
        } else {
            $mensaje = "Nombre o contraseña incorrectos.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
</head>
<body>
    <?php if (isset($_SESSION['usuario'])): ?>
        <!-- Mostrar mensaje de bienvenida y botón de logout -->
        <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="logout" value="1">
            <input type="submit" value="Cerrar Sesión">
        </form>
    <?php else: ?>
        <!-- Mostrar formulario de inicio de sesión -->
        <h1>Formulario de Inicio de Sesión</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" required>
            <br>
            <label for="pass">Contraseña</label>
            <input type="password" id="pass" name="pass" required>
            <br>
            <input type="submit" value="Iniciar Sesión">
        </form>
    <?php endif; ?>

    <?php if (!empty($mensaje)): ?>
        <p><?php echo $mensaje; ?></p>
    <?php endif; ?>
</body>
</html>
