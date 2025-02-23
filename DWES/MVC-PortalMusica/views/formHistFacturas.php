<?php include_once "../controllers/gestionSesiones.php";?>
<html>
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Historial de facturas</title>
 </head>

<body>
    <h1>Historial de Facturas</h1>
    <form action="" method="post">
        <input type="submit" name="mostrar" value="Mostrar historial de facturas">
        <br>
    </form>
    
    <table border=1>
        <thead>
            <th>InvoiceId</th>
            <th>InvoiceDate</th>
            <th>BillingAddress</th>
            <th>BillingCity</th>
            <th>BillingState</th>
            <th>BillingCountry</th>
            <th>BillingPostalCode</th>
            <th>Total</th>
        </thead>
        <tbody>
            <?php
                if(!empty($res)){
                    foreach($res as $factura){
                        echo "<tr>";
                            echo "<td>" . htmlspecialchars($factura['InvoiceId']) . "</td>";
                            echo "<td>" . htmlspecialchars($factura['InvoiceDate']) . "</td>";
                            echo "<td>" . htmlspecialchars($factura['BillingAddress']) . "</td>";
                            echo "<td>" . htmlspecialchars($factura['BillingCity']) . "</td>";
                            echo "<td>" . htmlspecialchars($factura['BillingState']) . "</td>";
                            echo "<td>" . htmlspecialchars($factura['BillingCountry']) . "</td>";
                            echo "<td>" . htmlspecialchars($factura['BillingPostalCode']) . "</td>";
                            echo "<td>" . htmlspecialchars($factura['Total']) . "€</td>";
                        echo "</tr>";
                    }
                }
            ?>
        </tbody>
    </table>
    <br>
    <a href="../controllers/inicio.php">Volver a la Página Principal</a><br>
    <a href="../controllers/logout.php">Cerrar Sesión</a>

</body>
</html>