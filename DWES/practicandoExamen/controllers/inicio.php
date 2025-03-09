<?php
include_once "../controllers/gestionSesiones.php";

echo "<pre>";
print_r($_SESSION['usuario']);
echo "</pre>";

include_once "../views/formInicio.php";
?>




