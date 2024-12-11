<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de categorias</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <label for="nombrecat">Nombre de la categoría:</label>
        <input type="text" id="nombrecat" name="nombrecat" required>
        <br>
        <input type="submit" value="Insertar los datos en la tabla y generar ID_CATEGORIA">
    </form>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['nombrecat'])) {
    include "../includes/funciones.php";
    $conn = conexionBBDD();
    $nombreCategoria = $_POST['nombrecat'];

    try {
        $sql = 'SELECT MAX(ID_CATEGORIA) FROM categoria';
        $res = ejecutarConsulta($sql, array(), PDO::FETCH_NUM, true);
        if ($res != null) {
            $num = substr($res, 1); // Elimina el prefijo 'C'
            $newnumber = (int)$num + 1; // Convierte a entero y suma 1
        } else {
            $newnumber = 1;
        }

        $idcat = 'C' . str_pad($newnumber, 3, '0', STR_PAD_LEFT);

        $valores = array(
            'ID_CATEGORIA' => $idcat,
            'NOMBRE' => $nombreCategoria
        );

        insertarDatos('categoria', $valores);

        echo "Categoría [$nombreCategoria] con ID [$idcat] introducida exitosamente.";
    } catch (PDOException $e) {
        echo "Error con la consulta de la categoría: " . $e->getMessage();
    }
}
?>
