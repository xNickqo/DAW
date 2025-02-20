<?php

try{
    $conn->beginTransaction();

    include_once "../models/obtenerMaxEmp_no.php";
    $n = obtenerMaxEmp_no($conn);

    include_once "../models/insertarEmple.php";
    include_once "../models/insertarDept.php";
    include_once "../models/insertarSalario.php";
    include_once "../models/insertarTitle.php";

    $mensaje = "Empleado insertado con exito!";
    $conn->commit();
}catch(PDOException $e){
    $conn->rollBack();
    $mensaje = "Error al insertar todos los datos: ".$e->getMessage();
}

?>
