<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fichero 7</title>
</head>
<body>
    <h2>Operaciones Sistemas Ficheros</h2>
    <form action="" method="POST">
        <label for="src">Fichero Origen(Path/nombre)</label>
            <input type="text" id="src" name="src"><br>
        <label for="dst">Fichero Destino(Path/nombre)</label>
            <input type="text" id="dst" name="dst"><br>
        
        <br><br>

        <label for="">Operaciones:</label><br>
        
        <input type="radio" id="cpy" name="operacion" value="cpy"><label for="cpy">Copiar Fichero</label><br>
        
        <input type="radio" id="rename" name="operacion" value="rename"><label for="rename">Renombrar/mover Fichero</label><br>
        
        <input type="radio" id="del" name="operacion" value="del"><label for="del">Borrar Fichero</label><br>
        
        <br><br>

        <input type="submit" value="Ejecutar Operacion">
        <input type="reset" value="Borrar">
        <br><br>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $src = $_POST['src'];
        $dst = $_POST['dst'];

        $operacion = $_POST['operacion'];

        if (!file_exists($src)) 
        {
            echo "El fichero origen no existe.<br>";
        } 
        else
        {
            switch ($operacion)
            {
                case 'cpy':  // Copiar fichero
                    $dir_destino = dirname($dst);
                    if (!is_dir($dir_destino))
                    {
                        if (mkdir($dir_destino, 0777, true))
                            echo "Se ha creado el directorio '{$dir_destino}'.<br>";
                        else
                        {
                            echo "Error: no se pudo crear el directorio '{$dir_destino}'.<br>";
                            exit;
                        }
                    }
                    if (copy($src, $dst))
                        echo "Fichero copiado con éxito en '{$dst}'.<br>";
                    else
                        echo "Error al copiar el fichero en '{$dst}'.<br>";
                    break;

                case 'rename':  // Renombrar/mover fichero
                    $dir_destino = dirname($dst);
                    if (!is_dir($dir_destino))
                    {
                        if (mkdir($dir_destino, 0777, true))
                            echo "El directorio '{$dir_destino}' se creó con éxito.<br>";
                        else
                        {
                            echo "Error: no se pudo crear el directorio '{$dir_destino}'.<br>";
                            exit;
                        }
                    }
                    if (rename($src, $dst))
                        echo "Se ha renombrado/movido con éxito el fichero '{$src}' a '{$dst}'.<br>";
                    else
                        echo "Error al renombrar o mover el fichero.<br>";
                    break;

                case 'del':  // Borrar fichero
                    if (unlink($src))
                        echo "Fichero borrado con éxito el fichero '{$src}'.<br>";
                    else
                        echo "Error al borrar el fichero.<br>";
                    break;

                default:
                    echo "Por favor, selecciona una operación válida.<br>";
            }
        }
    }
    ?>
</body>
</html>