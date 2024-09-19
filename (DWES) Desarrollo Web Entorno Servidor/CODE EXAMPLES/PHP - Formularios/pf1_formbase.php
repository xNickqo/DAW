<?php
/*
Esta forma de recuperar valores requiere que el método especificado en el formulario 
de envío sea POST y que la versión de PHP soporte variables superglobales.
*/
echo "El method que ha usado es: ",$_SERVER['REQUEST_METHOD'],"<br>";
echo  $_POST['nombre'],"<br>";
echo  $_POST['clave'],"<br>";
echo  $_POST['color'],"<br>";
echo  $_POST['acondicionado'],"<br>";
echo  $_POST['tapiceria'],"<br>";
echo  $_POST['llantas'],"<br>";
echo  $_POST['precio'],"<br>";
echo  $_POST['texto'],"<br>";
echo  $_POST['oculto'],"<br>";

?>
