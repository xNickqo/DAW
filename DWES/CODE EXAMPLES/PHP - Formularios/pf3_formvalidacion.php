<HTML>
<HEAD> <TITLE> VALIDACIONES EN FORMULARIOS  </TITLE>
</HEAD>
<BODY>
<?php
// Lo primero que se debe hacer es procesar todas las variables con la funci�n "htmlspecialchars"
// Si un usuario intentara ejecutar c�digo: <script>location.href('http://www.hacked.com')</script>
// No se ejecutar�a porque se transforma en c�digo no ejecutable

$codigoexploit="<script>location.href('http://www.hacked.com')</script>";
echo " C�digo sospechoso ..... ".$codigoexploit." se ha ejecutado sin darte cuenta<br>";
echo " C�digo con funci�n aplicada NO se ejecuta: ".htmlspecialchars($codigoexploit)."<br>";


$nombre="   Mr.James O'Donnell    ";
echo "Nombre antes de trim = ".$nombre." caracteres=".strlen($nombre)."<br>";
// A continuaci�n es conveniente utilizar la funci�n "trim()" para eliminar espacios en blanco
echo "Nombre despu�s de trim = ".trim($nombre)." caracteres=".strlen(trim($nombre))."<br><br>";;
// Y la funci�n "stripslashes()" elimina la barra de escape "\", utilizada para escapar caracteres

echo "Nombre antes de addslashes = ".$nombre."<br>";
$nombre=addslashes($nombre);
echo "Nombre despu�s de addslashes = ".$nombre."<br>";
$nombre=stripslashes($nombre);
echo "Nombre despu�s de stripslashes = ".$nombre."<br>";

// Lo usual es realizarlo creando una funci�n que realice las acciones anteriores
// En el siguiente ejemplo "f4_formvalidacion" se ha realizado una funci�n "limpar_campos"

?>





