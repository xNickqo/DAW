<?php

function obtenerEmpleados($conn) {
    try {
        $sql = "SELECT * FROM employees";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error en la obtencion de los empleados en el desplegable: " . $e->getMessage();
        return null;
    }
}
?>