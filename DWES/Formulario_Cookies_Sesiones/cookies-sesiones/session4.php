<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
// elimina variables de sesión
session_unset();

// elimina la sesión
session_destroy();

echo "Variables eliminadas y sesi&oacuten destruida"
?>

</body>
</html>