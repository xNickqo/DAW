<?php
// Verifica si la cookie 'usuario' está habilitada
if (isset($_COOKIE['usuario'])) {
    $mensaje = "Bienvenido, " . htmlspecialchars($_COOKIE['usuario']) . "!";
}

// Procesamos el cierre de sesión si se presiona el botón
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logout'])) {
    // Eliminar la cookie de sesión
    setcookie("usuario", "", time() - 3600, "/");
    $mensaje = "Has cerrado sesión correctamente.";
    header("Location: 1.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1</title>
</head>
<body>
    <?php if (isset($_COOKIE['usuario'])): ?>
        <form method="POST" action="1.php">
            <input type="hidden" name="logout" value="1">
            <input type="submit" value="Cerrar Sesión">
        </form>
    <?php else: echo $mensaje;?>
    <?php endif; ?>

</body>
</html>