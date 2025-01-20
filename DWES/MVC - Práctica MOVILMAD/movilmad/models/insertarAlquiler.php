<?php
function insertarAlquiler($conn) {
    foreach ($_SESSION['carrito'] as $matricula) {
        $sql = "INSERT INTO ralquileres (idcliente, matricula, fecha_alquiler, fecha_devolucion, preciototal, fechahorapago)
                VALUES (:idcliente, :matricula, NOW(), NULL, NULL, NULL)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':idcliente', $_SESSION['usuario']['idcliente']);
        $stmt->bindParam(':matricula', $matricula);

        $stmt->execute();
    }
}
?>