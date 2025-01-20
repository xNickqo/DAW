<?php
function obtenerVehiculosAlquilados($conn){
    $sql = "SELECT matricula, fecha_alquiler 
                FROM ralquileres 
                WHERE idcliente = :idcliente AND fecha_devolucion IS NULL";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idcliente',$_SESSION['usuario']['idcliente'], PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>