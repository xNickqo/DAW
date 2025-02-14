<?php
include_once "../controllers/gestionSesiones.php";
var_dump($_SESSION['usuario']);

include_once "../db/conexionBBDD.php";
$conn = conexionBBDD();

include_once "../models/obtenerEmpleados.php";
$empleados = obtenerEmpleados($conn);

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $empleado = $_POST["emp"];

    // Obtener historial laboral del empleado
    $sql = "SELECT d.dept_name, de.from_date, de.to_date, s.salary, s.from_date AS salary_from, s.to_date AS salary_to
            FROM dept_emp de
            JOIN departments d ON de.dept_no = d.dept_no
            JOIN salaries s ON de.emp_no = s.emp_no
            WHERE de.emp_no = :emp_no
            ORDER BY de.from_date DESC, s.from_date DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(":emp_no", $empleado);
    $stmt->execute();

    $historial = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$historial) {
        echo "Error: No se encontraron datos del historial laboral.";
        exit();
    }
}

$conn = null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial Laboral</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Historial Laboral</h2>
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
        <input type="submit" name="" value="Obtener historial laboral"><br>

        <table border="1">
            <tr>
                <th>Departamento</th>
                <th>Desde</th>
                <th>Hasta</th>
                <th>Salario</th>
                <th>Desde</th>
                <th>Hasta</th>
            </tr>
            <?php if(isset($historial)) foreach ($historial as $registro) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($registro['dept_name']); ?></td>
                    <td><?php echo htmlspecialchars($registro['from_date']); ?></td>
                    <td><?php echo htmlspecialchars($registro['to_date']); ?></td>
                    <td><?php echo number_format($registro['salary'], 2); ?></td>
                    <td><?php echo htmlspecialchars($registro['salary_from']); ?></td>
                    <td><?php echo htmlspecialchars($registro['salary_to']); ?></td>
                </tr>
            <?php } ?>
        </table>

        <a href="../controllers/logout.php">Cerrar sesion</a><br>
        <a href="../controllers/inicio.php">Volver al inicio</a>
    </form>
</body>
</html>
<?php $conn = null; ?>