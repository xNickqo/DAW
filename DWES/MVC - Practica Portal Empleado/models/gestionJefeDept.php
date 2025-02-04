<?php
try {
    $conn->beginTransaction();

    // 1️⃣ Buscar al jefe actual del departamento seleccionado
    $sql = "SELECT emp_no FROM dept_manager WHERE dept_no = :dept_no AND to_date IS NULL";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":dept_no", $depto);
    $stmt->execute();
    $jefeActual = $stmt->fetch(PDO::FETCH_ASSOC);

    // 2️⃣ Si hay un jefe, finalizar su contrato
    if ($jefeActual) {
        $sql = "UPDATE dept_manager SET to_date = NOW() 
                WHERE emp_no = :emp_no AND dept_no = :dept_no AND to_date IS NULL";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":emp_no", $jefeActual['emp_no']);
        $stmt->bindParam(":dept_no", $depto);
        $stmt->execute();
    }

    // 3️⃣ Insertar el nuevo jefe en el departamento
    $sql = "INSERT INTO dept_manager (emp_no, dept_no, from_date, to_date) 
            VALUES (:emp_no, :dept_no, NOW(), NULL)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":emp_no", $emp_no);
    $stmt->bindParam(":dept_no", $depto);
    $stmt->execute();

    $conn->commit();
    $mensaje = "El empleado ha sido asignado como jefe del nuevo departamento.";
} catch (Exception $e) {
    $conn->rollBack();
    $mensaje = "Error al cambiar el jefe del departamento: " . $e->getMessage();
}
?>