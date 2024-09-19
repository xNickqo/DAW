<!DOCTYPE HTML>  
<html>
<head>
</head>
<body>  
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
<label for="lang">Lenguajes</label>
      <select name="lenguajes" id="lang">
        <option value="javascript">JavaScript</option>
        <option value="php">PHP</option>
        <option value="java">Java</option>
        <option value="python">Python</option>
        <option value="c#">C#</option>
        <option value="C++">C++</option>
</select>
      <input type="submit" value="Enviar" />
</form>