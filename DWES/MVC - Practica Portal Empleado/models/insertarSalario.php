<?php
try{
    $sql = "INSERT INTO salaries (emp_no, salary, from_date, to_date)
                VALUES (:emp_no, :salary, NOW(), NULL)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':emp_no', $n);
    $stmt->bindParam(':salary', $salario);
    $stmt->execute();
}catch(PDOException $e){
    $mensaje = "Error al insertar salario: ".$e->getMessage();
}
?>