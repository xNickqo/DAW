<!DOCTYPE html>
<?php
// BORRAR UNA COOKIE -> establecer una fecha expiración del pasado con función setcookie

// set the expiration date to one hour ago
setcookie("usuario", "", time() - 3600);
?>
<html>
<body>

<?php
echo "Cookie 'usuario' BORRADA.";
?>

</body>
</html> 