<?php

function updateAsientos($conn, $idVuelo, $numAsientos){   
    $sql = "UPDATE vuelos set asientos_disponibles = asientos_disponibles - :asientos where id_vuelo = :id_vuelo";
    
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':asientos', $numAsientos);
    $stmt->bindParam(':id_vuelo', $idVuelo);

    $stmt->execute();
}

?>