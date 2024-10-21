<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficheros</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            Nombre: 
            <input type="text" name="nombre" placeholder="Nombre" required><br>
            Apellido 1: 
            <input type="text" name="apellido1" placeholder="Apellido 1" required><br>
            Apellido 2:
            <input type="text" name="apellido2" placeholder="Apellido 2" required><br>
            Fecha de Nacimiento:
            <input type="date" name="fecha" required><br>
            Localidad:
            <input type="text" name="localidad" placeholder="Localidad" required><br>
            
            <br>

            <input type="submit" value="Enviar">
            <input type="reset" value="Borrar">
        </form>

</body>
</html>

<?php
// Función para escribir un campo carácter por carácter en el archivo
function escribir_campo($archivo, $campo, $longitud)
{
    // Escribir cada carácter del campo hasta el máximo permitido
    for ($i = 0; $i < $longitud; $i++)
    {
        if ($i < strlen($campo))
            fwrite($archivo, $campo[$i]);
        else
            fwrite($archivo, " ");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $archivo = fopen("alumnos1.txt", "a");

    if ($archivo)
    {
        escribir_campo($archivo, $_POST['nombre'], 40);
        escribir_campo($archivo, $_POST['apellido1'], 40);
        escribir_campo($archivo, $_POST['apellido2'], 42);
        escribir_campo($archivo, $_POST['fecha'], 10);
        escribir_campo($archivo, $_POST['localidad'], 27);

        fwrite($archivo, "\n");
        fclose($archivo);
        echo "Datos guardados correctamente.";
    }
    else
    {
        echo "No se pudo abrir el archivo.";
    }
}

?>
