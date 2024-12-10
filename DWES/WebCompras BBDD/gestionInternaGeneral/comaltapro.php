<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de productos</title>
</head>
<body>
    <h2>Alta de Productos</h2>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <label for="nombreprod">Nombre del producto:</label>
        <input type="text" id="nombreprod" name="nombreprod" required>
        <br>
        <label for="precioprod">Precio del producto:</label>
        <input type="text" id="precioprod" name="precioprod" required>
        <br>
        <label for="categoriaprod">ID categoría del producto (CXXX):</label>
        <select name="categoriaprod" id="categoriaprod" required>
            <option value="">Selecciona una categoría</option>
            <?php
                include "../includes/funciones.php";
                $conn = conexionBBDD();
                $sql = "SELECT ID_CATEGORIA, NOMBRE FROM categoria";
                imprimirOpciones($sql, "ID_CATEGORIA", "NOMBRE");
            ?>
        </select>
        <br>
        <input type="submit" value="Insertar los datos en la tabla y generar ID producto">
    </form>

    <?php
    $mostrarTabla = false;
    $idCategoriaSeleccionada = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombreProd = $_POST['nombreprod'];
        $precio = $_POST['precioprod'];
        $categoria = $_POST['categoriaprod'];

        if (empty($categoria)) {
            echo "Debe seleccionar una categoría.";
            exit();
        }

        if (!is_numeric($precio)) {
            echo "El precio debe ser un número.";
            exit();
        }

        try {
            $sql = 'SELECT MAX(ID_PRODUCTO) FROM producto';
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $res = $stmt->fetch(PDO::FETCH_NUM);
            $newnumber = empty($res[0]) ? 1 : (int)substr($res[0], 1) + 1;

            $idprod = 'P' . str_pad($newnumber, 4, '0', STR_PAD_LEFT);

            $sql = 'INSERT INTO producto (ID_PRODUCTO, NOMBRE, PRECIO, ID_CATEGORIA) 
                                VALUES (:id_producto, :nombre, :precio, :id_categoria)';
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':id_producto', $idprod);
            $stmt->bindParam(':nombre', $nombreProd);
            $stmt->bindParam(':precio', $precio);
            $stmt->bindParam(':id_categoria', $categoria);

            $stmt->execute();

            echo "$nombreProd con ID [$idprod] introducido exitosamente.";

            $mostrarTabla = true;
            $idCategoriaSeleccionada = $categoria;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    if ($mostrarTabla) {
        echo "<h2>Productos en la categoría $idCategoriaSeleccionada</h2>";
        echo "<table border='1'>
                <thead>
                    <tr>
                        <th>ID Producto</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>";

        try {
            $sql = "SELECT ID_PRODUCTO, NOMBRE, PRECIO 
                    FROM producto 
                    WHERE ID_CATEGORIA = :id_categoria";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_categoria', $idCategoriaSeleccionada);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['ID_PRODUCTO']) . "</td>";
                echo "<td>" . htmlspecialchars($row['NOMBRE']) . "</td>";
                echo "<td>" . htmlspecialchars($row['PRECIO']) . "</td>";
                echo "</tr>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        echo "</tbody>
              </table>";
    }
    ?>
</body>
</html>
