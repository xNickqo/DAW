<?php
include "funciones.php";

$mensaje = "";
$conn = ConexionBBDD();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['logout'])) {
        // Elimina la cookie
        setcookie("usuario", "", time() - 3600, "/");

        $mensaje = "Has cerrado sesión correctamente.";
    } else {
        // Proceso de inicio de sesión
        $nombre = trim($_POST['nombre']);
        $pass = trim($_POST['pass']);

        $sql = "SELECT * FROM usuarios WHERE nombre = :nombre AND password = :pass";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':pass', $pass);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            //Crea la cookie
            setcookie("usuario", $nombre, time() + (86400 * 30), "/"); // 30 días

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
    <?php if (isset($_COOKIE['usuario'])): ?>
        <!-- Mostrar mensaje de bienvenida y botón de logout -->
        <h1>Bienvenido, <?php echo htmlspecialchars($_COOKIE['usuario']); ?>!</h1>
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

    <?php if (!empty($mensaje)){echo $mensaje;}?>
</body>
</html>
