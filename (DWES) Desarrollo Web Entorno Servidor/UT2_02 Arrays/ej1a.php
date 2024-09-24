<HTML>
<HEAD><TITLE> EJ1A – NUM IMPARES</TITLE></HEAD>
<BODY>
<?php
    $numImpares = array();
    $indice = 0;
    $suma = "";
    print("<table border='1'>");
    print(" <tr>
                <th>Indice</th>     <th>Valor</th>      <th>Suma</th>
            </tr>");
    for ($i=1; $i < 20; $i += 2) { 
        $numImpares[$indice] = $i;
        print("<tr>");
            print("<th>".$indice."</th>");
            print("<th>".$numImpares[$indice]."</th>");
            print("<th>".(intval($suma) + $numImpares[$indice])."</th>");
        print("</tr>");
        $suma = intval($suma)  + $numImpares[$indice];
        $indice++;
    }

    print("</table>");
?>
</BODY>
</HTML>