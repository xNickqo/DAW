<?php
//Gestion de sesiones
include_once "../controllers/gestionSesiones.php";

echo "<pre>";
print_r($_SESSION['usuario']);
echo "</pre>";

include_once "../controllers/error.php";

//Vista
include_once "../views/formInicio.php";
?>



