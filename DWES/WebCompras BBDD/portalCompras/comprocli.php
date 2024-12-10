<?php
session_start(); // Iniciar la sesión para acceder a la cesta de la compra
include "../includes/funciones.php"; // Aquí se incluye la conexión a la base de datos y otras funciones

$error = '';
$mensaje = '';

// Verificar que el cliente está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: comlogincli.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra de Productos</title>
</head>
<body>
    <h2>Compra de Productos</h2>

    <?php if ($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php elseif ($mensaje): ?>
        <p style="color: green;"><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <form action="comprocli.php" method="POST">
        <label for="producto">Selecciona el Producto:</label>
        <select name="producto" id="producto" required>
            <?php
            // Aquí se mostrarán los productos disponibles en la base de datos.
            $sql = "SELECT ID_PRODUCTO, NOMBRE FROM producto";
            imprimirOpciones($sql, 'ID_PRODUCTO', 'NOMBRE');
            ?>
        </select><br><br>

        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad" required min="1"><br><br>

        <input type="submit" value="Añadir al Carrito">
    </form>

    <h3>Carrito de la Compra</h3>
    <?php
    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
        echo "<ul>";
        foreach ($_SESSION['carrito'] as $id_producto => $cantidad) {
            // Obtener el nombre del producto
            $sql_producto = "SELECT NOMBRE FROM producto WHERE ID_PRODUCTO = :id_producto";
            $stmt_producto = $conn->prepare($sql_producto);
            $stmt_producto->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
            $stmt_producto->execute();
            $producto = $stmt_producto->fetch(PDO::FETCH_ASSOC);

            echo "<li>" . $producto['NOMBRE'] . " - Cantidad: " . $cantidad . "</li>";
        }
        echo "</ul>";
        echo '<form action="comprocli.php" method="POST">
                <input type="submit" name="finalizar_compra" value="Finalizar Compra">
              </form>';
    } else {
        echo "<p>No hay productos en el carrito.</p>";
    }
    ?>
</body>
</html>

<?php
// Conectar a la base de datos
$conn = conexionBBDD();

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Añadir productos al carrito
    if (isset($_POST['producto']) && isset($_POST['cantidad'])) {
        $producto = $_POST['producto'];
        $cantidad = $_POST['cantidad'];
        
        // Verificar disponibilidad
        $sql_check = "SELECT CANTIDAD FROM almacena WHERE ID_PRODUCTO = :producto";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bindParam(':producto', $producto, PDO::PARAM_INT);
        $stmt_check->execute();
        $row = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($row && $row['CANTIDAD'] >= $cantidad) {
            // Añadir al carrito en la sesión
            if (!isset($_SESSION['carrito'])) {
                $_SESSION['carrito'] = [];
            }

            // Comprobar si el producto ya está en el carrito
            if (isset($_SESSION['carrito'][$producto])) {
                $_SESSION['carrito'][$producto] += $cantidad;
            } else {
                $_SESSION['carrito'][$producto] = $cantidad;
            }

            $mensaje = "Producto añadido al carrito.";
        } else {
            $error = "No hay suficiente stock para este producto.";
        }
    }

    // Finalizar la compra
    if (isset($_POST['finalizar_compra'])) {
        if (isset($_SESSION['carrito'])) {
            // Realizar la compra
            foreach ($_SESSION['carrito'] as $id_producto => $cantidad) {
                // Insertar la compra en la base de datos
                $sql_compra = "INSERT INTO compra (NIF_CLIENTE, ID_PRODUCTO, FECHA_COMPRA, CANTIDAD) 
                               VALUES (:nif_cliente, :id_producto, NOW(), :cantidad)";
                $stmt_compra = $conn->prepare($sql_compra);
                $stmt_compra->bindParam(':nif_cliente', $_SESSION['nif'], PDO::PARAM_STR);
                $stmt_compra->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
                $stmt_compra->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
                $stmt_compra->execute();

                // Actualizar el stock
                $sql_stock = "UPDATE almacena SET CANTIDAD = CANTIDAD - :cantidad WHERE ID_PRODUCTO = :id_producto";
                $stmt_stock = $conn->prepare($sql_stock);
                $stmt_stock->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
                $stmt_stock->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
                $stmt_stock->execute();
            }

            // Vaciar el carrito
            unset($_SESSION['carrito']);
            $mensaje = "Compra realizada con éxito.";
        }
    }
}
?>
