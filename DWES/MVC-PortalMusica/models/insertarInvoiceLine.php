<?php

function insertarInvoiceLine($conn, $invoiceLineId, $invoiceId, $quantity){
    try{
        
    
        // Insertar las líneas de factura (InvoiceLine)
        $sql = "INSERT INTO InvoiceLine(InvoiceLineId, InvoiceId, TrackId, UnitPrice, Quantity) 
        VALUES (:InvoiceLineId, :invoiceId, :trackId, :unitPrice, :quantity)";

        $stmt = $conn->prepare($sql);

        // Iterar sobre el carrito y insertar las líneas
        foreach ($_SESSION['carrito'] as $item) {
            $stmt->bindParam(':invoiceLineId', $invoiceLineId);
            $stmt->bindParam(':invoiceId', $invoiceId);
            $stmt->bindParam(':trackId', $item['TrackId']);
            $stmt->bindParam(':unitPrice', $item['UnitPrice']);
            $stmt->bindParam(':quantity', $quantity);

            $stmt->execute();

            $invoiceLineId++;
        }
    } catch (PDOException $e){
        echo "Error en la insercion de invoiceLine: ".$e->getMessage();
    }
}
?>
