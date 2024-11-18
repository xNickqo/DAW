<!DOCTYPE html>
<html lang="en">
<HEAD> 
  <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>JUEGO DADOS - PRÁCTICA OBLIGATORIA</title>
      <link rel="stylesheet" href="./bootstrap.min.css">
    </head>

</HEAD>
<body>
<form name='juegodados' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method='POST'>

    <div class="container ">
        <!--Aplicacion-->
        <div class="card border-success mb-3" style="max-width: 30rem;">
            <div class="card-header"><B>JUEGO DADOS</B> </div>
            <div class="card-body">

            <B>Nombre: </B><input type='text' name='nombre' value='' size=25><br><br> 
            <B>Apellidos: </B><input type='text' name='apellido' value='' size=25><br><br> 
            <B>Email: </B><input type='text' name='email' value='' size=25><br><br> 

            <B>Pulsa para capturar los datos: </B>
            <div>
                <input type="submit" value="Capturar" name="capturar" class="btn btn-warning disabled">
            </div>
            <br>
            <div>
                <a name="jugar" href="p01_dados.php">¡Jugar aqui!</a>
            </div>

            <?php
				include "functions.php";

				if((($_SERVER["REQUEST_METHOD"] == "POST")))
				{
					$jugador = recogerDatos();

					$file = fopen("fichero.txt", "a");
					fwrite($file, $jugador);
					fclose($file);
				}
            ?>

            </div>
        </div>
    </div>
</body>
</html>