<?php
function obtenerAllDepts($conn) {
    try {
        $sql = 'SELECT * FROM departments';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        echo "Error en la obtencion de los departamentos: " . $e->getMessage();
        return null;
    }
}
?>