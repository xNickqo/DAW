<?php
// Función que verifica si un usuario existe en la base de datos.
function obtenerReserva($conn) {
    try {
        $sql = "SELECT id_reserva FROM reservas ORDER BY id_reserva ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        trigger_error("Error en la obtencion de las reservas: " . $e->getMessage(), E_USER_ERROR);
    }
}
?>