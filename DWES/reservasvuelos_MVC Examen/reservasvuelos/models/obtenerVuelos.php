<?php
//Obtener todos los vuelos con disponibilidad de asientos
function obtenerVuelos($conn) {
    try {
        $sql = 'SELECT * FROM vuelos WHERE asientos_disponibles > 0';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        trigger_error("Error en la obtencion de los vuelos: " . $e->getMessage(), E_USER_ERROR);
    }
}
?>