<?php
echo "Inicio modelo"."<br>";

// Modelo contiene la lógica de la aplicación: clases y métodos que se comunican
// con la Base de Datos

//Creación de una clase para ejecutar la sentencia SQL
class peliculas_model{
    private $db;
    private $peliculas;
 
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->peliculas=array();
    }
    public function get_peliculas(){
        $consulta=$this->db->query("select * from film;");
        while($filas=$consulta->fetch_assoc()){
            $this->peliculas[]=$filas;
        }
        return $this->peliculas;
    }
}
echo "Fin modelo"."<br>";
?>