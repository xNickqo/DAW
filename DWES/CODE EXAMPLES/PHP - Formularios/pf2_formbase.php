<?php
/*
Esta forma de recuperar valores es independiente de que el método usuado sea
GET o POST
*/
echo "El method que ha usado es: ",$_SERVER['REQUEST_METHOD'],"<br>";
echo  $_REQUEST['nombre'],"<br>";
echo  $_REQUEST['clave'],"<br>";
echo  $_REQUEST['color'],"<br>";
echo  $_REQUEST['acondicionado'],"<br>";
echo  $_REQUEST['tapiceria'],"<br>";
echo  $_REQUEST['llantas'],"<br>";
echo  $_REQUEST['precio'],"<br>";
echo  $_REQUEST['texto'],"<br>";
echo  $_REQUEST['oculto'],"<br>";

?>
