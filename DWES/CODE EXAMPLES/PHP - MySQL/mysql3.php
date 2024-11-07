<?php
/*Inserción en tabla Prepared Statement - MySQLi procedural*/

$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "empleados1n";

$conn  = mysqli_connect($servername,$username , $password, $dbname);

/* check connection */
if (!$conn ) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$stmt = mysqli_prepare($conn, "INSERT INTO departamento (cod_dpto,nombre) VALUES (?, ?)");
mysqli_stmt_bind_param($stmt, 'ss', $cod_dpto, $nombre);

/*bound parameters*/
$cod_dpto = 'D002';
$nombre = 'RRHH';
/* execute prepared statement */
mysqli_stmt_execute($stmt);
printf("%d Row inserted.\n", mysqli_stmt_affected_rows($stmt));

/*bound parameters*/
$cod_dpto = 'D003';
$nombre = 'COMPRAS';
/* execute prepared statement */
mysqli_stmt_execute($stmt);

printf("%d Row inserted.\n", mysqli_stmt_affected_rows($stmt));

/* close statement and connection */
mysqli_stmt_close($stmt);


/* close connection */
mysqli_close($conn );
?>
