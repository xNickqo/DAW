<?php
// Función que verifica si un usuario existe en la base de datos, dado su número de cliente.
function obtenerCliente($conn, $email) {
    try {
        $sql = "SELECT * FROM rclientes WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error en la obtencion de los datos del usuario: " . $e->getMessage();
        return null;
    }
}
?>