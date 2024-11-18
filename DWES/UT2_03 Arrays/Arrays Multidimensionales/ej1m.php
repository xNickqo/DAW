<HTML>
<HEAD><TITLE> EJ7A</TITLE></HEAD>
<BODY>

    <?php

        $matriz = array();
        $multiplo = 2; 

        for ($i = 0; $i < 3; $i++)
        {
            for ($j = 0; $j < 3; $j++)
            {
                $matriz[$i][$j] = $multiplo; 
                $multiplo += 2; 
            }
        }


        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        echo "<tr><th></th><th>Col 1</th><th>Col 2</th><th>Col 3</th></tr>"; 

        for ($i = 0; $i < 3; $i++) 
        {
            echo "<tr>";
            echo "<th>Fila " . ($i + 1) . "</th>";
            for ($j = 0; $j < 3; $j++)
                echo "<td>" . $matriz[$i][$j] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    ?>

</BODY>
</HTML>