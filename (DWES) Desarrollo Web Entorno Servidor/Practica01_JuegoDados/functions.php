<?php
    function errores($errno, $errstr, $errfile, $errline) {
        echo "<b>Error [$errno]:</b> $errstr en la línea <b>$errline</b>.<br>";
        die();
    }

    set_error_handler("errores");

    function obtenerJugadores()
    {
        $jugs = [];
        $numDados = $_POST['numdados'];
        //Introduce los input $_POST dentro del array jugs[]
        foreach ($_POST as $jug => $nombre)
        {
          //Si el input no esta vacio y es alguno de esos strings, introducelos en el array
          if(in_array($jug, ['jug1', 'jug2', 'jug3', 'jug4']) && !empty($nombre))
            $jugs[$nombre] = $numDados;
        }

        //var_dump($jugs);

        //Si el numero de jugadores en menor que 2, ERROR
        if (count($jugs) < 2)
          trigger_error("Debe haber minimo 2 jugadores", E_USER_ERROR);

        return $jugs;
    }

    function imprimirDados($num)
    {
        if($num == 1) echo "<td><img src='images/1.PNG'></td>";
        if($num == 2) echo "<td><img src='images/2.PNG'></td>";
        if($num == 3) echo "<td><img src='images/3.PNG'></td>";
        if($num == 4) echo "<td><img src='images/4.PNG'></td>";
        if($num == 5) echo "<td><img src='images/5.PNG'></td>";
        if($num == 6) echo "<td><img src='images/6.PNG'></td>";
    }

    function checker($dados, $res, $num_check)
    {
        //Checker de dados, si todos los dados de un jugador son iguales, puntos = 100
        $count = 0;
        for($j = 0; $j < $dados; $j++)
        {
          if($num_check == $res[$j])
            $count++;
          if($count == count($res))
            $puntos = 100;
        }
    }

    function mostrarGanador($puntajes)
    {
        //Obtener los puntos maximos dentro del array
        $puntosGanador = max($puntajes);

        //Obtenen en un array el jugador/es que tenga/n la mayor puntuacion
        $ganadores = array_keys($puntajes, $puntosGanador);
        if(count($ganadores) > 1)
        {
          echo "<h2>Hay un empate con $puntosGanador puntos entre los siguientes jugadores: </h2>";
          foreach($ganadores as $ganador) {
            echo "$ganador<br>";
          }
        }
        else
        {
          $ganador = $ganadores[0];
          echo "<h2>¡El ganador es $ganador con $puntosGanador puntos!</h2>";
        }
    }
?>