<?php
$conn->beginTransaction();
try{
    // Verificar si el empleado pertenece a otro departamento actualmente
    $sql = "SELECT dept_no FROM dept_emp WHERE emp_no = :emp_no AND to_date IS NULL";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':emp_no', $emp_no);
    $stmt->execute();
    $current_dept = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($current_dept) {
        // Actualizar la fecha de salida del departamento actual
        $sql = "UPDATE dept_emp SET to_date = NOW() WHERE emp_no = :emp_no AND dept_no = :dept_no AND to_date IS NULL";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':emp_no', $emp_no);
        $stmt->bindParam(':dept_no', $current_dept['dept_no']);
        $stmt->execute();
    }

    // Insertar el nuevo departamento en la tabla dept_emp
    $sql = "INSERT INTO dept_emp (emp_no, dept_no, from_date) VALUES (:emp_no, :nuevo_depto, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':emp_no', $emp_no);
    $stmt->bindParam(':nuevo_depto', $nuevo_depto);

    if ($stmt->execute()) {
        $conn->commit();
        $mensaje = "Empleado transferido correctamente al nuevo departamento.";
    } else {
        $mensaje = "Error al transferir al empleado.";
    }
}catch(PDOException $e){
    $conn->rollBack();
    echo "Error en la transaccion ".$e->getMessage();
}
?>