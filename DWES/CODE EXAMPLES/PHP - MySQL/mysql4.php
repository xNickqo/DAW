<?php
/*SELECTs - MySQLi procedural*/

$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "empleadosnn";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT cod_dpto, nombre FROM departamento";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "Codigo dpto: " . $row["cod_dpto"]. " - Nombre: " . $row["nombre"]. "<br>";
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?>

