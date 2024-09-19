<html>
<body>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Nombre: <input type="text" name="fnombre">
  Apellidos: <input type="text" name="fapellidos">
  <input type="submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // se recoge el valor de los campos del formulario
    $nombre = $_REQUEST['fnombre'];
    if (empty($nombre)) {
        echo "Campo nombre est&aacute vac&iacuteo";
    } else {
        echo "Campo nombre: ".$nombre."<BR>";
    }
	
	$apellidos = $_REQUEST['fapellidos'];
    if (empty($apellidos)) {
        echo "Campo apellidos est&aacute vac&iacuteo";
    } else {
        echo "Campo apellidos: ".$apellidos."<BR>";
    }
}


// Consultar más opciones
//https://www.w3schools.com/php/php_superglobals.asp

?>

</body>
</html> 



 