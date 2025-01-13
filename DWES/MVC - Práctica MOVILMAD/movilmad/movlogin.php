<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page - MovilMad</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
 </head>
      
<body>
    <h1>MOVILMAD</h1>

    <div class="container ">
		<div class="card border-success mb-3" style="max-width: 30rem;">
            <div class="card-header">Login Usuario</div>
                <div class="card-body">
                
                    <form id="" name="" action="" method="post" class="card-body">
                        <div class="form-group">
                            Email <input type="text" name="email" placeholder="email" class="form-control">
                        </div>
                        <div class="form-group">
                            Clave <input type="password" name="password" placeholder="password" class="form-control">
                        </div>				
                        
                        <input type="submit" name="submit" value="Login" class="btn btn-warning disabled">
                    </form>
                
                </div>
            </div>
        </div>
    </div>

    <?php
        include_once "db/conexionBBDD.php";

        $conn = conexionBBDD();

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $email = $_POST['email'];
            $clave = $_POST['password'];

            include_once "models/obtenerCliente.php";
            $resultado = obtenerCliente($conn, $email);
            var_dump($resultado);

            if (!empty($resultado)) {
                $row = $resultado[0];

                if (password_verify($clave, $row['idcliente'])
                        && $row['pendiente_pago'] == 0
                            && $row['fecha_baja'] == NULL) {
                    session_start();
                    $_SESSION['usuario'] = $row['idcliente'];
                    header("Location: movwelcome.php");
                    exit();
                } else {
                    echo "La clave es incorrecta.";
                }
            } else {
                echo "El usuario no existe.";
            }
        }
    ?>

</body>
</html>