<?php
// Función que establece la conexión con la base de datos.
function conexionBBDD(){
    try {
        $conn = new PDO("mysql:host=localhost;dbname=tienda", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        echo "Error en la conexion con la BBDD: " . $e->getMessage();
        return null;
    }
}
?>