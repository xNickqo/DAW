<?php
function obtenerNomina($conn, $empleado){
    $sql = "SELECT e.emp_no, e.first_name, e.last_name, e.hire_date, s.salary, d.dept_name, t.title
        FROM employees e
        JOIN salaries s ON e.emp_no = s.emp_no
        JOIN dept_emp de ON e.emp_no = de.emp_no
        JOIN departments d ON de.dept_no = d.dept_no
        JOIN titles t ON e.emp_no = t.emp_no
        WHERE e.emp_no = :emp_no";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(":emp_no", $empleado);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>