<?php
include_once "../controllers/gestionSesiones.php";

echo "<pre>";
var_dump($_SESSION['usuario']);
echo "</pre>";

include_once "../views/formInicio.php";
?>




