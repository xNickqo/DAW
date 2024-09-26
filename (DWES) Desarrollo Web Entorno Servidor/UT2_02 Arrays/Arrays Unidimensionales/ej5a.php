<HTML>
<HEAD><TITLE> EJ5A</TITLE></HEAD>
<BODY>
<?php
    print("<h1>A.</h1>");

    $modulo1 = array("Bases Datos", "Entornos Desarrollo", "Programación");
    $modulo2 = array("Sistemas Informáticos","FOL","Mecanizado");
    $modulo3 = array("Desarrollo Web ES","Desarrollo Web EC","Despliegue","Desarrollo Interfaces", "Inglés");
    
    $superArray = array($modulo1, $modulo2, $modulo3);

    $modulos = array();

    foreach ($superArray as $subArray)
    {
        foreach ($subArray as $valor)
            $modulos[] = $valor;
    }

    foreach ($modulos as $p)
        echo "$p <br>";

    /*----------------------------------------------------------*/
    print("<h1>B.</h1>");
    
    $modulo1 = array("Bases Datos", "Entornos Desarrollo", "Programación");
    $modulo2 = array("Sistemas Informáticos","FOL","Mecanizado");
    $modulo3 = array("Desarrollo Web ES","Desarrollo Web EC","Despliegue","Desarrollo Interfaces", "Inglés");

    $modulos = array_merge($modulo1, $modulo2, $modulo3);

    foreach ($modulos as $a)
        echo "$a <br>";

    /*----------------------------------------------------------*/
    print("<h1>C.</h1>");

    $modulo1 = array("Bases Datos", "Entornos Desarrollo", "Programación");
    $modulo2 = array("Sistemas Informáticos","FOL","Mecanizado");
    $modulo3 = array("Desarrollo Web ES","Desarrollo Web EC","Despliegue","Desarrollo Interfaces", "Inglés");

    $superArray = array($modulo1, $modulo2, $modulo3);
    
    $modulos = array();

    for ($j = 0; $j < count($superArray); $j++)
    {
        for ($i = 0; $i < count($superArray[$j]); $i++)
        {
            array_push($modulos, $superArray[$j][$i]);
            echo $superArray[$j][$i] . "<br>";
        }
    }
?>
</BODY>
</HTML>