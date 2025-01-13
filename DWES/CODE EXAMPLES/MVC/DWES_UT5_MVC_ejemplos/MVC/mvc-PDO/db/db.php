<?php
echo "Inicio db.php"."<br>";

	$servername = "localhost";
	$username = "root";
	$password = "rootroot";
	$database = "sakila";

	try {
		$conexion = new PDO("mysql:host=$servername;dbname=$database", $username, $password); 	 	 	 	 	 	
		$conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 	 	 	 	 	 	
	} catch (PDOException $ex) {
		echo $ex->getMessage(); 	 	 	 	 	 	
	}
	
echo "finaliza db.php"."<br>";
?>