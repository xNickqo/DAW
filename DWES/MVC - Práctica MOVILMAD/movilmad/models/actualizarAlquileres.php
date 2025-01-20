<?php
function actualizarAlquileres($conn, $fechaDevolucion, $precioTotal, $matricula){
    try{
        $conn->beginTransaction();

        /*Completamos los campos restantes dentro de la tabla alquileres, es decir, 
        la fecha de devolucion, el precio a pagar y la fecha de pago*/
        $sql = "UPDATE ralquileres 
                SET fecha_devolucion = :fecha_devolucion, 
                    preciototal = :preciototal, 
                    fechahorapago = :fechahorapago
                WHERE matricula = :matricula 
                AND fecha_devolucion IS NULL";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':fecha_devolucion', $fechaDevolucion);
        $stmt->bindParam(':preciototal', $precioTotal);
        $stmt->bindParam(':fechahorapago', $fechaDevolucion);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->execute();

        //Actualizamos la disponibilidad del vehiculo en la tabla rvehiculos
        $sql = "UPDATE rvehiculos 
                SET disponible = 'S' 
                WHERE matricula = :matricula";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->execute();

        //Actualizamos si el cliente para que el cliente no este pendiente de pagos
        $sql = "UPDATE rclientes 
                SET pendiente_pago = 0 
                WHERE idcliente = :id_cliente";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_cliente', $_SESSION['usuario']['idcliente']);
        $stmt->execute();

        $conn->commit();
    }catch(PDOException $e){
        $conn->rollback();
        echo $e->getMessage();
    }
}
?>