<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bolsa1</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <h2>Leer datos del fichero ibex35.txt</h2>
        <input type="submit">
    </form>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            //file()                devuelve un array de lineas
            //file_get_content()    devuelve una cadena
            $content = file_get_contents("./bolsa/ibex35.txt");
            $content = htmlspecialchars($content);
            echo "<pre>$content<pre>";
        }

    ?>
</body>
</html>