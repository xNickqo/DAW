<?php
/*SELECTs - MySQLi Object-oriented*/

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

$sql = "SELECT cod_dpto, nombre FROM departamento";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Codigo dpto: " . $row["cod_dpto"]. " - Nombre: " . $row["nombre"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>