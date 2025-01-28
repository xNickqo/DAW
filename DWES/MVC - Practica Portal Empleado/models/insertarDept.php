<?php
try{
    $sql = "INSERT INTO dept_emp (emp_no, dept_no, from_date, to_date)
			VALUES (:emp_no, :dept_no, NOW(), NULL)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':emp_no', $n);
    $stmt->bindParam(':dept_no', $dpt);
    $stmt->execute();
}catch(PDOException $e){
    $mensaje = "Error al insertar dept: ".$e->getMessage();
}
?>