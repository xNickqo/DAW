<?php

function insertarUsuario($conn, $nombre, $email, $password){
    try {
        $sql = "INSERT INTO usuarios(nombre, email, password) VALUES (:nombre, :email, :password)";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(":nombre", $nombre, PDO::PARAM_STR);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->bindValue(":password", $password, PDO::PARAM_STR);

        $stmt->execute();
    } catch (PDOException $e) {
        trigger_error("Error en la insercion del usuario", E_USER_ERROR);
    }
}

?>