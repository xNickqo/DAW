
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nominas</title>
</head>
<body>
    <h1>Obtener nomina de un empleado</h1>
    <form action="" method="POST">
        <label for="emp">Empleado: </label>
        <select name="emp" id="emp">
            <option value="">Selecciona un empleado</option>
            <!-- Aqui se introduciran los empleados-->
            <?php
                foreach ($empleados as $emp){
                    echo "<option value='" . $emp['emp_no'] . "'>" . $emp['first_name'] ." ". $emp['last_name'] ."</option>";
                }
            ?>
        </select>
        <input type="submit" name="obtenerNomina" value="Obtener nomina"><br>
        <a href="../controllers/logout.php">Cerrar sesion</a><br>
        <a href="../controllers/inicio.php">Volver al inicio</a>
    </form>

    <?php
    if(isset($res)){
        // Mostrar datos
        echo "<h2>Datos del Empleado</h2>";
        echo "<p><strong>Nombre:</strong> {$res['first_name']} {$res['last_name']}</p>";
        echo "<p><strong>Fecha de Contratación:</strong> {$res['hire_date']}</p>";
        echo "<p><strong>Departamento:</strong> {$res['dept_name']}</p>";
        echo "<p><strong>Titulación:</strong> {$res['title']}</p>";

        echo "<h2>Detalles de la Nómina</h2>";
        echo "<p><strong>Salario Bruto:</strong> " . number_format($salario_bruto, 2) . "</p>";
        echo "<p><strong>Descuento Seguridad Social (7.5%):</strong> " . number_format($seguridad_social, 2) . "</p>";
        echo "<p><strong>Descuento IRPF:</strong> " . number_format($irpf, 2) . "</p>";
        if ($complemento > 0) {
            echo "<p><strong>Complemento Engineer:</strong> " . number_format($complemento, 2) . "</p>";
        }
        echo "<p><strong>Salario Neto:</strong> " . number_format($salario_neto, 2) . "</p>";
    }
    ?>

</body>
</html>