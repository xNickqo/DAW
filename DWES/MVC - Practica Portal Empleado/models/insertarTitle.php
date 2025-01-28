<?php
try{
    $sql = "INSERT INTO titles (emp_no, title, from_date, to_date)
					VALUES (:emp_no, :title, NOW(), NULL)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':emp_no', $n);
    $stmt->bindParam(':title', $cargo);
    $stmt->execute();
}catch(PDOException $e){
    $mensaje = "Error al insertar dept: ".$e->getMessage();
}
?>