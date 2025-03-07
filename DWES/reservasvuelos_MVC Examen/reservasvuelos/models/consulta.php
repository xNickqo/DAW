<?php
/* Funcion para obtener todos los datos de las facturas */
function consulta($conn){
    try {
        $sql = 'SELECT v.id_aerolinea, v.origen, v.destino, v.fechahorasalida, v.fechahorallegada, r.num_asientos 
                FROM reservas r
                JOIN vuelos v ON r.id_vuelo = v.id_vuelo
                WHERE r.id_reserva = :id_reserva';

        $stmt = $conn->prepare($sql);
        
        $stmt->bindValue(':id_reserva', $_POST['reserva'], PDO::PARAM_STR);
        
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        trigger_error("Error en la obtencion de las facturas: " . $e->getMessage(), E_USER_ERROR);
    }
}


?>