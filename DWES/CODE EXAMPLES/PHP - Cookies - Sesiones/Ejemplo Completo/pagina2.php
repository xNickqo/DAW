<?php
session_start();
?>
<html>
<head>
<title>Pagina 2</title>
</head>
<body>
<?php
if(isset($_POST['nombre'])){
$_SESSION['nombre'] = $_POST['nombre'];
echo "Bienvenido! Has iniciado sesion: ".$_POST['nombre'];
}else{
if(isset($_SESSION['nombre'])){
echo "Has iniciado Sesion: ".$_SESSION['nombre'];
}else{
echo "Acceso Restringido debes hacer Login con tu usuario";
}
}
?>
<br /><a href="pagina1.php">Volver a pagina Login</a>
</body>
</html>