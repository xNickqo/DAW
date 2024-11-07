<?php
    function manejadorErrores($errno, $errstr, $errfile, $errline) {
        echo "<b>Error [$errno]:</b> $errstr en la línea $errline.<br>";
        return true;
    }

    set_error_handler("manejadorErrores");


    // Función para imprimir la primera línea en negrita
    function imprimirPrimeraLinea($archivo)
    {
        $primeraLinea = fgets($archivo);
        echo "<pre><b>" . htmlspecialchars($primeraLinea) . "</b></pre>";
    }


    // Funcion para buscar una plabara dentro de un archivo recorriendolo linea a linea
    function buscarPalabra($archivo, $palabra)
    {
        // Recorre las líneas restantes buscando la palabra
        while (($linea = fgets($archivo)) !== false)
        {
            // Busca la subcadena en la línea usando strstr() y si encuentra la palabra, imprime esa linea
            if (strstr($linea, $palabra))
            {
                echo "<pre>" . htmlspecialchars($linea) . "</pre>";
                break;
            }
        }
    }


    // Función para mostrar la línea encontrada
    function mostrarLinea($linea)
    {
        echo "<pre>" . htmlspecialchars($linea) . "</pre>";
    }


    function inicializarValores($linea)
    {
        return [
            'Valor' => substr($linea, 0, 22),
            'Ultimo' => substr($linea, 23, 8),
            'Var.%' => substr($linea, 32, 7),
            'Var.' => substr($linea, 40, 7),
            'Ac.% Año' => substr($linea, 48, 11),
            'MAx.' => substr($linea, 60, 8),
            'MIn.' => substr($linea, 69, 8),
            'Vol.' => substr($linea, 78, 12),
            'Capit.' => substr($linea, 91, 8),
            'Hora' => substr($linea, 100, 5)
        ];
    }

    // Función para mostrar el valor seleccionado por el usuario
    function mostrarValorSeleccionado($datos, $mostrar)
    {
        if (isset($datos[$mostrar]))
            echo "<b>$mostrar: </b>" . htmlspecialchars(trim($datos[$mostrar])) . "<br>";
        else
            trigger_error("Valor no encontrado.", E_USER_WARNING);
    }
?>