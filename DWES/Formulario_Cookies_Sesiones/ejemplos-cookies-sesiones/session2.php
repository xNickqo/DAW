<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
// Accedemos a las variables de sesión que fueron establecidas en session1.php
echo "Color favorito es " . $_SESSION["favcolor"] . ".<br>";
echo "Idioma preferido es " . $_SESSION["favlanguage"] . ".<br>";

// se pueden visualizar todas las variables de session utilizando print_r
//print_r($_SESSION);

?>

</body>
</html> 