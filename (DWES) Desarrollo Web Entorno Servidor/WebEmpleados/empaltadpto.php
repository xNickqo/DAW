<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1</title>
</head>
<body>
    <form action="<?php  echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <label for="dpto">Codigo de departamento</label>
        <input type="text" name="dpto" id="dpto" placeholder="Ingrese dpto aqui">
        
        <input type="submit" value="Enviar">
    </form>
</body>
</html>