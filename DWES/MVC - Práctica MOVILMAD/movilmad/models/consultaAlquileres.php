<?php
function consultaAlquileres($conn){
    try {
        $sql = "SELECT 
                    ralquileres.matricula,
                    rvehiculos.marca,
                    rvehiculos.modelo,
                    ralquileres.fecha_alquiler,
                    ralquileres.fecha_devolucion,
                    ralquileres.preciototal
                FROM ralquileres
                JOIN rvehiculos ON ralquileres.matricula = rvehiculos.matricula
                WHERE ralquileres.idcliente = :id_cliente
                ORDER BY ralquileres.fecha_alquiler ASC";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_cliente', $_SESSION['usuario']['idcliente']);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        return "Error al consultar los alquileres: " . $e->getMessage();
    }
} 
?>