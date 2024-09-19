<?php
/*Inserción en tabla Prepared Statement - MySQLi Object-oriented*/

$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "empleados1n";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// prepare and bind
$stmt = $conn->prepare("INSERT INTO departamento (cod_dpto,nombre) VALUES (?, ?)");
$stmt->bind_param('ss', $cod_dpto, $nombre);

// set parameters and execute
$cod_dpto = 'D002';
$nombre = 'RRHH';
$stmt->execute();

$cod_dpto = 'D003';
$nombre = 'COMPRAS';
$stmt->execute();

echo "New records created successfully";

$stmt->close();
$conn->close();
?>