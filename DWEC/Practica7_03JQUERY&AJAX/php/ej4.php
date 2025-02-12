<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sueldo = rand(1000, 3250);
    echo $sueldo . "€";
}
?>
