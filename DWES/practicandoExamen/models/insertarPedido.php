<?php
//Insertar datos en pedido
function insertarPedido($conn, $usuario_id, $total){
    $sql = "INSERT INTO pedidos(usuario_id, total, fecha) 
            VALUES (:usuario_id, :total, NOW())";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':usuario_id', $usuario_id, PDO::PARAM_INT);
    $stmt->bindValue(':total', $total, PDO::PARAM_INT);

    $stmt->execute();
}
?>
