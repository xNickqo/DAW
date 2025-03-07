<?php
function obtenerMaxId($conn) {
    try {
        $sql = "SELECT MAX(id_reserva) FROM reservas";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $id = $stmt->fetchColumn();
        
       return $id;
    } catch(PDOException $e) {
        trigger_error("Error al obtener el nuevo id en la tabla invoice: ".$e->getMessage(), E_ERROR);
    }
}
?>