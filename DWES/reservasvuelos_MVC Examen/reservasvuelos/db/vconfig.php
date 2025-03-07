<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE', 'reservas');
  
  // Función que establece la conexión con la base de datos.
   function conexionBBDD(){
      try {
         $conn = new PDO("mysql:host=localhost;dbname=reservas", "root", "");
         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         return $conn;
      } catch(PDOException $e) {
         echo "Error en la conexion con la BBDD: " . $e->getMessage();
         return null;
      }
   }
?>