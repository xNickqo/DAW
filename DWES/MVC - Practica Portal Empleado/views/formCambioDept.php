<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Departamento</title>
</head>
<body>
    <h1>Cambiar Departamento a un Empleado</h1>
    <form action="" method="POST">
        <label for="emp_no">Seleccionar Empleado:</label>
        <select name="emp_no" id="emp_no">
            <option value="">Seleccione un empleado</option>
            <?php
                foreach($employees as $employee){
                    echo "<option value='". $employee['emp_no'] ."'>". $employee['first_name'] . " " . $employee['last_name'] ."</option>";
                }
            ?>
        </select><br><br>

        <label for="nuevo_depto">Seleccionar Nuevo Departamento:</label>
        <select name="nuevo_depto" id="nuevo_depto">
            <option value="">Seleccione un departamento</option>
            <?php
                foreach($depts as $dept){
                    echo "<option value='". $dept['dept_no'] ."'>". $dept['dept_name'] ."</option>";
                }
            ?>
        </select><br>
        
        <?php 
            if (isset($mensaje)) 
                echo "<p>$mensaje</p>"; 
        ?>
        
        <br>
        <input type="submit" name="cambiar" value="Cambiar de departamento"><br>
        <a href="../controllers/inicio.php">Volver al inicio</a><br>
        <a href="../controllers/logout.php">Cerrar Sesion</a>
    </form>
</body>
</html>