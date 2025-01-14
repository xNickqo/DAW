<?php
function obtenerVehiculosDisponibles($conn){
    $sql = "SELECT * FROM rvehiculos WHERE disponible = 'S'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>