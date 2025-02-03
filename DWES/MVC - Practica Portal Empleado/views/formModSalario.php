<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar salario de un empleado</title>
</head>
<body>
    <h1>Modificar el salario de un empleado</h1>
    <form action="" method="POST">
        <label for="emp_no">Numero de empleado: </label>
        <input type="text" id="emp_no" name="emp_no" required>
        <BR>    
        <label for="salario">Salario: </label>
        <input type="text" id="salario" name="salario" required>
        <BR>
        <input type="submit" id="modificar" name="modificar" value="Modificar salario">
        <br>
        <a href="../controllers/inicio.php">Volver al inicio</a>
        <br>
        <a href="../controllers/logout.php">Cerrar Sesion</a>
    </form>

    <?php if (isset($mensaje)) echo "<p>$mensaje</p>"; ?>

</body>
</html>