<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra de Producto</title>
</head>
<body>
    <h2>Realizar Compra de Producto</h2>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <label for="nif_cliente">NIF Cliente:</label>
        <select name="nif_cliente" id="nif_cliente" required>
            <?php
                include "../includes/funciones.php";
                $sql = "SELECT NIF, NOMBRE FROM cliente";
                imprimirOpciones($sql, 'NIF', 'NOMBRE');
            ?>
        </select>
        <br><br>

        <label for="producto">Selecciona el Producto:</label>
        <select name="producto" id="producto" required>
            <?php
                $sql = "SELECT ID_PRODUCTO, NOMBRE FROM producto";
                imprimirOpciones($sql, 'ID_PRODUCTO', 'NOMBRE');
            ?>
        </select>
        <br><br>

        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" required min="1">
        <br><br>

        <input type="submit" value="Realizar Compra">
    </form>

    <?php
        $error = "";
        $mensaje = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $producto = $_POST['producto'];
            $cantidad = $_POST['cantidad'];
            $nif_cliente = $_POST['nif_cliente'];

            if ($cantidad <= 0) {
                $error = "La cantidad debe ser mayor que 0";
            } else {
                $conn = conexionBBDD();
                $sql = "SELECT SUM(CANTIDAD) AS stock_total
                        FROM almacena
                        WHERE ID_PRODUCTO = :producto";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':producto', $producto, PDO::PARAM_STR);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $stock_disponible = $row['stock_total'];

                if ($stock_disponible < $cantidad) {
                    $error = "No hay suficiente stock disponible para realizar esta compra.";
                } else {
                    $fecha_compra = date("Y-m-d");
                    $camposValores = array(
                        "NIF" => $nif_cliente,
                        "ID_PRODUCTO" => $producto,
                        "FECHA_COMPRA" => $fecha_compra,
                        "UNIDADES" => $cantidad
                    );

                    insertarDatos("compra", $camposValores);
                    
                    $mensaje = "Compra realizada con éxito. Producto: $producto, Cantidad: $cantidad.";
                }
            }
        }
    ?>

    <!-- Mostrar mensajes de error o éxito -->
    <?php if ($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php elseif ($mensaje): ?>
        <p style="color: green;"><?php echo $mensaje; ?></p>
    <?php endif; ?>

</body>
</html>
