<?php

//Funcion para establecer la conexion con la BBDD
function ConexionBBDD() {
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname="empleadosnn";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return null;
    }
}

// Función para obtener los datos de la tabla 'dpto' en un array asociativo
function arrayAssocDpto($conn) {
    try {
        $sql = "SELECT cod_dpto, nombre FROM dpto";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error al obtener los departamentos: " . $e->getMessage();
        return [];
    }
}

//Funcion encargada de hacer inserts en la BBDD
function insert_dpto_BBDD($conn) {

    $nombre_dpto = $_POST['dpto'];

    if (empty($_POST['dpto']))
    {
        echo "Introduce un nombre de departamento";
        return ;
    }

    try {
        $sql = "SELECT max(cod_dpto) as max_cod FROM dpto";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_NUM);
        
        if ($result[0] != NULL) {
            // Obtener el último código y eliminar la "D"
            $lastNumber = (int)substr($result[0], 1); 
            $newNumber = $lastNumber + 1;
        }

        // Formatear el nuevo código como "Dxxx"
        $cod_dpto = 'D' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        // Insertar el nuevo departamento
        $sql = "INSERT INTO dpto (cod_dpto, nombre) VALUES (:cod_dpto, :nombre)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cod_dpto', $cod_dpto);
        $stmt->bindParam(':nombre', $nombre_dpto);

        $stmt->execute();

        echo "El departamento $nombre_dpto [$cod_dpto] se ha insertado con exito";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Función para insertar el empleado en la base de datos
function insert_emple_BBDD($conn, $dni, $nombre, $apellidos, $salario, $fecha_nac) {
    if (empty($dni) || empty($nombre) || empty($apellidos) || empty($salario) || empty($fecha_nac)) {
        echo "Debes rellenar todos los campos";
        return;
    } else {
        $sql = "INSERT INTO emple (dni, nombre, apellidos, salario, fecha_nac) VALUES (:dni, :nombre, :apellidos, :salario, :fecha_nac)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':dni', $dni);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':salario', $salario);
        $stmt->bindParam(':fecha_nac', $fecha_nac);
        $stmt->execute();

        //echo "Empleado [$nombre] registrado con exito";
    }
}

// Insertar el departamento asignado al empleado
function insert_emple_dpto_BBDD($conn, $dni, $departamento) {
    if(!empty($departamento)) {
        $fecha_ini = date("Y-m-d");

        $sql = "INSERT INTO emple_dpto (dni, cod_dpto, fecha_ini) VALUES (:dni, :cod_dpto, :fecha_ini)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':dni', $dni);
        $stmt->bindParam(':cod_dpto', $departamento);
        $stmt->bindParam(':fecha_ini', $fecha_ini);
        
        $stmt->execute();

        //echo "Empleado con dni($dni) asignado al departamento[$departamento] con éxito.";
    } else {
        echo "Selecciona un departamento.";
    }
}

?>