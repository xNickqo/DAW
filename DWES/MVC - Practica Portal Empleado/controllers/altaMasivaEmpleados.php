<?php
include_once "../controllers/gestionSesiones.php";

include_once "../db/conexionBBDD.php";
$conn = conexionBBDD();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

include_once "../models/obtenerAllDepts.php";
$departments = obtenerAllDepts($conn);

if (isset($_POST['añadir'])) {
    $empleado = [
        'name' => $_POST['name'],
        'apellido' => $_POST['apellido'],
        'genero' => $_POST['genero'],
        'fechaNac' => $_POST['fechaNac'],
        'dpt' => $_POST['dpt'],
        'salario' => $_POST['salario'],
        'cargo' => $_POST['cargo']
    ];

    $_SESSION['carrito'][] = $empleado;
}

if (isset($_POST['alta']) && !empty($_SESSION['carrito'])) {

    foreach ($_SESSION['carrito'] as $empleado) {
        if (empty($empleado['name']) || empty($empleado['apellido']) || empty($empleado['genero']) ||
            empty($empleado['fechaNac']) || empty($empleado['dpt']) || empty($empleado['salario']) || empty($empleado['cargo'])) {
            $mensaje = "Todos los campos son requeridos para dar de alta al empleado.";
            break;
        }
    }

    try {
        $conn->beginTransaction();

        include_once "../models/obtenerMaxEmp_no.php";
        // Obtener el emp_no (número de empleado)
        $n = obtenerMaxEmp_no($conn);

        var_dump($_SESSION['carrito']);

        foreach ($_SESSION['carrito'] as $empleado) {
            // Asignar valores del empleado a variables
            $nombre = $empleado['name'];
            $apellido = $empleado['apellido'];
            $genero = $empleado['genero'];
            $fechaNac = $empleado['fechaNac'];
            $dpt = $empleado['dpt'];
            $salario = $empleado['salario'];
            $cargo = $empleado['cargo'];

            include_once "../models/insertarEmple.php";
            include_once "../models/insertarDept.php";
            include_once "../models/insertarSalario.php";
            include_once "../models/insertarTitle.php";

            echo "Usuario" . $nombre . "dado de alta correctamente ID:". $n;
            $n++;
        }

        $_SESSION['carrito'] = array();
        $mensaje = "Todos los empleados han sido dados de alta correctamente.";
        $conn->commit();
    } catch (PDOException $e) {
        $conn->rollBack();
        $mensaje = "Error al insertar los empleados: " . $e->getMessage();
    }
}

$conn = null;
?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de empleados</title>
</head>
<body>
    <h1>Alta de empleados</h1>

    <form action="" method="post">
        <label for="name">Nombre: </label>
        <input type="text" name="name" ><br>

        <label for="apellido">Apellido: </label>
        <input type="text" name="apellido" ><br>

        <label>Género:</label>
        <input type="radio" name="genero" value="M" > M
        <input type="radio" name="genero" value="F" > F <br>

        <label for="fechaNac">Fecha de nacimiento: </label>
        <input type="date" name="fechaNac" ><br>

        <label for="dpt">Departamento: </label>
        <select name="dpt" >
            <?php foreach ($departments as $dpt): ?>
                <option value="<?= $dpt['dept_no'] ?>"><?= $dpt['dept_name'] ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="salario">Salario: </label>
        <input type="number" name="salario" ><br>

        <label for="cargo">Cargo: </label>
        <input type="text" name="cargo" ><br><br>

        <?php if (!empty($_SESSION['carrito'])): ?>
        <ul>
            <?php foreach ($_SESSION['carrito'] as $empleado): ?>
                <li><?= $empleado['name'] . " " . $empleado['apellido'] . " - " . $empleado['cargo'] ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

        <input type="submit" name="añadir" value="Añadir empleado a la lista"><br><br>
        <input type="submit" name="alta" value="Dar de alta">
    </form>

    <?php if (isset($mensaje)) echo "<p>$mensaje</p>"; ?>

    <a href="../controllers/logout.php">Cerrar sesión</a><br>
    <a href="../controllers/inicio.php">Volver al inicio</a>
</body>
</html>
