<?php

function updateAsientos($conn, $idVuelo, $numAsientos){
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "UPDATE vuelos set asientos_disponibles = asientos_disponibles - :asientos where id_vuelo = :id_vuelo";
    
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':asientos', $numAsientos);
    $stmt->bindParam(':id_vuelo', $idVuelo);

    $stmt->execute();
}

?>