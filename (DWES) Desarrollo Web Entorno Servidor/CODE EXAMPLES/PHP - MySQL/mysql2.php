<?php
/*Inserción en tabla - MySQLi procedural*/

$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "empleadosnn";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO dpto (cod_dpto, nombre) VALUES ('D003', 'CONTABILIDAD')";

if (mysqli_query($conn, $sql)) {
    echo "Insert realizado correctamente";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>

