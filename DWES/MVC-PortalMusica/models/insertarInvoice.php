<?
function insertarInvoice($conn, $invoiceId, $customerId, $billingAddress, $billingCity, $billingState, $billingCountry, $billingPostalCode, $totalPrice){
    try{
    
        // Insertar la factura (Invoice)
        $sql = "INSERT INTO Invoice(InvoiceId, CustomerId, InvoiceDate, BillingAddress, BillingCity, BillingState, BillingCountry, BillingPostalCode, Total) 
                VALUES (:invoiceId, :customerId, NOW(), :billingAddress, :billingCity, :billingState, :billingCountry, :billingPostalCode, :totalPrice)";
    
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':invoiceId', $invoiceId);
        $stmt->bindParam(':customerId', $customerId);
        $stmt->bindParam(':billingAddress', $billingAddress);
        $stmt->bindParam(':billingCity', $billingCity);
        $stmt->bindParam(':billingState', $billingState);
        $stmt->bindParam(':billingCountry', $billingCountry);
        $stmt->bindParam(':billingPostalCode', $billingPostalCode);
        $stmt->bindParam(':totalPrice', $totalPrice);
        $stmt->execute();
    } catch (PDOException $e){
        echo "Error en la insercion de invoice: ".$e->getMessage();
    }
}
?>