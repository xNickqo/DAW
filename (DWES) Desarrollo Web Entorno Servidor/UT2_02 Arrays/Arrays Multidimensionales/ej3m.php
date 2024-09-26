<HTML>
<HEAD><TITLE> EJ3AM</TITLE></HEAD>
<BODY>

<?php

$matriz = array(
    array(2, 4, 6, 9, 7),
    array(8, 10, 12, 1, 12),
    array(14, 16, 88, 3, 15)
);

echo "<h3>Matriz (por filas):</h3>";
echo "<table border='1' cellpadding='5' cellspacing='0'>";
for ($rows = 0; $rows < 3; $rows++) {
    echo "<tr>";
    for ($cols = 0; $cols < 5; $cols++) {
        echo "<td>" . $matriz[$rows][$cols] . "</td>";
    }
    echo "</tr>";
}
echo "</table>";


echo "<h3>Matriz (por columnas):</h3>";
echo "<table border='1' cellpadding='5' cellspacing='0'>";
for ($cols = 0; $cols < 5; $cols++) {
    echo "<tr>";
    for ($rows = 0; $rows < 3; $rows++) {
        echo "<td>" . $matriz[$rows][$cols] . "</td>";
    }
    echo "</tr>";
}
echo "</table>";

?>

</BODY>
</HTML>
