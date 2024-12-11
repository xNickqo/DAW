<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de Clientes</title>
</head>
<body>
    <h2>Alta de Clientes</h2>

    <!-- Formulario para el alta de clientes -->
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <label for="nif">NIF:</label>
        <input type="text" id="nif" name="nif" required maxlength="9">
        <br><br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br><br>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required>
        <br><br>

        <label for="cp">Código Postal:</label>
        <input type="text" id="cp" name="cp" required maxlength="5">
        <br><br>

        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" required>
        <br><br>

        <label for="ciudad">Ciudad:</label>
        <input type="text" id="ciudad" name="ciudad" required>
        <br><br>

        <input type="submit" value="Registrar Cliente">
    </form>

    <?php
        include "../includes/funciones.php";

        $error = "";
        $mensaje = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nif = strtoupper(trim($_POST['nif']));
            $nombre = trim($_POST['nombre']);
            $apellido = trim($_POST['apellido']);
            $cp = trim($_POST['cp']);
            $direccion = trim($_POST['direccion']);
            $ciudad = trim($_POST['ciudad']);

            if (empty($nif)) {
                $error = "El NIF es obligatorio.";
            } elseif (!preg_match("/^[0-9]{8}[A-Z]$/", $nif)) {
                $error = "El NIF debe tener 8 dígitos seguidos de una letra mayúscula.";
            } else {
                $conn = conexionBBDD();

                // Comprobar si ya existe un cliente con el mismo NIF
                $sql_check = "SELECT COUNT(*) AS total FROM cliente WHERE NIF = :nif";
                $parametros = array(":nif" => $nif);

                $result = ejecutarConsulta($sql, $parametros);

                if ($result['total'] > 0) {
                    $error = "Ya existe un cliente con el NIF $nif.";
                } else {
                    $valores = array(
                        'NIF' =>$nif, 
                        'NOMBRE'=>$nombre, 
                        'APELLIDO'=>$apellido, 
                        'CP'=>$cp,
                        'DIRECCION'=>$direccion, 
                        'CIUDAD'=>$ciudad
                    );
                    insertarDatos('cliente', $valores);
                }
            }
        }
    ?>

    <!-- Mostrar mensajes -->
    <?php if ($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php elseif ($mensaje): ?>
        <p style="color: green;"><?php echo $mensaje; ?></p>
    <?php endif; ?>
</body>
</html>
