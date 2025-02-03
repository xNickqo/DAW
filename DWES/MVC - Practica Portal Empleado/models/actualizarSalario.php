<?php
try{
    // 1. Primero, actualizar el salario actual a una fecha de fin (to_date) para que no haya solapamiento de fechas
    $sql_update = "UPDATE salaries SET to_date = NOW() WHERE emp_no = :emp_no AND to_date IS NULL";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bindParam(':emp_no', $emp_no);
    $stmt_update->execute();

    // 2. Insertar un nuevo registro en la tabla de salarios con el nuevo salario
    $sql_insert = "INSERT INTO salaries (emp_no, salary, from_date, to_date) 
                VALUES (:emp_no, :salary, NOW(), NULL)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bindParam(':emp_no', $emp_no);
    $stmt_insert->bindParam(':salary', $salario);
    if ($stmt_insert->execute()) {
        $mensaje = "Salario modificado correctamente.";
    } else {
        $mensaje = "Error al insertar el nuevo salario.";
    }
}catch(PDOException $e){
    echo "Error en la actualizacion del sueldo: ".$e->getMessage();
}

?>