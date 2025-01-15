<?php
echo "Inicio controller"."<br>";
//Llamada al modelo -- Intermediario entre vista y modelo !!!
require_once("models/peliculas_model.php");


$provincia=new peliculas_model();
$datos=$provincia->get_peliculas();

//Llamada a la vista -- Intermediario entre vista y modelo !!!
require_once("views/peliculas_view.phtml");
echo "Fin controller"."<br>";
?>