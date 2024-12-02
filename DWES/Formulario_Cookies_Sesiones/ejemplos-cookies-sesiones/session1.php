<?php
// Inicio de la sesión
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
// Definición de variables de sesión con la variable GLOBAL $_SESSION
$_SESSION["favcolor"] = "AZUL";
$_SESSION["favlanguage"] = "ES";
echo "Se han establecido correctamente las variables de sesi&oacuten";



?>

</body>
</html>