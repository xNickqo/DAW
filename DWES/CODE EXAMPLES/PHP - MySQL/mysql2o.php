<?php
/*Inserción en tabla - MySQLi Object-oriented*/

$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "empleadosnn";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO dpto (cod_dpto, nombre) VALUES ('D004', 'INFORMATICA')";
if ($conn->query($sql) === TRUE)
{
    echo "insert realizado correctamente";
}
else
{
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>

