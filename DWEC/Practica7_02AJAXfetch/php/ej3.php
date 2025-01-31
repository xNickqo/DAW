<?php 
if (isset($_POST['nota'])) {
    $nota = $_POST['nota'];

    if ($nota < 5) {
        echo "SUSPENSO";
    } else if ($nota >= 5 && $nota < 6) {
        echo "SUFICIENTE";
    } else if ($nota >= 6 && $nota < 7) {
        echo "BIEN";
    } else if ($nota >= 7) {
        echo "NOTABLE";
    }
} else {
    echo "No se recibió la nota.";
}
?>

