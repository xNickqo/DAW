<HTML>
<HEAD><TITLE> EJ7A</TITLE></HEAD>
<BODY>
<?php
    $alumnos = array(
        "Nicolas"=>22, 
        "Manuel"=>23, 
        "Nacho"=>26,
        "Javier"=>19,
        "Christian"=>18
    );
    
    print("<h1>Listado de alumnos y sus edades.</h1>");
    echo "a. ";
    foreach ($alumnos as $nombre => $edad)
    {
        echo "$nombre => $edad , ";
    }


    print("<h1>Segunda posicion.</h1>");
    reset($alumnos);
    next($alumnos);
    echo "b. 2nd: " . key($alumnos) . " => " . current($alumnos) . " años <br>";

    
    print("<h1>Avanza una posicion.</h1>");
    next($alumnos);
    echo "c. 3rd: " . key($alumnos) . " => " . current($alumnos) . " años <br>";


    print("<h1>Avanza una posicion.</h1>");
    end($alumnos);
    echo "d. Last: " . key($alumnos) . " => " . current($alumnos) . " años <br>";


    print("<h1>Ordena el array por orden de edad y muestra 1 y ultima pos.</h1>");
    asort($alumnos);
    reset($alumnos);
    echo "e. 1st (por edad): " . key($alumnos) . " => " . current($alumnos) . " años <br>";
    end($alumnos);
    echo "Last (por edad): " . key($alumnos) . " => " . current($alumnos) . " años";
?>
</BODY>
</HTML>