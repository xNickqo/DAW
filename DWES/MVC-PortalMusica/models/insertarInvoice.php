<?php
 // Insertar la factura (Invoice)
function insertarInvoice($conn, $invoiceId, $customerId, $billingAddress, $billingCity, $billingState, $billingCountry, $billingPostalCode, $totalPrice){

    $sql = "INSERT INTO Invoice(InvoiceId, CustomerId, InvoiceDate, BillingAddress, BillingCity, BillingState, BillingCountry, BillingPostalCode, Total) 
            VALUES (:invoiceId, :customerId, NOW(), :billingAddress, :billingCity, :billingState, :billingCountry, :billingPostalCode, :totalPrice)";

    $stmt = $conn->prepare($sql);

    $stmt->bindValue(':invoiceId', $invoiceId, PDO::PARAM_INT);
    $stmt->bindValue(':customerId', $customerId, PDO::PARAM_INT);
    $stmt->bindValue(':billingAddress', $billingAddress, PDO::PARAM_STR);
    $stmt->bindValue(':billingCity', $billingCity, PDO::PARAM_STR);
    $stmt->bindValue(':billingState', $billingState, PDO::PARAM_STR);
    $stmt->bindValue(':billingCountry', $billingCountry, PDO::PARAM_STR);
    $stmt->bindValue(':billingPostalCode', $billingPostalCode, PDO::PARAM_STR);
    $stmt->bindValue(':totalPrice', $totalPrice, PDO::PARAM_STR);

    $stmt->execute();

}
?>