<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
// Se puede cambiar el valor de una variable de sesión simplemente sobreescribiendola
$_SESSION["favcolor"] = "ROJO";
$_SESSION["favlanguage"] = "ENGLISH";
print_r($_SESSION);
?>

</body>
</html> 