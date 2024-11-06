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
    if (empty($_POST['dpto'])) {
        echo "Introduce un nombre de departamento";
        return;
    }
    $nombre_dpto = $_POST['dpto'];
    try {
        // Obtenemos los dptos y los metemos en un array asociativo
        $result = arrayAssocDpto($conn);

        // Encontrar el valor más alto
        $mayor = 0;
        foreach ($result as $row) {
            // Convertir el código a número, eliminando la letra "D"
            $num = (int)substr($row['cod_dpto'], 1);
            if ($num > $mayor) {
                $mayor = $num;
            }
        }

        // Incrementar el número más alto y formatear el nuevo código como "Dxxx"
        $newNumber = $mayor + 1;
        $cod_dpto = 'D' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        /*str_pad($num, 3, '0', STR_PAD_LEFT)
            -$newNumber: Es el número que queremos formatear, por ejemplo, 5.
            -3: Define la longitud total deseada de la cadena (en este caso, queremos que el número sea de tres dígitos).
            -'0': Especifica el carácter que se debe añadir para completar la longitud deseada (ceros, en este caso).
            -STR_PAD_LEFT: Indica que los ceros deben añadirse al lado izquierdo. */

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