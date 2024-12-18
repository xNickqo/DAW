<?php
    session_start();
    include('includes/funciones.php');

    if (!isset($_SESSION['usuario'])) {
        header("Location: pe_login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Pagos Realizados</title>
</head>
<body>
    <h2>Consultar Pagos Realizados</h2>
    <form method="POST">
        <label for="customerNumber">Cliente:</label>
        <select name="customerNumber" required>
            <?php
                $conn = conexionBBDD();
                $sql = "SELECT customerNumber, customerName FROM customers";
                imprimirOpciones($sql, 'customerNumber', 'customerName');
            ?>
        </select>
        <br>
        <label for="startDate">Fecha Inicio:</label>
        <input type="date" name="startDate">
        <br>
        <label for="endDate">Fecha Fin:</label>
        <input type="date" name="endDate">
        <br><br>
        <input type="submit" name="consultar" value="Consultar">
    </form>

    <a href="pe_inicio.php">Volver al inicio</a>

    <?php
        $customerNumber = $_POST['customerNumber'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];

        if (isset($_POST['consultar']) && (!empty($startDate) && !empty($endDate)))
            consultarPayments($customerNumber, $startDate, $endDate);
    ?>
</body>
</html>
