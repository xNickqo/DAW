<?php
//Insertar datos en invoiceLine
function insertarInvoiceLine($conn, $invoiceLineId, $invoiceId, $trackId, $unitPrice, $quantity){
    $sql = "INSERT INTO InvoiceLine(InvoiceLineId, InvoiceId, TrackId, UnitPrice, Quantity) 
            VALUES (:invoiceLineId, :invoiceId, :trackId, :unitPrice, :quantity)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':invoiceLineId', $invoiceLineId, PDO::PARAM_INT);
    $stmt->bindValue(':invoiceId', $invoiceId, PDO::PARAM_INT);
    $stmt->bindValue(':trackId', $trackId, PDO::PARAM_INT);
    $stmt->bindValue(':unitPrice', $unitPrice, PDO::PARAM_STR);
    $stmt->bindValue(':quantity', $quantity, PDO::PARAM_INT);

    $stmt->execute();
}
?>
