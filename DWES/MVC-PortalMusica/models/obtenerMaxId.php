<?php
function obtenerMaxInvoiceId($conn) {
    try {
        $sql = "SELECT MAX(InvoiceId) FROM invoice";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $invoiceId = $stmt->fetchColumn();
        $invoiceId = (int)$invoiceId + 1;
        //echo "Nuevo invoiceId ". $invoiceId . "<br>";
        return $invoiceId;
    } catch(PDOException $e) {
        trigger_error("Error al obtener el nuevo id en la tabla invoice: ".$e->getMessage(), E_ERROR);
    }
}

function obtenerMaxInvoiceLineId($conn) {
    try{
        $sql = "SELECT MAX(InvoiceLineId) FROM invoiceline";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $invoiceLineId = $stmt->fetchColumn();
        $invoiceLineId = (int)$invoiceLineId + 1;
        //echo "Nuevo invoiceLineId ". $invoiceLineId . "\n";
        return $invoiceLineId;
    } catch(PDOException $e) {
        trigger_error("Error al obtener el nuevo id en la tabla invoiceLine".$e->getMessage(), E_ERROR);
    }
}
?>