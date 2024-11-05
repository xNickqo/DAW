<?php
//Funcion para establecer la conexion con la BBDD
function ConexionBBDD(){
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname="empleadosnn";

    try
    {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully"; 
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
}


//Funcion en cargada de hacer inserts en la BBDD
function insertBBDD(){
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "empleadosnn";

    try
    {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        
        /*
        Con setAtributte establece un atributo en el manejador de la base de datos.
            PDO::ATTR_ERRMODE --> Reporte de errores
                PDO::ERRMODE_EXCEPTION --> Lanza excepciones
        */
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO dpto (cod_dpto, nombre) VALUES ('D005', 'ECONOMIA')";
        
        
        $conn->exec($sql);
        echo "New record created successfully";
    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
}
?>