<?php
function obtenerMaxEmp_no($conn){
    try {
        $sql = 'SELECT MAX(emp_no) FROM employees';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $orderNumber = $stmt->fetchColumn();
        $orderNumber = (int)$orderNumber + 1;
        return $orderNumber;
    } catch (PDOException $e){
        echo "Error: " . $e->getMessage();
        return null;
    }
}
?>