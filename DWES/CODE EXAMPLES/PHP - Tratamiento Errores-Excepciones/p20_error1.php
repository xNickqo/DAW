<?php

echo "<h1> 1-Tratamiento de Errores: funcion die() </h1>";

/*echo "Codigo PHP intenta abrir un fichero que no existe <br>";
echo "Aparecer&aacute un ERROR en pantalla <br>";
$file=fopen("hola.txt","r");
*/
/*Comentar el código anterior y descomentar el siguiente 
  para hacer uso de la funcion die() */
?>
  
<?php
if(!file_exists("hola.txt")) {
  die("Fichero no encontrado");
} else {
  $file=fopen("hola.txt","r");
}
?> 

 