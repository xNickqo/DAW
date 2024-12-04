<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de stock</title>
</head>
<body>
    <h2>Consulta de Stock</h2>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <label for="producto">Selecciona el Producto:</label>
        <select name="producto" id="producto" required>
            <?php
                include "../includes/funciones.php";

                $conn = conexionBBDD();

                $sql = "SELECT ID_PRODUCTO, NOMBRE FROM producto";
                imprimirOpciones($sql, 'ID_PRODUCTO', 'NOMBRE');
            ?>
        </select>
        <br><br>

        <label for="almacen">Selecciona el Almacén:</label>
        <select name="almacen" id="almacen" required>
            <?php
                $sql = "SELECT NUM_ALMACEN, LOCALIDAD FROM almacen";
                imprimirOpciones($sql, 'NUM_ALMACEN', 'LOCALIDAD');
            ?>
        </select>
        <br><br>

        <input type="submit" value="Mostrar cantidad del producto en el almacen seleccionado">
    </form>
</body>
</html>