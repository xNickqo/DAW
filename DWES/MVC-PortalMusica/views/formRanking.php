<?php include_once "../controllers/gestionSesiones.php";?>
<html>
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ranking de descargas</title>
 </head>

<body>
    <h1>Ranking de descargas</h1>
    <form action="" method="post">
        Ranking entre
        <input type="date" name="inicio">
        Y
        <input type="date" name="fin">
        <br>
        <input type="submit" name="mostrar" value="Mostrar Ranking de descargas">
        <br>
    </form>
    
    <?php if(!empty($res)){ ?>
    <table border=1>
        <thead>
            <th>Name</th>
            <th>Downloads</th>
        </thead>
        <tbody>
            <?php
                    foreach($res as $track){
                        echo "<tr>";
                            echo "<td>" . htmlspecialchars($track['Name']) . "</td>";
                            echo "<td>" . htmlspecialchars($track['Downloads']) . "</td>";
                        echo "</tr>";
                    }
                }
            ?>
        </tbody>
    </table>
    <br>
    <a href="../controllers/inicio.php">Volver a la Página Principal</a><br>
    <a href="../controllers/logout.php">Cerrar Sesión</a>

</body>
</html>