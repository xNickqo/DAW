<!DOCTYPE html>
<?php

// MODIFICAR UNA COOKIE -> establecer el nuevo valor con función setcookie
$cookie_name = "usuario";
$cookie_value = "Rebolleda Sanchez, Alfonso";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
?>
<html>
<body>

<?php
if(!isset($_COOKIE[$cookie_name])) {
     echo "Cookie " . $cookie_name . " no definida!!!<br>";
} else {
     echo "Cookie " . $cookie_name . " definida!!!<br>";
     echo "Nombre de la cookie: " . $_COOKIE[$cookie_name];
}
?>

</body>
</html> 