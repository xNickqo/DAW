<?php
include "funciones.php";

$mensaje = "";
$conn = ConexionBBDD();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = trim($_POST['nombre']);
    $pass = trim($_POST['pass']);
    $fecha_registro = date('Y-m-d H:i:s');

    if ($conn) {
        if (!usuarioExiste($conn, $nombre)) {
            if (insert_BBDD($conn, $nombre, $pass, $fecha_registro)) {
                $mensaje = "Usuario registrado con éxito.";
            } else {
                $mensaje = "Error al registrar el usuario. Intente nuevamente.";
            }
        } else {
            $mensaje = "El usuario ya está registrado. Intente con otro.";
        }
    } else {
        $mensaje = "No se pudo conectar a la base de datos.";
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
            <label for="nombre">Usuario</label>
            <input type="text" id="nombre" name="nombre" required>
            <br>
            <label for="pass">Contraseña</label>
            <input type="password" id="pass" name="pass" required>
            <br>
            <input type="submit" value="Registrarse">
        </form>

    <?php if (!empty($mensaje)){echo $mensaje;}?>
</body>
</html>
