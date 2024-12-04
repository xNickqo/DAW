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
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $res = $stmt->fetch(PDO::FETCH_NUM);
        if ($res && $res[0] != null) {
            $num = substr($res[0], 1); // Elimina el prefijo 'C'
            $newnumber = (int)$num + 1; // Convierte a entero y suma 1
        }else{
            $newnumber = 1;
        }

        $idcat = 'C' . str_pad($newnumber, 3, '0', STR_PAD_LEFT);

        $sql = 'INSERT INTO categoria (ID_CATEGORIA, NOMBRE) VALUES (:id_categoria, :nombre)';
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':id_categoria', $idcat);
        $stmt->bindParam(':nombre', $nombreCategoria);

        $stmt->execute();

        echo "Categoría [$nombreCategoria] con ID [$idcat] introducida exitosamente.";
    } catch (PDOException $e) {
        echo "Error con la consulta de la categoría: " . $e->getMessage();
    }
}
?>
