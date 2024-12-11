<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Compras</title>
</head>
<body>
    <h2>Consulta de Compras</h2>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <label for="cliente">Selecciona el Cliente (NIF):</label>
        <select name="cliente" id="cliente" required>
            <?php
                include "../includes/funciones.php";
                $conn = conexionBBDD();
                $sql = "SELECT NIF, NOMBRE FROM cliente";
                imprimirOpciones($sql, "NOMBRE", "NIF");
            ?>
        </select>
        <br>
        <label for="fecha_desde">Fecha Desde:</label>
        <input type="date" name="fecha_desde" id="fecha_desde" required>
        <br>
        <label for="fecha_hasta">Fecha Hasta:</label>
        <input type="date" name="fecha_hasta" id="fecha_hasta" required>
        <br>
        <input type="submit" value="Consultar Compras">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nif_cliente = $_POST['cliente'];

        // Convertir a formato YYYY-MM-DD
        $fecha_desde = date('Y-m-d', strtotime($_POST['fecha_desde']));
        $fecha_hasta = date('Y-m-d', strtotime($_POST['fecha_hasta']));

        $sql = "SELECT  c.ID_PRODUCTO, 
                        p.NOMBRE AS NOMBRE_PRODUCTO, 
                        p.PRECIO, 
                        c.FECHA_COMPRA,
                        c.UNIDADES, 
                        (p.PRECIO * c.UNIDADES) AS TOTAL
                FROM compra c
                JOIN producto p ON c.ID_PRODUCTO = p.ID_PRODUCTO
                WHERE c.NIF = :nif AND c.FECHA_COMPRA BETWEEN :fecha_desde AND :fecha_hasta;";
        $parametros = array(
            ':nif' => $nif_cliente,
            ':fecha_desde' => $fecha_desde,
            ':fecha_hasta' => $fecha_hasta
        );
        $compras = ejecutarConsulta($sql, $parametros);

        if (count($compras) > 0) {
            echo "<h3>Compras Realizadas</h3>";
            echo "<table border='1'>";
            echo "<tr>
                    <th>Producto</th>
                    <th>Nombre Producto</th>
                    <th>Precio</th>
                    <th>Fecha Compra</th>
                    <th>Unidades</th>
                    <th>Total</th>
                    </tr>";

            $montante_total = 0;

            foreach ($compras as $compra) {
                echo "<tr>";
                echo "<td>" . $compra['ID_PRODUCTO'] . "</td>";
                echo "<td>" . $compra['NOMBRE_PRODUCTO'] . "</td>";
                echo "<td>" . number_format($compra['PRECIO'], 2) . " €</td>";
                echo "<td>" . $compra['FECHA_COMPRA'] . "</td>";
                echo "<td>" . $compra['UNIDADES'] . "</td>";
                echo "<td>" . number_format($compra['TOTAL'], 2) . " €</td>";
                echo "</tr>";

                $montante_total += $compra['TOTAL'];
            }

            echo "</table>";
            echo "<h4>Montante Total: " . number_format($montante_total, 2) . " €</h4>";
        } else {
            echo "<p>No se encontraron compras para el cliente en el rango de fechas seleccionado.</p>";
        }
    }
?>
</body>
</html>
