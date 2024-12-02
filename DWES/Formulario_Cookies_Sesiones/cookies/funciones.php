<?php
    // Función para establecer la conexión con la base de datos
function ConexionBBDD() {
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "sesiones";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return null;
    }
}

// Función para verificar si un usuario ya existe
function usuarioExiste($conn, $nombre) {
    $sql = "SELECT 1 FROM usuarios WHERE nombre = :nombre";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve false si no encuentra nada
}

// Función encargada de hacer inserts en la base de datos
function insert_BBDD($conn, $nombre, $pass, $fecha_registro) {
    try {
        $sql = "INSERT INTO usuarios (nombre, password, fecha_registro) 
                VALUES (:nombre, :pass, :fecha_registro)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':pass', $pass);
        $stmt->bindParam(':fecha_registro', $fecha_registro);

        return $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}
?>