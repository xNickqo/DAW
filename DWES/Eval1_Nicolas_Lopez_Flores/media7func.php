<?php
/*  
    error_level	    Required. Especifica el nivel de informe de errores para el error definido por el usuario. Debe ser un número de valor. Consulte la tabla a continuación para conocer los posibles niveles de informe de errores.
    error_message	Required. Especifica el mensaje de error para el error definido por el usuario.
    error_file	    Optional. Especifica el nombre del archivo en el que ocurrió el error.
    error_line	    Optional. Especifica el número de línea en la que ocurrió el error.
    error_context	Optional. Especifica una matriz que contiene cada variable y sus valores, en uso cuando ocurrió el error.
*/

/*  
    1	    E_ERROR	        A fatal run-time error. Execution of the script is stopped
    2	    E_WARNING	    A non-fatal run-time error. Execution of the script is not stopped
    8	    E_NOTICE	    A run-time notice. The script found something that might be an error, but could also happen when running a script normally
    256	    E_USER_ERROR	A fatal user-generated error. This is like an E_ERROR, except it is generated by the PHP script using the function trigger_error()
    512	    E_USER_WARNING	A non-fatal user-generated warning. This is like an E_WARNING, except it is generated by the PHP script using the function trigger_error()
    1024	E_USER_NOTICE	A user-generated notice. This is like an E_NOTICE, except it is generated by the PHP script using the function trigger_error()
    2048	E_STRICT	    Not strictly an error.
    8191	E_ALL	        All errors and warnings (E_STRICT became a part of E_ALL in PHP 5.4) 
*/

function manejoErrores($errno, $errstr, $errfile, $errline) {
    echo "<b>Codigo del error [$errno]:</b> $errstr, en el archivo $errfile, en la línea $errline.<br>";
    return true;
}

set_error_handler("manejoErrores");


/*
    Funcion permite limpiar campos introducidos por los usuarios

        -elimina espacios en blanco por izquierda/derecha
        -elimina la barra de escape "\", utilizada para escapar caracteres
        -convierte caracteres especiales a entidades HTML
*/
function limpiar_campo($input) {

    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);  

    return $input;
  }


/* Funcion que almacena los jugadores en un array multidimensional y le asigna 
el numero de cartas, un array con todas sus cartas, y su puntuacion.

        jugadores = array('numcartas', 'cartas' = array(), 'puntos') 

--->Devuelve un array */
function obtenerJugadores() {
	$jugadores = array();
	$numCartas = $_POST['numcartas'];

    //Introduce los input $_POST dentro del array jugadores[]
    foreach (['nombre1', 'nombre2', 'nombre3', 'nombre4'] as $jugador)
    {
        if(!empty($_POST[$jugador]))
        {
            $jugadores[limpiar_campo($_POST[$jugador])] = array(
                                        'numcartas' => $numCartas,
                                        'cartas' => array(),
                                        'puntos' => 0
                                    );
        }
    }

	//Si el numero de jugadores en menor que 2, ERROR
	if (count($jugadores) < 2 )
		trigger_error("Debe haber minimo 2 jugadores", E_USER_ERROR);

	return $jugadores;
}


/* Imprime la carta correspondiente al numero y la letra */
function imprimirCartas($num, $letra)
{
	echo "<td><img src='images/".$num.$letra.".PNG'></td>";
}


/* Esta funcion consiste en mostrar el ganador, teniendo en cuenta el empate y cuando no hay ganador*/
function mostrarGanador($jugadores) {
	$puntosMax = 0;
	$ganadores = array();

	//Recorremos el array y encontramos la puntuación máxima
	foreach ($jugadores as $nombre => $jugador) {
		if($jugador['puntos'] <= 7.5) {
			if ($jugador['puntos'] > $puntosMax)
				$puntosMax = $jugador['puntos'];
		}
	}
	
	//Encontrar todos los jugadores con la puntuación máxima
	foreach ($jugadores as $nombre => $jugador) {
		if ($jugador['puntos'] == $puntosMax)
			$ganadores[] = $nombre;
	}

	// Mostrar el resultado según haya empate o no
	if (count($ganadores) > 1) {
		echo "<h2>Hay un empate con $puntosMax puntos entre los siguientes jugadores:</h2>";
		foreach ($ganadores as $ganador) {
			echo "$ganador<br>";
		}
	} else if (count($ganadores) == 1) {
		echo "<h2>¡El ganador es {$ganadores[0]} con $puntosMax puntos!</h2>";
	} else {
		echo "<h2>NO HAY GANADORES</h2>";
	}

	return $ganadores;
}

/* Funcion para recoger los datos que se van a introducir en el fichero */
function recogerDatos($nombre, $puntos, $apuesta)
{
	return $nombre . "***" . $puntos . "***" . $apuesta . "\n";
}


/* Funcion para dar los premios de la apuesta y meter los datos dentro del fichero */
function darPremios($ganadores, $jugadores) {
	$apuesta = limpiar_campo($_POST['apuesta']);
	$bote = 0;
	
    // Si hay mas de un ganador / empate
	if(count($ganadores) > 1) {
		$apuesta /= count($ganadores);
		echo "Cada ganador a conseguido $apuesta €";
	}
    // Si solo hay 1 ganador
	else if (count($ganadores) == 1) {
		echo "{$ganadores[0]} ha conseguido $apuesta €";
    // Si no hay ganadores
	} else {
		$bote += $apuesta;
		echo "El dinero se que da en el bote => bote = $bote €";
	}

    // Datos que se van a introducir al fichero
	$contenidoFichero = "";
    foreach ($ganadores as $ganador) {
        $puntos = $jugadores[$ganador]['puntos'];
        $contenidoFichero .= recogerDatos($ganador, $puntos, $apuesta);
    }

    // Escribir en el fichero
    $file = fopen("apuestas.txt", "a");
    if ($file) {
        fwrite($file, $contenidoFichero);
        fclose($file);
    } else {
        trigger_error("Error al abrir el fichero");
    }
}
?>