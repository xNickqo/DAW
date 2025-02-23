<?php
/* Funcion para obtener todos los datos de las facturas */
function obtenerInvoice($conn){
    try {
        $sql = 'SELECT * FROM invoice WHERE CustomerId = :CustomerId';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':CustomerId', $_SESSION['usuario']['CustomerId'], PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        trigger_error("Error en la obtencion de las facturas invoice: " . $e->getMessage(), E_USER_ERROR);
    }
}

/* Funcion para obtener todos los datos de las facturas unitarias */
function obtenerInvoiceFechas($conn, $inicio, $fin) {
    try {
        $sql = 'SELECT * FROM invoice 
                WHERE CustomerId = :CustomerId 
                AND InvoiceDate BETWEEN :inicio AND :fin';
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':CustomerId', $_SESSION['usuario']['CustomerId'], PDO::PARAM_INT);
        $stmt->bindValue(':inicio', $inicio, PDO::PARAM_STR);
        $stmt->bindValue(':fin', $fin, PDO::PARAM_STR);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        trigger_error("Error en la obtención de las facturas invoiceLine: " . $e->getMessage(), E_USER_ERROR);
    }
}

?>