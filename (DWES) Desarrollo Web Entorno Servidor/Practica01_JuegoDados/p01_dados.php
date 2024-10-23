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
          $jug1 = $_POST['jug1'];
          $jug2 = $_POST['jug2'];
          $jug3 = $_POST['jug3'];
          $jug4 = $_POST['jug4'];
          $numDados = $_POST['numdados'];

          $jugs = [];
          if($numDados > 0 && $numDados <= 10)
          {
            foreach ($_POST as $jug => $nombre)
            {
              if(in_array($jug, ['jug1', 'jug2', 'jug3', 'jug4']) && !empty($nombre))
                $jugs[$nombre] = $numDados;
            }
            //var_dump($jugs);
            if (count($jugs) < 2)
              trigger_error("Debe haber minimo 2 jugadores", E_USER_ERROR);

            echo "<h2>Resultados de los lanzamientos</h2>";
            foreach($jugs as $nombre => $dados)
            {
              echo "<table border=1px>";
              echo "$nombre: ";

              //Introducir los valores de los dados en un array por cada jugador
              $res = [];
              $puntos = 0;
              for($i = 0; $i < $dados; $i++)
              {
                $num = rand(1, 6);
                if($num == 1) echo "<tr><img src='images/1.PNG'></tr>";
                if($num == 2) echo "<tr><img src='images/2.PNG'></tr>";
                if($num == 3) echo "<tr><img src='images/3.PNG'></tr>";
                if($num == 4) echo "<tr><img src='images/4.PNG'></tr>";
                if($num == 5) echo "<tr><img src='images/5.PNG'></tr>";
                if($num == 6) echo "<tr><img src='images/6.PNG'></tr>";
                array_push($res, $num);
                $puntos += $num;
              }

              // Checker de dados, si todos los dados de un jugador son iguales, puntos = 100
              $num_check = $res[0];
              $count = 0;
              for($j = 0; $j < $dados; $j++)
              {
                if($num_check == $res[$j])
                  $count++;
                if($count == count($res))
                  $puntos = 100;
              }


              echo ("$nombre tiene un total de $puntos puntos");
              //var_dump($res);
              echo "</table>";
            }
          
          }
          else
            trigger_error("Error en el numero de dados", E_USER_ERROR);
        }
      
      ?>
    </div>

</BODY>
</HTML>