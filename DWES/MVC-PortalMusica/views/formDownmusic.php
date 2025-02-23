<?php include_once "../controllers/gestionSesiones.php";?>
<html>
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Descarga de música</title>
 </head>

<body>

    <form action="" method="post">
        <h2>Compra de caciones</h2>  
        Elije una canción 
        <select name="canciones" id="canciones">
            <option value="">Selecciona una canción</option>
            <?php
                foreach ($canciones as $track) {
                    //$trackValue = htmlspecialchars(serialize($_POST['canciones']));
                    $trackValue = $track["TrackId"] . "|" . $track["Name"] . "|" . $track["Composer"] . "|" . $track["Milliseconds"] . "|" . $track["Bytes"] . "|" . $track["UnitPrice"];
                    echo "<option value='".$trackValue."'>".$track["Name"]." | ".$track["Composer"]." | ".$track['Milliseconds']."ms | ".$track['Bytes']."Bytes | ".$track['UnitPrice']."€</option>";
                }
            ?>
        </select>

        <!-- Mostrar el carrito -->
        <?php 
            if (!empty($_SESSION['carrito'])) {
                echo '<ul>';
                foreach ($_SESSION['carrito'] as $track) {
                    echo '<li><b>' . $track['Name'] . '</b> | '. $track['UnitPrice'] . '€ x '. $track['quantity'] .'</li>';
                }
                echo '</ul>';
            }
        ?>

        <br>
        <input type="submit" name="añadir" value="Añadir al carrito">
        <br>

        <?php if (!empty($_SESSION['carrito'])) { ?>
            <input type="submit" name="vaciar" value="Vaciar Carrito">
        <?php } ?>




        <br><br><br>

        <?php
            if(isset($totalPrice))
                echo "<b>Precio total: ".number_format($totalPrice, 2)."€</b>";
        ?>

        <br>
        <input type="submit" name="comprar" value="Comprar">
    </form>
    
    <a href="../controllers/inicio.php">Volver a la Página Principal</a><br>
    <a href="../controllers/logout.php">Cerrar Sesión</a>

</body>
</html>