<?php
function conexionBBDD(){
    try{
        $conn = new PDO("mysql:host=localhost;dbname=comprasweb", "root", "rootroot");
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

?>