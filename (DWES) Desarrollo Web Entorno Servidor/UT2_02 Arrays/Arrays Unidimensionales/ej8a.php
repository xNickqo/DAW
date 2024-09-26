<HTML>
<HEAD><TITLE> EJ7A</TITLE></HEAD>
<BODY>
<?php
    $alumnos = array(
        "Nicolas"=>8.3, 
        "Manuel"=>7, 
        "Nacho"=>4.9,
        "Javier"=>10,
        "Christian"=>5.8
    );
    
    print("<h1>Listado de alumnos y sus notas.</h1>");
    foreach ($alumnos as $nombre => $nota)
    {
        echo "$nombre => $nota <br> ";
    }

    print("<h1>Mejor nota</h1>");
    /*
    max() para obtener la mayor nota
    array_keys() para obtener el nombre del alumno que tiene esa nota.
    */
    $mayornota = max($alumnos);
    $alumnomayornota = array_keys($alumnos, max($alumnos))[0];
    echo "a. $alumnomayornota($mayornota) <br>";


    print("<h1>Peor nota</h1>");
    /*
    min() para obtener la menor nota
    array_keys() para obtener el nombre del alumno que tiene esa nota.
    */
    $peornota = min($alumnos);
    $alumnopeornota = array_keys($alumnos, min($alumnos))[0];
    echo "b. $alumnopeornota($peornota) <br>";
    

    print("<h1>Media notas</h1>");
    /*
    array_sum() para obtener la suma de las notas y luego lo dividimos entre 
    el numero total de alumnos con count().
    number_format() para mostrar la media con dos decimales.
    */
    $mediaNotas = array_sum($alumnos) / count($alumnos);
    echo "c. Nota media: " . number_format($mediaNotas, 2) . "\n";

?>
</BODY>
</HTML>