<?php
/* Funcion para obtener el ranking de descargas de canciones entre dos fechas */
function obtenerRanking($conn, $inicio, $final) {
    try {
        $sql = 'SELECT t.Name, SUM(il.Quantity) AS Downloads
                FROM InvoiceLine il
                JOIN Track t ON il.TrackId = t.TrackId
                JOIN Invoice i ON il.InvoiceId = i.InvoiceId
                WHERE i.InvoiceDate BETWEEN :startDate AND :endDate
                GROUP BY t.TrackId
                ORDER BY Downloads DESC
                LIMIT 10';

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':startDate', $inicio, PDO::PARAM_STR);
        $stmt->bindValue(':endDate', $final, PDO::PARAM_STR);

        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        trigger_error("Error al obtener el ranking de descargas: " . $e->getMessage(), E_USER_ERROR);
    }
}

?>