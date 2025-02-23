<?php
//Obtener todos los datos de 100 canciones aleatorias de la tabla tracks
function obtenerAllTracks($conn) {
    try {
        $sql = 'SELECT TrackId, Name, Composer, UnitPrice FROM track ORDER BY RAND() LIMIT 100';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        trigger_error("Error en la obtencion de las canciones: " . $e->getMessage(), E_USER_ERROR);
    }
}
?>