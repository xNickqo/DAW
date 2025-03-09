<?php
//Insertar datos en detalle_pedido
function insertarDetallePedido($conn, $pedido_id, $producto_id, $cantidad, $subtotal){
    $sql = "INSERT INTO detalle_pedidos(pedido_id, producto_id, cantidad, subtotal) 
            VALUES (:pedido_id, :producto_id, :cantidad, :subtotal)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':pedido_id', $pedido_id, PDO::PARAM_INT);
    $stmt->bindValue(':producto_id', $producto_id, PDO::PARAM_INT);
    $stmt->bindValue(':cantidad', $cantidad, PDO::PARAM_INT);
    $stmt->bindValue(':subtotal', $subtotal, PDO::PARAM_INT);

    $stmt->execute();
}
?>
