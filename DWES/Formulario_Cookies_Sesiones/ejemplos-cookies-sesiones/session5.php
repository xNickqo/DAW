<?php
    /*Sessión Time-Outs: establecer un tiempo de vida para las sesiones es importante para controlar las sesiones de usuarios en aplicaciones. 
	Si un usuario inicia sesión en un lugar y se olvida de cerrarla, otros pueden continuar con la misma, por eso es mejor establecer 
	un tiempo máximo de sesión.
	
	Si no hay actividad en 1 minuto nos lleva a logout.php
	*/

    session_start();
    // Establecer tiempo de vida de la sesión en segundos
    $inactividad = 60;
    // Comprobar si $_SESSION["timeout"] está establecida
    if(isset($_SESSION["timeout"])){
        // Calcular el tiempo de vida de la sesión (TTL = Time To Live)
        $sessionTTL = time() - $_SESSION["timeout"];
        if($sessionTTL > $inactividad){
            session_destroy();
            header("Location: /cookies-sesiones/logout.php");
        }
    }
    // El siguiente key se crea cuando se inicia sesión
    $_SESSION["timeout"] = time();
?>