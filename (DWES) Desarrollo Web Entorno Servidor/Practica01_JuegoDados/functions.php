<?php
    function errores($errno, $errstr, $errfile, $errline) {
        echo "<b>Error [$errno]:</b> $errstr en la línea $errline.<br>";
        die();
    }

    set_error_handler("errores");
?>