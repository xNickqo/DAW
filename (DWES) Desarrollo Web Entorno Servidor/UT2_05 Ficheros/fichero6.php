<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fichero 6</title>
</head>
<body>
    <h2>Operaciones Ficheros</h2>
    <form action="" method="POST">
        <label for="fichero"> 
            Fichero (Path/nombre)<input type="text" id="fichero" name="fichero">
        </label>
        <br><br>
        <input type="submit" value="Ver Datos Fichero">
        <input type="reset" value="Borrar">
        <br><br>
    </form>
    <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $path = $_POST['fichero'];

        $nombre = basename($path);
        $dir = dirname($path);
        $tamaño = filesize($path);
        $mod = date("d/m/Y H:i", filemtime($path));

        echo "<b>Nombre del fichero:</b> " . $nombre . "<br>";
        echo "<b>Directorio: </b>" . $dir . "<br>";
        echo "<b>Tamaño del fichero:</b> " . $tamaño . "Kb" . "<br>";
        echo "<b>Fecha de la ultima modificacion fichero:</b> " . $mod . "<br>";
    }
    ?>
</body>
</html>