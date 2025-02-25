<?php
try{
    $sql = "INSERT INTO employees (emp_no, birth_date, first_name, last_name, gender, hire_date)
    VALUES (:emp_no, :birth_date, :first_name, :last_name, :gender, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':emp_no', $n);
    $stmt->bindParam(':birth_date', $fechaNac);
    $stmt->bindParam(':first_name', $nombre);
    $stmt->bindParam(':last_name', $apellido);
    $stmt->bindParam(':gender', $genero);
    $stmt->execute();
}catch(PDOException $e){
    $mensaje = "Error al insertar empleado: ".$e->getMessage();
}
?>