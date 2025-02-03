<?php
    include_once "../controllers/gestionSesiones.php";
    include_once "../db/conexionBBDD.php";
    $conn = conexionBBDD();

    include_once "../models/obtenerAllDepts.php";
    $depts = obtenerAllDepts($conn);

    if(isset($_POST['info'])){
        $dep = $_POST['depts'];

        if (empty($dep)) {
            $mensaje = "Por favor, selecciona un departamento.";
        } else {
            $sql_employees = "
                SELECT e.emp_no, e.first_name, e.last_name, e.birth_date, e.hire_date, e.gender
                FROM employees e
                JOIN dept_emp de ON e.emp_no = de.emp_no
                WHERE de.dept_no = :dept_no";
            $stmt_employees = $conn->prepare($sql_employees);
            $stmt_employees->bindParam(':dept_no', $dep);
            $stmt_employees->execute();
            $employees = $stmt_employees->fetchAll(PDO::FETCH_ASSOC);

            if ($employees) {
                $mensaje = "<h2>Empleados en el departamento ". $depts['dept_name']. "</h2>";

                foreach ($employees as $employee) {
                    $mensaje .= "Empleado: " . htmlspecialchars($employee['first_name']) . " " . htmlspecialchars($employee['last_name']) . "<br>";
                    $mensaje .= "ID: " . htmlspecialchars($employee['emp_no']) . "<br>";
                    $mensaje .= "Fecha de nacimiento: " . htmlspecialchars($employee['birth_date']) . "<br>";
                    $mensaje .= "Fecha de contratación: " . htmlspecialchars($employee['hire_date']) . "<br>";
                    $mensaje .= "Género: " . htmlspecialchars($employee['gender']) . "<br><br>";
                }
            }
        }
    }

    $conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Departamentos</title>
</head>
<body>
    <h1>Información acerca de los departamentos</h1>
    <form action="" method="POST">
        <select name="depts" id="depts">
            <option value="">Seleccione una opción</option>
            <?php
                foreach($depts as $dept){
                    echo "<option value=". $dept['dept_no'] .">". $dept['dept_name'] ."</option>";
                }
            ?>
        </select>

        <input type="submit" name="info" value="Obtener info">

        <?php if (isset($mensaje)) echo "<p>$mensaje</p>"; ?>
    </form>
</body>
</html>
