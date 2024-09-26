<HTML>
<HEAD><TITLE> EJ6A</TITLE></HEAD>
<BODY>
<?php
    $modulo1 = array("Bases Datos", "Entornos Desarrollo", "Programación");
    $modulo2 = array("Sistemas Informáticos","FOL","Mecanizado");
    $modulo3 = array("Desarrollo Web ES","Desarrollo Web EC","Despliegue","Desarrollo Interfaces", "Inglés");

    $modulos = array_merge($modulo1, $modulo2, $modulo3);

    echo "<h2>Array original</h2>";
    foreach ($modulos as $a)
        echo "$a, ";

    echo "<h2>Array sin 'Mecanizado'</h2>";
    if(in_array("Mecanizado", $modulos))
    {
        $indice = array_search("Mecanizado", $modulos);
        unset($modulos[$indice]);
        echo "<b>Modulo 'Mecanizado' eliminado correctamente.</b><br>";
    }
    foreach ($modulos as $a)
        echo "$a, ";

    echo "<h2>Array inverso</h2>";
    $reverse = array_reverse($modulos);
    foreach($reverse as $x)
        echo "$x, ";

?>
</BODY>
</HTML>