<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
      
    <form id="" name="" action="" method="post">
        Username (emp_no): 
        <input type="text" name="username" placeholder="username">
        <br>
        Clave (last_name):
        <input type="password" name="password" placeholder="password" >				
        <br>
        <input type="submit" name="submit" value="Login">
    </form>

    <?php
        if(isset($mensaje))
            echo $mensaje;
    ?>
</body>
</html>