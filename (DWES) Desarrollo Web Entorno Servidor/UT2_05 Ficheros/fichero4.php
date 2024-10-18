<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ficheros 4</title>
</head>
<body>
    <h2>Listado de Alumnos de alumnos2.txt</h2>

    <?php

    $archivo = fopen("alumnos2.txt", "r");
    $contador = 0;

    if ($archivo != false)
    {
        echo "<table border=1>";
        echo "<tr>
                <th>Nombre</th>
                <th>Primer Apellido</th>
                <th>Segundo Apellido</th>
                <th>Fecha de Nacimiento</th>
                <th>Ciudad</th>
               </tr>";

        while (($linea = fgets($archivo)) !== false)
        {
            $linea = trim($linea);

            $campos = explode("##", $linea);

            echo "<tr>";
                echo "<td>" . htmlspecialchars(trim($campos[0])) . "</td>";
                echo "<td>" . htmlspecialchars(trim($campos[1])) . "</td>";
                echo "<td>" . htmlspecialchars(trim($campos[2])) . "</td>";
                echo "<td>" . htmlspecialchars(trim($campos[3])) . "</td>";
                echo "<td>" . htmlspecialchars(trim($campos[4])) . "</td>";
            echo "</tr>";

            $contador++;
        }

        echo "</table>";

        fclose($archivo);

        echo "<p>Lineas leidas: <b>$contador</b></p>";
    }
    else
    {
        echo "<p>Error al abrir el archivo.</p>";
    }
    ?>

</body>
</html>