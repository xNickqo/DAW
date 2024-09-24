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

    foreach ($alumnos as $nombre => $edad)
        echo "$nombre => $edad <br> ";


?>
</BODY>
</HTML>