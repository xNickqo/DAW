<?php
// --- Obtener los salarios del empleado ---
$sql = "SELECT salary, from_date, to_date FROM salaries WHERE emp_no = :emp_no ORDER BY from_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':emp_no', $emp_no);
$stmt->execute();
$salaries = $stmt->fetchAll(PDO::FETCH_ASSOC);

// --- Obtener los títulos del empleado ---
$sql = "SELECT title, from_date, to_date FROM titles WHERE emp_no = :emp_no ORDER BY from_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':emp_no', $emp_no);
$stmt->execute();
$titles = $stmt->fetchAll(PDO::FETCH_ASSOC);

// --- Obtener los departamentos en los que ha trabajado el empleado ---
$sql = "
    SELECT d.dept_name, de.from_date, de.to_date 
    FROM dept_emp de 
    JOIN departments d ON de.dept_no = d.dept_no 
    WHERE de.emp_no = :emp_no 
    ORDER BY de.from_date DESC
";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':emp_no', $emp_no);
$stmt->execute();
$departments = $stmt->fetchAll(PDO::FETCH_ASSOC);

// --- Obtener los datos básicos del empleado ---
$sql = "SELECT first_name, last_name, birth_date, hire_date, gender FROM employees WHERE emp_no = :emp_no";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':emp_no', $emp_no);
$stmt->execute();
$employee = $stmt->fetch(PDO::FETCH_ASSOC);
?>