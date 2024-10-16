<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ficheros 5</title>
</head>
<body>
    <h2>Operación Ficheros</h2>

    <form method="POST">
        <label for="fichero">Fichero (Path/nombre):</label>
        <input type="text" id="fichero" name="fichero" required>
        
        <br><br>

        <label for="operaciones">Operaciones:</label><br>
        <input type="radio" name="operacion" value="all"> Mostrar Fichero <br>
        <input type="radio" name="operacion" value="line"> Mostrar línea <input type="number" name="numlinea" min="1"> del fichero<br>
        <input type="radio" name="operacion" value="lines"> Mostrar <input type="number" name="numlineas" min="1"> primeras líneas <br>

        <br><br>
        
        <input type="submit" value="Enviar">
        <input type="reset" value="Borrar">
    </form>
    <br>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $fichero = $_POST['fichero'];
        $operacion = $_POST['operacion'];

        if (!file_exists($fichero))
            echo "<p>Error: El archivo '$fichero' no existe en la ruta especificada.</p>";

        $archivo = fopen($fichero, "r");
        if (!$archivo)
            echo "<p>Error: No se pudo abrir el archivo.</p>";

        switch ($operacion)
        {
            case 'all':
                while (!feof($archivo)) {
                    $linea = fgets($archivo);
                    if ($linea === false)
                        break;
                    echo htmlspecialchars($linea) . "<br>";
                }
                break;

            case 'line':
                $numlinea = (int)$_POST['numlinea'];

                $i = 1;
                while (!feof($archivo)) {
                    $linea = fgets($archivo);
                    if ($linea === false)
                        break;
                    if ($i == $numlinea)
                    {
                        echo htmlspecialchars($linea) . "<br>";
                        break;
                    }
                    $i++;
                }

                if ($i < $numlinea)
                    echo "<p>Error: La línea $numlinea no existe en el fichero.</p>";

                break;

            case 'lines':
                $numlineas = (int)$_POST['numlineas'];

                for ($i = 0; $i < $numlineas; $i++)
                {
                    if (!feof($archivo))
                    {
                        $linea = fgets($archivo);
                        if ($linea === false)
                            break;
                        echo htmlspecialchars($linea) . "<br>";
                    }
                    else
                        break;
                }

                break;
        }
        fclose($archivo);
    }
    ?>

</body>
</html>
