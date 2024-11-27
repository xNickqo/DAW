<?php
    include "funciones_bbdd.php";

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>emphistdpto</title>
</head>
<body>
    <h1>Histórico de Empleados por Departamento</h1>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        
        <label for="departamento">Seleccione un Departamento:</label>
        <select name="departamento" id="departamento" required>
            <option value="">Seleccione</option>
            <?php
                // Cargar los departamentos en el formulario
                $conn = ConexionBBDD();
                if ($conn) {
                    $departamentos = obtenerDepartamentos($conn);
                    foreach ($departamentos as $dpto) {
                        echo "<option value='" . htmlspecialchars($dpto['cod_dpto']) . "'>" . htmlspecialchars($dpto['nombre']) . "</option>";
                    }
                    $conn = null;
                }
            ?>
        </select>
        <br><br>
        <input type="submit" value="Ver Histórico">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['departamento'])) {
        
        $cod_dpto = $_POST['departamento'];

        $conn = ConexionBBDD();
        if ($conn) {

            $historico = obtenerHistoricoEmpleados($conn, $cod_dpto);
            if (!empty($historico)) {

                echo "<h2>Histórico de empleados en el departamento seleccionado:</h2>";
                echo "<table border='1'>";
                echo "<tr><th>DNI</th><th>Nombre</th><th>Apellidos</th><th>Fecha Inicio</th><th>Fecha Fin</th></tr>";
                
                foreach ($historico as $empleado) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($empleado['dni']) . "</td>";
                    echo "<td>" . htmlspecialchars($empleado['nombre']) . "</td>";
                    echo "<td>" . htmlspecialchars($empleado['apellidos']) . "</td>";
                    echo "<td>" . htmlspecialchars($empleado['fecha_ini']) . "</td>";
                    echo "<td>" . htmlspecialchars($empleado['fecha_fin']) . "</td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<p>No hay empleados históricos en este departamento (excluyendo los actuales).</p>";
            }
            $conn = null; 
        }
    }
    ?>
</body>
</html>
