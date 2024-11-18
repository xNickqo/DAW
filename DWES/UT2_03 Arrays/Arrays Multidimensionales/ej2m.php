<HTML>
<HEAD><TITLE> EJ7A</TITLE></HEAD>
<BODY>

<?php
    $matriz = array();
    $valor = 2;

    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
            $matriz[$i][$j] = $valor;
            $valor += 2;
        }
    }

    // Imprimir el contenido de la matriz
    echo "matriz -> ";
    foreach ($matriz as $fila) {
        foreach ($fila as $elemento)
            echo "$elemento, ";
    }
    echo "<br>";echo "<br>";

    // Arrays para almacenar las sumas de las filas y columnas
    $sumaFilas = array(0, 0, 0);
    $sumaColumnas = array(0, 0, 0);

    // Calcular las sumas por filas y columnas
    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
            $sumaFilas[$i] += $matriz[$i][$j];
            $sumaColumnas[$j] += $matriz[$i][$j]; 
        }
    }

    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr><th></th><th>Col 1</th><th>Col 2</th><th>Col 3</th><th>Suma Fila</th></tr>";
    for ($i = 0; $i < 3; $i++) {
        echo "<tr>";
        echo "<th>Fila " . ($i + 1) . "</th>"; // Columna de las filas

        for ($j = 0; $j < 3; $j++) {
            echo "<td>" . $matriz[$i][$j] . "</td>"; // Mostrar cada valor en su celda correspondiente
        }

        // Mostrar la suma de cada fila al final de cada fila
        echo "<td style='background-color: yellow;'>" . $sumaFilas[$i] . "</td>";
        echo "</tr>";
    }

    // Mostrar la ultima fila con la suma de cada columna
    echo "<tr><th>Suma Columna</th>";

    for ($j = 0; $j < 3; $j++) {
        echo "<td style='background-color: yellow;'>" . $sumaColumnas[$j] . "</td>";
    }

    echo "<td></td>";
    echo "</tr>";
    echo "</table>";
?>


</BODY>
</HTML>