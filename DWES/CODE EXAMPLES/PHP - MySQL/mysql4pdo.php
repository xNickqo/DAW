<?php
/*SELECTs - mysql PDO*/

$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "empleadosnn";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $conn->prepare("SELECT cod_dpto, nombre FROM dpto");
    $stmt->execute();

    //Devuelve los valores en un array asociativo
     $stmt->setFetchMode(PDO::FETCH_ASSOC);
	 $resultado=$stmt->fetchAll();
     //Recorremos el array asociativo e imprimimos los valores
	 foreach($resultado as $row) {
        echo "Codigo dpto: " . $row["cod_dpto"]. " - Nombre: " . $row["nombre"]. "<br>";
     }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

?>
