<!DOCTYPE html>
<?php
/* Una cookie es un fragmento de información que un navegador web almacena en el disco duro del visitante a una página web. 
La información se almacena a petición del servidor web, ya sea directamente desde la propia página web con JavaScript o 
desde el servidor web mediante las cabeceras HTTP, que pueden ser generadas desde PHP. 
La información almacenada en una cookie puede ser recuperada por el servidor web en posteriores visitas a la misma página web.
Las cookies resuelven un grave problema del protocolo HTTP: al ser un protocolo de comunicación "sin estado" (stateless), 
no es capaz de mantener información persistente entre diferentes peticiones. 
Gracias a las cookies se puede compartir información entre distintas páginas de un sitio web o incluso en la misma página web 
pero en diferentes instantes de tiempo.

En PHP se emplea la función setcookie() para asignar valor a una cookie.
Para borrar una cookie, se tiene que asignar a la cookie una fecha de caducidad (expire) en el pasado, es decir, 
una fecha anterior a la actual.
Para recuperar el valor de una cookie se emplea el array predefinido $_COOKIE con el nombre de la cookie como índice. 
También se puede emplear $_REQUEST, que contiene la unión de $_COOKIE, $_POST y $_GET. 
*/

// CREAR UNA COOKIE
// Uso de la función setcookie para asignar valor la cookie usuario
$cookie_name = "usuario";
$cookie_value = "Alfonso Rebolleda";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 segundos = 1 día

?>
<html>
<body>

<?php
//Se comprueba si la cookie existe
if(!isset($_COOKIE[$cookie_name])) {
     echo "Cookie " . $cookie_name . " no definida!!!<br>";
} else {
     echo "Cookie " . $cookie_name . " definida!!!<br>";
     echo "Nombre de la cookie: " . $_COOKIE[$cookie_name];
}
?>

<p><strong>Importante:</strong> Recarga/refresca la p&aacutegina para obtener el valor de la cookie</p>

</body>
</html>