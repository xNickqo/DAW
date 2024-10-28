<HTML>
<HEAD> 
  <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>JUEGO DADOS - PRÁCTICA OBLIGATORIA</title>
      <link rel="stylesheet" href="./bootstrap.min.css">
    </head>

</HEAD>

<BODY>
  <form name='juegodados' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method='POST'>

    <div class="container ">
          <!--Aplicacion-->
      <div class="card border-success mb-3" style="max-width: 30rem;">
        <div class="card-header"><B>JUEGO DADOS</B> </div>
        <div class="card-body">

          <B>Jugador 1: </B><input type='text' name='jug1' value='' size=25><br><br> 
          <B>Jugador 2: </B><input type='text' name='jug2' value='' size=25><br><br> 
          <B>Jugador 3: </B><input type='text' name='jug3' value='' size=25><br><br> 
          <B>Jugador 4: </B><input type='text' name='jug4' value='' size=25><br><br><br> 
          
          <B>Numero Dados: </B><input type='text' name='numdados' value='' size=5><br><br>


          <B>Pulsa para Tirar Dados: </B>
          <div>
            <input type="submit" value="Tirar Dados" name="tirar" class="btn btn-warning disabled">
          </div>

        </div>
      </div>
    </div>
  
  </form>

  <div>
      <?php
        include "functions.php";

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
          $numDados = $_POST['numdados'];

          $jugs = obtenerJugadores();

          //Mientras el numero de dados sea menos que 10
          if($numDados > 0 && $numDados <= 10)
          {

            echo "<h2>Resultados de los lanzamientos</h2>";

            //Introducir los valores de los dados en un array por cada jugador
            foreach($jugs as $nombre => $dados)
            {
              echo "<table border='1'><tr><td> $nombre </td>";

              $res = [];
              $puntos = 0;
              for($i = 0; $i < $dados; $i++)
              {
                $num = rand(1, 6);
                imprimirDados($num);
                array_push($res, $num);
                $puntos += $num;
              }

              //Checker de dados, si todos los dados de un jugador son iguales, puntos = 100
              $num_check = $res[0];
              checker($dados, $res, $num_check);

              //var_dump($res);

              echo "</tr></table>";
              echo ("$nombre tiene un total de <b>$puntos</b> puntos<br><br>");

              $puntajes[$nombre] = $puntos;
              //var_dump($puntajes);
            }

            mostrarGanador($puntajes);

          }
          else
            trigger_error("Error en el numero de dados", E_USER_ERROR);
        }
      
      ?>
    </div>

</BODY>
</HTML>