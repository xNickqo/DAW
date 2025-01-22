<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $apellido = $_POST['apellido'];
    $clave = $_POST['clave'];

    include_once "../db/conexionBBDD.php";
    $conn = conexionBBDD();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            $sql = "SELECT MAX(idcliente) FROM rclientes";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $idcliente = $stmt->fetchColumn();
            $idcliente += 1;

            $sql = "INSERT INTO rclientes (idcliente, nombre, apellido, email, fecha_alta, clave) 
                    VALUES (:idcliente, :nombre, :apellido, :email, CURDATE(), :clave)";

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':idcliente', $idcliente);
            $stmt->bindValue(':nombre', $nombre);
            $stmt->bindValue(':apellido', $apellido);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':clave', password_hash($clave, PASSWORD_DEFAULT));
    
            $stmt->execute();

            $mensaje = "Registro exitoso";
        } catch (PDOException $e){
            $mensaje = "Error al insertar el registro de usuario: " . $e->getMessage();
        }
    }

    $conn = null;
}
?>

<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page - MovilMad</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
 </head>
      
<body>
    <h1>MOVILMAD</h1>

    <div class="container ">
		<div class="card border-success mb-3" style="max-width: 30rem;">
            <div class="card-header">Registro de Usuario</div>
                <div class="card-body">
                
                    <form id="" name="" action="" method="post" class="card-body">
                        <div class="form-group">
                            Nombre <input type="text" name="nombre" placeholder="" class="form-control">
                        </div>
                        <div class="form-group">
                            Apellido <input type="text" name="apellido" placeholder="" class="form-control">
                        </div>				
                        
                        <div class="form-group">
                            Email <input type="text" name="email" placeholder="" class="form-control">
                        </div>
                        <div class="form-group">
                            Clave <input type="password" name="clave" placeholder="" class="form-control">
                        </div>				
                    	
                        <input type="submit" name="registro" value="Registro" class="btn btn-warning disabled">
                    </form>
                
                    <?php
                        if(isset($mensaje))
                            echo $mensaje;
                    ?>

                </div>
            </div>
        </div>
    </div>

</body>
</html>