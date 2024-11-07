<?php
/*Inserción en tabla Prepared Statement- mysql PDO*/

$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "empleadosnn";

try
{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // prepare sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO dpto (cod_dpto,nombre) VALUES (:cod_dpto,:nombre)");
    $stmt->bindParam(':cod_dpto', $cod_dpto);
    $stmt->bindParam(':nombre', $nombre);
  
    // insert a row
    $cod_dpto = 'D006';
	$nombre = 'COMERCIO';
    $stmt->execute();

    // insert another row
    $cod_dpto = 'D002';
	$nombre = 'COMPRAS';
    $stmt->execute();

    echo "New records created successfully";
}
catch(PDOException $e)
{
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
