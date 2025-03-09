<?php
function conexionBBDD(){
    try{
        $conn = new PDO("mysql:host=localhost;dbname=comprasweb", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }catch(PDOException $e){
        echo "Error en la conexion: " . $e->getMessage();
        return null;
    }
}

/* Funcion para ingresar datos, recibe como parametros el nombre de la tabla,
 un array assoc que seran los campos con los valores a introducir y devolvera el 
 ultimo ID insertado
 
 Ejemplo de uso:
    $idProducto = 'P001';
    $nombreProducto = 'Pelota';
    $precio = 10.99;
    $idCategoria = 'C001';

    insertarDatos('producto', [
        'ID_PRODUCTO' => $idProducto,
        'NOMBRE' => $nombreProducto,
        'PRECIO' => $precio,
        'ID_CATEGORIA' => $idCategoria,
    ]);

    echo "Producto insertado exitosamente.";
 */
function insertarDatos($tabla, $camposValores) {
    try {
        $conn = conexionBBDD();

        $columnas = implode(', ', array_keys($camposValores));
        $placeholders = ':' . implode(', :', array_keys($camposValores));

        $sql = "INSERT INTO $tabla ($columnas) VALUES ($placeholders)";
        $stmt = $conn->prepare($sql);

        foreach ($camposValores as $campo => $valor) {
            $stmt->bindValue(':' . $campo, $valor);
        }

        $stmt->execute();
        echo "Datos insertados correctamente";
    } catch (PDOException $e) {
        echo "Error al insertar datos: " . $e->getMessage();
    }
}

/* Esta funcion imprimira las opciones de un select con la sentencia sql que le mandes
el value y el texto.
Ejemplo de uso:
        $sql = "SELECT ID_PRODUCTO, NOMBRE FROM producto";
        imprimirOpciones($sql, 'ID_PRODUCTO', 'NOMBRE');
        
        Se mostrara como:
            <option value="id_producto"> nombre </option>*/
function imprimirOpciones($sql, $valor, $texto) {
    $conn = conexionBBDD();

    $stmt = $conn->query($sql);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value='" . $row[$valor] . "'>" . $row[$texto] . "</option>";
    }
}

/* Funcion que ejecutara cualquier consulta select dando la opcion de como devuelve los datos
Ejemplo de uso:
  -CONSULTA BASICA
    $sql = "SELECT * FROM producto";
    $resultado = ejecutarConsulta($sql);
    
  -CONSULTA CON WHERE  
    $sql = "SELECT * FROM producto WHERE ID_PRODUCTO = :id";
    $parametros = [':id' => 10];
    $resultado = ejecutarConsulta($sql, $parametros);
    
  -CONSULTA CON JOIN
    $sql = "
        SELECT p.NOMBRE AS nombre_producto, c.NOMBRE AS nombre_categoria
        FROM producto p
        INNER JOIN categoria c ON p.ID_CATEGORIA = c.ID_CATEGORIA
        WHERE p.ID_PRODUCTO = :id_producto";
    $parametros = [':id_producto' => $id_producto];
    $resultados = ejecutarConsulta($sql, $parametros);  
    
SI NECESITAS DEVOLVER LOS DATOS DE OTRO TIPO SOLO DEBERAS ESPECIFICARLO EN FETCHMODE*/
function ejecutarConsulta($sql, $parametros = [], $fetchMode = PDO::FETCH_ASSOC, $singleValue=false) {
    $conn = conexionBBDD();

    try {
        $stmt = $conn->prepare($sql);
        foreach ($parametros as $clave => $valor) {
            $stmt->bindValue($clave, $valor);
        }
        $stmt->execute();
        if ($singleValue) {
            return $stmt->fetch($fetchMode)[0]; // Obtiene el primer valor de la fila
        }
        return $stmt->fetchAll($fetchMode);
    } catch (Exception $e) {
        die("Error en la consulta: " . $e->getMessage());
    }
}

?>