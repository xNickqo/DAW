<?php
function actualizarVehiculosDisponibles($conn){
    foreach ($_SESSION['carrito'] as $matricula) {
        $sql = "UPDATE rvehiculos SET disponible = 'N' WHERE matricula = :matricula";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->execute();
    }
}
?>