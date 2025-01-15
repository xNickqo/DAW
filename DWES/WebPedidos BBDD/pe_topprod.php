<?php
    session_start();

    include "includes/1_funcionesModelo.php";
    include "includes/2_funcionesVista.php";
    include "includes/3_funcionesControlador.php";

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
    <title>Productos Más Vendidos</title>
</head>
<body>
    <h2>Consultar Unidades Totales Vendidas por Producto</h2>
    <form method="POST">
        <label for="startDate">Fecha Inicio:</label>
        <input type="date" name="startDate" required>
        <br>
        <label for="endDate">Fecha Fin:</label>
        <input type="date" name="endDate" required>
        <br><br>
        <input type="submit" name="consultar" value="Consultar">
    </form>

    <a href="pe_inicio.php">Volver al inicio</a>

    <?php
    if (isset($_POST['consultar'])) {
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];

        // Validar que las fechas sean correctas
        if ($startDate > $endDate) {
            echo "<p style='color:red;'>La fecha de inicio no puede ser posterior a la fecha de fin.</p>";
        } else {
            $conn = conexionBBDD();

            $result = obtenerUnidadesVendidas($conn, $startDate, $endDate);

            imrpimirUnidadesVendidas($result);
        }
    }
    ?>
</body>
</html>
