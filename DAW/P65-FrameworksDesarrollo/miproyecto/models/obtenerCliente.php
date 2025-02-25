<?php
// Función que verifica si un usuario existe en la base de datos, dado su número de cliente.
function obtenerCliente($conn, $username) {
    try {
        $sql = "SELECT * FROM employees WHERE emp_no = :emp_no";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':emp_no', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error en la obtencion de los datos del usuario: " . $e->getMessage();
        return null;
    }
}
?>