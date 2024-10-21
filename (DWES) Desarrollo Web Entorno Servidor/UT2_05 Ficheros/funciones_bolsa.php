<?php
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
        $valor = substr($linea, 0, 22);
        $ultimo = substr($linea, 23, 8);
        $varPer = substr($linea, 32, 7);
        $var = substr($linea, 40, 7);
        $acAño = substr($linea, 48, 11)
        $max = substr($linea, 60, 8); 
        $min = substr($linea, 69, 8);
        $vol = substr($linea, 78, 12);
        $capit = substr($linea, 91, 8);
        $hora = substr($linea, 100, 5);
    }
?>