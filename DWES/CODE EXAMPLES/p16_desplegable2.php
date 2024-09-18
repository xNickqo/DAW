<!DOCTYPE HTML>  
<html>
<head>
</head>
<body>  
<?php
$lineasfichero = file('lenguajes.txt');
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
      <label for="valores">Valores</label>
      <select name="valores" id="val">
      <?php
            foreach ($lineasfichero as $numlinea => $linea) {
            echo "<option value=".trim($linea).">".trim($linea)."</option>"."<br>";
        }
        ?>
      </select>
      <input type="submit" value="Enviar" />
</form>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "Se ha seleccionado el lenguaje ".$_POST["valores"];
    }
?>

</body>
</html>