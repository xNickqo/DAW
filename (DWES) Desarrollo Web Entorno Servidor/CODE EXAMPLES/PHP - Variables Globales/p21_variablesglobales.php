<?php

/*Variables globales/superglobales accesibles desde cualquier punto del programa:
	$GLOBALS
    $_SERVER
    $_REQUEST
    $_POST
    $_GET
    $_FILES
    $_ENV
    $_COOKIE
    $_SESSION */

echo "<h1> Variables PHP GLOBALS </h1>";

function sumar()
{
	$GLOBALS['resultado'] = $GLOBALS['numero1'] + $GLOBALS['numero2']; 
}
$numero1=10;
$numero2=20;
sumar();
// Se puede acceder a la variable $resultado desde fuera función pq está en array $GLOBALS
echo "Resultado suma: ".$resultado."<BR>";


?> 

 