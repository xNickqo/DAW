<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de almacenes</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <label for="almacen">Localidad del almacen:</label>
        <input type="text" id="almacen" name="almacen" required>
        <br>
        <input type="submit" value="Dar de alta almacen">
    </form>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include "../includes/funciones.php";

    $valores = array('LOCALIDAD' => $_POST["almacen"]);

    insertarDatos('almacen', $valores);
}
?>
