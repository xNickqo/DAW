<?php

function updateAsientos($conn, $id_producto, $stock){
    $sql = "UPDATE productos set stock = :stock where id = :id";
    
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':stock', $numAsientos);
    $stmt->bindParam(':id', $id_producto);

    $stmt->execute();
}

?>