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
?>