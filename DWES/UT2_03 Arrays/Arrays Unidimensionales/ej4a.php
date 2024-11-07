<HTML>
<HEAD><TITLE> EJ4a</TITLE></HEAD>
<BODY>
<?php
    $numBinarios = array();
    $numeroOct = "";
    print("<table border='1'>");
    print(" <tr>
                <th>Indice</th>    <th>Binario</th>    <th>Octal</th>
            </tr>");
    for ($i = 20; $i >= 0; $i--) { 
        print("<tr>");
            print("<th>".$i."</th>");
            $numBinarios[$i] = decbin($i);
            $numeroOct = decoct($i);
            print("<th>".$numBinarios[$i]."</th>");
            print("<th>".$numeroOct."</th>");
        print("</tr>");
        $numeroOct = "";
    }
    print("</table>");
?>
</BODY>
</HTML>