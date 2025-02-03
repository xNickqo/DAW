<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vida laboral de un empleado</title>
</head>
<body>
    <h1>Vida laboral de un empleado</h1>
    <form action="" method="POST">
        <select name="emp_no" id="emp_no">
            <option value="">Seleccione un empleado</option>
            <?php
                foreach($res as $emple){
                    echo "<option value=". $emple['emp_no'] .">". $emple['first_name'] . " " . $emple['last_name'] ."</option>";
                }
            ?>
        </select>

        <BR>
        <input type="submit" id="vidaLaboral" name="vidaLaboral" value="Obtener vida laboral"><br>

        <a href="../controllers/inicio.php">Volver al inicio</a>

        <br>

        <a href="../controllers/logout.php">Cerrar Sesion</a>
    </form>

    <?php
        if ($employee) {
            // Construir el mensaje con toda la vida laboral
            $mensaje = "<h2>Vida Laboral del Empleado {$emp_no}</h2>";
            $mensaje .= "Nombre: {$employee['first_name']} {$employee['last_name']}<br>";
            $mensaje .= "Fecha de nacimiento: {$employee['birth_date']}<br>";
            $mensaje .= "Fecha de contratación: {$employee['hire_date']}<br>";
            $mensaje .= "Género: {$employee['gender']}<br>";

            // Salarios
            $mensaje .= "<h3>Salarios:</h3>";
            if ($salaries) {
                foreach ($salaries as $salary) {
                    $mensaje .= "Salario: ". $salary['salary']. "<br>";
                    $mensaje .= $salary['from_date'] . " => " .$salary['to_date'] ."<br><br>";
                }
            }

            // Títulos
            $mensaje .= "<h3>Títulos:</h3>";
            if ($titles) {
                foreach ($titles as $title) {
                    $mensaje .= "Cargo: ". $title['title'] . "<br>";
                    $mensaje .= $title['from_date']." => ". $title['to_date']. "<br><br>";
                }
            }

            // Departamentos
            $mensaje .= "<h3>Departamentos:</h3>";
            if ($departments) {
                foreach ($departments as $department) {
                    $mensaje .= "Departamento: ".$department['dept_name']."<br>";
                    $mensaje .= $department['from_date'] ." => ". $department['to_date']."<br>";
                }
            }

        }
    ?>

    <?php if (isset($mensaje)) echo "<p>$mensaje</p>"; ?>

</body>
</html>