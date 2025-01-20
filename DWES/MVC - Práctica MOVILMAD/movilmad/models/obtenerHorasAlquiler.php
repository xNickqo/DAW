<?php
function obtenerHorasAlquiler($conn, $fechaDevolucion, $matricula){
    $sql = "SELECT TIMESTAMPDIFF(HOUR, fecha_alquiler, :fecha_devolucion) AS horas_alquiler, preciobase
                FROM ralquileres
                JOIN rvehiculos ON ralquileres.matricula = rvehiculos.matricula
                WHERE ralquileres.matricula = :matricula 
                AND fecha_devolucion IS NULL";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':fecha_devolucion', $fechaDevolucion);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>