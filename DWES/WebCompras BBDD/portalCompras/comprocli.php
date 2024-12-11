<?php
session_start();
include "../includes/funciones.php";

if (!isset($_SESSION['usuario']) || !isset($_SESSION['NIF'])) {
    header("Location: comlogincli.php");
    exit();
}

$conn = conexionBBDD();
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

    <!-- Formulario de Selección de Productos -->
    <form action="comprocli.php" method="POST">
        <label for="producto">Selecciona el Producto:</label>
        <select name="producto" id="producto" required>
            <?php
            $sql = "SELECT ID_PRODUCTO, NOMBRE FROM producto";
            imprimirOpciones($sql, 'ID_PRODUCTO', 'NOMBRE');
            ?>
        </select><br><br>

        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad" required min="1"><br><br>

        <input type="submit" value="Añadir al Carrito">
    </form>

    <!-- Carrito de la Compra -->
    <h3>Carrito de la Compra</h3>
    <?php
    if (!empty($_SESSION['carrito'])) {
        echo "<ul>";
        foreach ($_SESSION['carrito'] as $id_producto => $cantidad) {
            // Obtener el nombre del producto
            $sql_producto = "SELECT NOMBRE FROM producto WHERE ID_PRODUCTO = :id_producto";
            $parametros = array(':id_producto' => $id_producto);

            $producto = ejecutarConsulta($sql_producto, $parametros);
            //var_dump($producto);
            echo "<li>" . htmlspecialchars($producto['NOMBRE']) . " - Cantidad: " . htmlspecialchars($cantidad) . "</li>";
        }
        echo "</ul>";
        echo '<form action="comprocli.php" method="POST">
                <input type="submit" name="finalizar_compra" value="Finalizar Compra">
                <input type="submit" name="borrar_carrito" value="Borrar carrito">
              </form>';
    } else {
        echo "<p>No hay productos en el carrito.</p>";
    }
    ?>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['producto']) && isset($_POST['cantidad'])) {
        $producto = $_POST['producto'];
        $cantidad = $_POST['cantidad'];
        
        // Verificar disponibilidad
        $sql_check = "SELECT CANTIDAD FROM almacena WHERE ID_PRODUCTO = :producto";
        $params = array(':producto'=>$producto);
        $row =ejecutarConsulta($sql_check, $params);

        if ($row && $row['CANTIDAD'] >= $cantidad) {
            // Inicializar el carrito si no existe
            if (!isset($_SESSION['carrito']))
                $_SESSION['carrito'] = array();

            // Si el producto ya está en el carrito, actualizamos su cantidad, Si no está en el carrito, lo añadimos
            if (isset($_SESSION['carrito'][$producto]))
                $_SESSION['carrito'][$producto] += $cantidad;
            else
                $_SESSION['carrito'][$producto] = $cantidad;
            
            header("Location: comprocli.php");
            exit();

        } else {
            echo "No hay suficiente stock para este producto.";
        }
    }

    if (isset($_POST['finalizar_compra']) && !empty($_SESSION['carrito'])) {
        try {
            $conn->beginTransaction();

            foreach ($_SESSION['carrito'] as $id_producto => $cantidad) {
                // Insertar en la tabla `compra`
                $datosCompra = [
                    'NIF' => $_SESSION['NIF'],
                    'ID_PRODUCTO' => $id_producto,
                    'FECHA_COMPRA' => date('Y-m-d H:i:s'),
                    'UNIDADES' => $cantidad
                ];
                insertarDatos('compra', $datosCompra);

                // Actualizar el stock
                $sql_stock = "UPDATE almacena SET CANTIDAD = CANTIDAD - :cantidad WHERE ID_PRODUCTO = :id_producto";
                $stmt_stock = $conn->prepare($sql_stock);
                $stmt_stock->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
                $stmt_stock->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
                $stmt_stock->execute();
            }

            $conn->commit();

            // Vaciar el carrito
            unset($_SESSION['carrito']);
            echo "Compra realizada con éxito.";
        } catch (Exception $e) {
            $conn->rollBack();
            echo "Error al realizar la compra: " . htmlspecialchars($e->getMessage());
        }
    }
    if (isset($_POST['borrar_carrito']))
        unset($_SESSION['carrito']);
}

?>
