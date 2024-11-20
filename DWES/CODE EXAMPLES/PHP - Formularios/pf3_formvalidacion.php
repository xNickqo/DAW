<HTML>
    <HEAD> 
        <TITLE> VALIDACIONES EN FORMULARIOS  </TITLE>
    </HEAD>
<BODY>
    <?php
    // Lo primero que se debe hacer es procesar todas las variables con la funcion "htmlspecialchars"
    // Si un usuario intentara ejecutar codigo: <script>location.href('http://www.hacked.com')</script>
    // No se ejecutara porque se transforma en codigo no ejecutable

    $codigoexploit="<script>location.href('http://www.hacked.com')</script>";
    echo " Codigo sospechoso ... ".$codigoexploit." se ha ejecutado sin darte cuenta<br>";
    echo " Codigo con funcion aplicada NO se ejecuta: ".htmlspecialchars($codigoexploit)."<br>";


    $nombre="   Mr.James O'Donnell    ";
    echo "Nombre antes de trim = ". $nombre ." caracteres=".strlen($nombre)."<br>";

    // A continuacion es conveniente utilizar la funcion "trim()" para eliminar espacios en blanco
    echo "Nombre despues de trim = ".trim($nombre)." caracteres=".strlen(trim($nombre))."<br><br>";;


    // Y la funcion "stripslashes()" elimina la barra de escape "\", utilizada para escapar caracteres
    echo "Nombre antes de addslashes = ".$nombre."<br>";
    $nombre=addslashes($nombre);
    echo "Nombre despues de addslashes = ".$nombre."<br>";
    $nombre=stripslashes($nombre);
    echo "Nombre despues de stripslashes = ".$nombre."<br>";

    // Lo usual es realizarlo creando una funcion que realice las acciones anteriores
    // En el siguiente ejemplo "f4_formvalidacion" se ha realizado una funcion "limpar_campos"

    ?>
</BODY>





