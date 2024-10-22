<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bolsa5</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        
        <label for="mostrar">Mostrar</label>
        <select name="mostrar" id="mostrar">
            <option> </option>
            <option value="volumen">Total volumen</option>
            <option value="capit">Total capitalizacion</option>
        </select>

        <br>

        <input type="submit" value="Visualizar">
        <input type="reset" value="Borrar">
        <br><br>
    </form>
    <?php
        include "funciones_bolsa.php";
    
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $archivo = fopen("ibex35.txt", "r");
            
            if($archivo)
            {
                $opcion = $_POST['mostrar'];
                $suma = 0;
                // Recorre las líneas restantes buscando la palabra
                while (($linea = fgets($archivo)) !== false)
                {
                    if ($opcion == "volumen")
                    {
                        $vol = trim(substr($linea, 78, 12));
                        $suma += floatval($vol);
                    }
                    if ($opcion == "capit")
                    {
                        $cap = trim(substr($linea, 91, 8));
                        $suma += floatval($cap);
                    }
                }
            }

            echo "<b>Suma total de {$opcion}: </b>" . htmlspecialchars($suma);

            fclose($archivo);
        }
    ?>
</body>
</html>