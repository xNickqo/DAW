<?php
// Verificar si el empleado que ha iniciado sesión es de Recursos Humanos (d003)
function verificarEmpleRRHH($conn, $emp_no){
    try{
        $sql_check_dept = "SELECT emp_no FROM dept_emp WHERE emp_no = :emp_no AND dept_no = 'd003'";
        $stmt_check_dept = $conn->prepare($sql_check_dept);
        $stmt_check_dept->bindParam(':emp_no', $emp_no);
        $stmt_check_dept->execute();
        return $stmt_check_dept->rowCount();
    }catch(PDOException $e){
        echo "Error en la verificacion de usuario RRHH: ".$e->getMessage();
    }
}
?>