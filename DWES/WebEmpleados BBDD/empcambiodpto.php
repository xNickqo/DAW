<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>empcambiodpto</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <label for="dni">DNI:</label>
        <select name="dni" id="dni">
            <option value=""></option>
            <?php
                $conn = ConexionBBDD();

                $sql = "SELECT dni, nombre FROM emple";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $arrayEmple = $stmt->fetchAll(PDO::FETCH_ASSOC);

                var_dump($arrayEmple);

                foreach ($arrayEmple as $emple) {
                    echo "<option value='" . htmlspecialchars($emple['nombre']) . "'>" . htmlspecialchars($emple['dni']) . "</option>";
                }
            ?>
        </select>
        <label for="cod_dpto">Selecciona Nuevo Departamento:</label>
        <select name="cod_dpto" id="cod_dpto" required>
            <option value="">Seleccione un departamento</option>
            <?php
                $sql = "SELECT cod_dpto, nombre FROM dpto";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $arrayDpto = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($arrayDpto as $dpto) {
                    echo "<option value='" . htmlspecialchars($dpto['cod_dpto']) . "'>" . htmlspecialchars($dpto['nombre']) . "</option>";
                }
            ?>
        </select>

        <input type="submit" value="Asignar Departamento">

    </form>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if (!empty($_POST['dni']) && !empty($_POST['cod_dpto']))
            {
                $dni = $_POST['dni'];
                $cod_dpto = $_POST['cod_dpto'];

                // Actualiza el departamento del empleado
                $sql = "UPDATE emple SET cod_dpto = :cod_dpto WHERE dni = :dni";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':cod_dpto', $cod_dpto);
                $stmt->bindParam(':dni', $dni);

                if ($stmt->execute()) {
                    echo "<p>El departamento se asignó correctamente.</p>";
                } else {
                    echo "<p>Error al asignar el departamento.</p>";
                }
            } else {
                echo "<p>Por favor, seleccione un empleado y un departamento.</p>";
            }
        }
    ?>
</body>
</html>