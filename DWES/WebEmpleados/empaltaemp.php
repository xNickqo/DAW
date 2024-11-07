<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2</title>
</head>
<body>
    <form action="<?php  echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <label for="dni">DNI:</label>
        <input type="text" name="dni" id="dni"><br>
    
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre"><br>

        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" id="apellidos"><br>

        <label for="salario">Salario:</label>
        <input type="text" name="salario" id="salario"><br>

        <label for="fecha_nac">Fecha de nacimiento:</label>
        <input type="date" name="fecha_nac" id="fecha_nac"><br>

        <label for="departamento">Departamento:</label>
        <select name="departamento" id="departamento" required>
            <option value="">Seleccione un departamento</option>
            <?php
                include "funciones_bbdd.php";

                // Cargar la conexión y lista de departamentos
                $conn = ConexionBBDD();
                if ($conn) {
                    $departamentos = arrayAssocDpto($conn);
                    // Cargar los departamentos en la lista desplegable
                    foreach ($departamentos as $dpto) {
                        echo "<option value='" . htmlspecialchars($dpto['cod_dpto']) . "'>" . htmlspecialchars($dpto['nombre']) . "</option>";
                    }
                } else {
                    echo "<option disabled>Error al cargar departamentos</option>";
                }
            ?>
        </select><br>

        <input type="submit" value="Enviar">
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $dni = $_POST['dni'];
                $nombre = $_POST['nombre'];
                $apellidos = $_POST['apellidos'];
                $salario = $_POST['salario'];
                $fecha_nac = $_POST['fecha_nac'];
                $departamento = $_POST['departamento'];

                $conn->beginTransaction();
                try{
                    insert_emple_BBDD($conn, $dni, $nombre, $apellidos, $salario, $fecha_nac);
                    insert_emple_dpto_BBDD($conn, $dni, $departamento);
                    // Si todo es correcto, realizar commit para confirmar los cambios
                    $conn->commit();
                    echo "Empleado y asignación al departamento realizados con éxito.";
                }catch(PDOException $e){
                    // Si ocurre algún error, realizar rollback para deshacer ambos cambios
                    $conn->rollBack();
                    echo "Error: " . $e->getMessage();
                }
                // Cierra la conexion con la BBDD
                $conn = null;
            }
        ?>
    </form>
</body>
</html>