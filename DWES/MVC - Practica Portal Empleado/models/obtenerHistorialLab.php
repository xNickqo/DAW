<?php
function obtenerHistorialLab($conn, $empleado){
    // Obtener historial laboral del empleado
    $sql = "SELECT d.dept_name, de.from_date, de.to_date, s.salary, s.from_date AS salary_from, s.to_date AS salary_to
            FROM dept_emp de
            JOIN departments d ON de.dept_no = d.dept_no
            JOIN salaries s ON de.emp_no = s.emp_no
            WHERE de.emp_no = :emp_no";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(":emp_no", $empleado);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>