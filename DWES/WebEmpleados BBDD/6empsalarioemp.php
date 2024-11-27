<?php
    include "funciones_bbdd.php";

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        
        <label for="nombre">Seleccione un empleado:</label>
        <select name="nombre" id="nombre" required>
            <option value="">Seleccione</option>
            <?php
                // Cargar los usuarios en el formulario
                $conn = ConexionBBDD();
                if ($conn) {
                    $empleados = obtenerEmpleados($conn);
                    foreach ($empleados as $emple) {
                        echo "<option>" . htmlspecialchars($emple['nombre']) . "</option>";
                    }
                    $conn = null;
                }
            ?>
        </select>
        <label for="porcentaje">Porcentaje</label>
        <input type="text" id="porcentaje">
        <br><br>
        <input type="submit" value="Ver salarios">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['nombre'])) {
        $porcentaje = $_POST['porcentaje'];
        $nombre = $_POST['nombre'];

        $conn = ConexionBBDD();
        if ($conn) {
            foreach($empleados as $emple){
                $salario = $nombre['salario'];
                $nuevo_salario = $salario * (1+$porcentaje/100);
            }
            
        }
    }
    ?>
</body>
</html>