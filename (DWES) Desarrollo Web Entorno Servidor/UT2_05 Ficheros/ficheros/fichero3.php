<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ficheros 3</title>
</head>
<body>
    <h2>Listado de Alumnos</h2>
    <?php
        $archivo = fopen("alumnos1.txt", "r");
        $contador = 0;

        if ($archivo)
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

                $nombre = substr($linea, 0, 40);               // Nombre: 0-39
                $primer_apellido = substr($linea, 40, 40);      // 1 Apellido: 40-79
                $segundo_apellido = substr($linea, 80, 42);     // 2 Apellido: 80-121
                $fecha = substr($linea, 122, 10);               // Fecha: 122-131
                $ciudad = substr($linea, 132, 27);              // Localidad: 132-158

                echo "<tr>";
                echo "<td>" . htmlspecialchars($nombre) . "</td>";
                echo "<td>" . htmlspecialchars($primer_apellido) . "</td>";
                echo "<td>" . htmlspecialchars($segundo_apellido) . "</td>";
                echo "<td>" . htmlspecialchars($fecha) . "</td>";
                echo "<td>" . htmlspecialchars($ciudad) . "</td>";
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
