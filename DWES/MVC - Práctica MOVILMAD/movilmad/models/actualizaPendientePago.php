<?php
function actualizaPendientePago($conn, $precioTotal){
    //Actualizamos si el cliente esta pendiente de pago en la tabla rclientes
    $sql = "UPDATE rclientes 
            SET pendiente_pago = pendiente_pago + :precio_total 
            WHERE idcliente = :id_cliente";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':precio_total', $precioTotal);
    $stmt->bindParam(':id_cliente', $_SESSION['usuario']['idcliente']);
    $stmt->execute();
} 
?>