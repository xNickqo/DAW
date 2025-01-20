<?php

	session_start();

	if (!isset($_SESSION['usuario'])) {
        header("Location: movlogin.php");
        exit();
    }

	echo "<pre> SESSION: <br>";
    var_dump($_SESSION['usuario']);
    echo "</pre>";

	include_once "../views/formularioWelcome.php";
?>




