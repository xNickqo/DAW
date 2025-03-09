<?php
 // Insertar la factura (Invoice)
function insertarReserva($conn, $id_reserva, $id_vuelo, $dni_cliente, $num_asientos, $preciototal){

    $sql = "INSERT INTO reservas(id_reserva, id_vuelo, dni_cliente, fecha_reserva, num_asientos, preciototal) 
            VALUES (:id_reserva, :id_vuelo, :dni_cliente, NOW(), :num_asientos, :preciototal)";

	$stmt = $conn->prepare($sql);

	$stmt->bindValue(':id_reserva', $id_reserva, PDO::PARAM_STR);
	$stmt->bindValue(':id_vuelo', $id_vuelo, PDO::PARAM_INT);
	$stmt->bindValue(':dni_cliente', $dni_cliente, PDO::PARAM_STR);
	$stmt->bindValue(':num_asientos', $num_asientos, PDO::PARAM_INT);
	$stmt->bindValue(':preciototal', $preciototal, PDO::PARAM_STR);
	
	$stmt->execute();

}
?>