<html>
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Baja de Empleados</title>
 </head>

<body>

    <form id="" name="" action="" method="post" >	
        Baja de Empleado <select name="empleados" id="empleados" required>
            <?php
                foreach ($empleados as $empleado => $titulo) {
                    echo "<option value='".$titulo["emp_no"]."'>".$titulo["emp_no"]." | ".$titulo["first_name"]." ".$titulo['last_name']."</option>";
                }
            ?>
        </select>	

        <?php
            if(isset($mensaje))
                echo $mensaje;
        ?>
    
    <input type="submit" name="bajaEmp" value="Dar Baja">
    </form>
		
    <a href="../controllers/inicio.php">Volver a la Pagina Principal</a><br>
    <a href="../controllers/logout.php">Cerrar Sesion</a>
</body>
</html>