<?php
function obtenerAllTracks($conn) {
    try {
        $sql = 'SELECT * FROM track';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        trigger_error("Error en la obtencion de las canciones: " . $e->getMessage(), E_USER_ERROR);
        return null;
    }
}
?>