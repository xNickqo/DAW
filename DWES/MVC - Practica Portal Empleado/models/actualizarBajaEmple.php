<?php
try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->beginTransaction();
    $stmt = $conn->prepare("UPDATE employees set end_date = NOW() where emp_no = :numEmp");
    $stmt->bindParam(':numEmp', $empleado);
    $stmt->execute();
    $mensaje="Empleado dado de baja con exito";
    $conn->commit();
} catch(PDOException $e) {
    $conn->rollBack();
    $mensaje = "Error: " . $e->getMessage();
}

?>