<?php
include "funciones.php";
$mensaje = "";
$conn = ConexionBBDD();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = trim($_POST['nombre']);
    $correo = trim($_POST['correo']);
    $fecha_registro = date('Y-m-d H:i:s'); // Fecha actual en formato MySQL

    if ($conn && !usuarioExiste($conn, $correo)) {
        insert_BBDD($conn, $nombre, $correo, $fecha_registro);
        $mensaje = "Usuario registrado con éxito.";
    } else {
        $mensaje = "El correo ya está registrado. Intente con otro.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookies y Sesiones</title>
</head>
<body>
        <h1>Formulario de Registro</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" required>
            <br>
            <label for="correo">Correo</label>
            <input type="email" id="correo" name="correo" required>
            <br>
            <label for="pass">Contraseña</label>
            <input type="password" id="pass" name="pass" required>
            <br>
            <input type="submit" value="Registrarse">
        </form>

    <?php if (!empty($mensaje)): ?>
        <p><?php echo $mensaje; ?></p>
    <?php endif; ?>
</body>
</html>
