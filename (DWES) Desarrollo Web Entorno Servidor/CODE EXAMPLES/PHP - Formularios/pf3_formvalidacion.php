<HTML>
<HEAD> <TITLE> VALIDACIONES EN FORMULARIOS  </TITLE>
</HEAD>
<BODY>
<?php
// Lo primero que se debe hacer es procesar todas las variables con la función "htmlspecialchars"
// Si un usuario intentara ejecutar código: <script>location.href('http://www.hacked.com')</script>
// No se ejecutaría porque se transforma en código no ejecutable

$codigoexploit="<script>location.href('http://www.hacked.com')</script>";
echo " Código sospechoso ..... ".$codigoexploit." se ha ejecutado sin darte cuenta<br>";
echo " Código con función aplicada NO se ejecuta: ".htmlspecialchars($codigoexploit)."<br>";


$nombre="   Mr.James O'Donnell    ";
echo "Nombre antes de trim = ".$nombre." caracteres=".strlen($nombre)."<br>";
// A continuación es conveniente utilizar la función "trim()" para eliminar espacios en blanco
echo "Nombre después de trim = ".trim($nombre)." caracteres=".strlen(trim($nombre))."<br><br>";;
// Y la función "stripslashes()" elimina la barra de escape "\", utilizada para escapar caracteres

echo "Nombre antes de addslashes = ".$nombre."<br>";
$nombre=addslashes($nombre);
echo "Nombre después de addslashes = ".$nombre."<br>";
$nombre=stripslashes($nombre);
echo "Nombre después de stripslashes = ".$nombre."<br>";

// Lo usual es realizarlo creando una función que realice las acciones anteriores
// En el siguiente ejemplo "f4_formvalidacion" se ha realizado una función "limpar_campos"

?>





