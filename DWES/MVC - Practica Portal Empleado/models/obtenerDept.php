<?php
function obtenerDept($conn, $username) {
    try {
        $sql = "SELECT * FROM dept_manager WHERE emp_no = :emp_no";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':emp_no', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error en la obtencion del departamento: " . $e->getMessage();
        return null;
    }
}
?>