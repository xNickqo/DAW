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
    
    <?php if(!empty($res)){ ?>
    <table border=1>
        <thead>
            <th>InvoiceId</th>
            <th>InvoiceDate</th>
            <th>Total</th>
        </thead>
        <tbody>
            <?php

                    foreach($res as $factura){
                        echo "<tr>";
                            echo "<td>" . htmlspecialchars($factura['InvoiceId']) . "</td>";
                            echo "<td>" . htmlspecialchars($factura['InvoiceDate']) . "</td>";
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