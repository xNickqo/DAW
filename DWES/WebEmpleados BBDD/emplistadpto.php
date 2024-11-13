<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>empcambiodpto</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
    
        <label for="dpto">Departamento:</label>
        <select name="dpto" id="dpto" required>
            <option value="">Seleccione nombre departamento</option>
            <?php
                include "funciones_bbdd.php";
                
                $conn = ConexionBBDD();
                
                try {
                    $sql = "SELECT nombre, cod_dpto FROM dpto";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $arrayDpto = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($arrayDpto as $dpto) {
                        echo "<option value='" . htmlspecialchars($dpto['cod_dpto']) . "'>" . htmlspecialchars($dpto['nombre']) . "</option>";
                    }
                } catch(PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            ?>
        </select>
        <br>
        <input type="submit" value="Lista empleados">

    </form>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if (!empty($_POST['dpto']))
            {
                $cod_dpto = $_POST['dpto'];

                $sql = "SELECT emple.nombre 
                        FROM emple 
                        JOIN emple_dpto ON emple.dni = emple_dpto.dni
                        WHERE emple_dpto.cod_dpto = :cod_dpto";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':cod_dpto', $cod_dpto);
                $stmt->execute();

                $empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                if (count($empleados) > 0) {
                    echo "<ul>";
                        foreach ($empleados as $empleado) {
                            echo "<li>" . htmlspecialchars($empleado['nombre']) . "</li>";
                        }
                    echo "</ul>";
                } else {
                    echo "<p>No hay empleados en este departamento.</p>";
                }
            
            } else {
                echo "<p>Por favor, seleccione un departamento.</p>";
            }
        }
        //var_dump($arrayDpto);
        //var_dump($empleados);
    ?>
</body>
</html>