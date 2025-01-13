<?php
echo "Inicio controller"."<br>";
//Llamada al modelo -- Intermediario entre vista y modelo !!!
require_once("models/peliculas_model.php");


$peliculas=obtenerPeliculas();

//Llamada a la vista -- Intermediario entre vista y modelo !!!
require_once("views/peliculas_view.phtml");
echo "Fin controller"."<br>";
?>