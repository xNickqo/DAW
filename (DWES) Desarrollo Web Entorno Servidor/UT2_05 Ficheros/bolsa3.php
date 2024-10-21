<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bolsa3</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="valor">Valor</label>
        <select name="valor" id="valor">
            <option value="ACCIONA">ACCIONA</option>
            <option value="ACERINOX">ACERINOX</option>
            <option value="ACS">ACS</option>
            <option value="AENA">AENA</option>
            <option value="AMADEUS">AMADEUS IT GROUP</option>
            <option value="ARCELORMITTAL">ARCELORMITTAL</option>
            <option value="SABADELL">BANCO SABADELL</option>
            <option value="BANKIA">BANKIA</option>
            <option value="BANKINTER">BANKINTER</option>
            <option value="BBVA">BBVA</option>
            <option value="CAIXABANK">CAIXABANK</option>
            <option value="CELLNEX">CELLNEX TELECOM</option>
            <option value="AUTOMOTIVE">CIE. AUTOMOTIVE</option>
            <option value="COLONIAL">COLONIAL</option>
            <option value="DIA">DIA</option>
            <option value="ENAGAS">ENAGAS</option>
            <option value="ENDESA">ENDESA</option>
            <option value="FERROVIAL">FERROVIAL</option>
            <option value="GRIFOLS">GRIFOLS</option>
            <option value="IAG">IAG</option>
            <option value="IBERDROLA">IBERDROLA</option>
            <option value="INDITEX">INDITEX</option>
            <option value="INDRA">INDRA</option>
            <option value="MAPFRE">MAPFRE</option>
            <option value="MEDIASET">MEDIASET</option>
            <option value="MELIA">MELIA HOTELS</option>
            <option value="MERLIN">MERLIN PROP.</option>
            <option value="NATURGY">NATURGY</option>
            <option value="REDELECTRICA">RED ELECTRICA</option>
            <option value="REPSOL">REPSOL</option>
            <option value="SANTANDER">SANTANDER</option>
            <option value="SIEMENS">SIEMENS GAMESA</option>
            <option value="TECNICASREUNIDAS">TECNICAS REUNIDAS</option>
            <option value="TELEFONICA">TELEFONICA</option>
            <option value="VISCOFAN">VISCOFAN</option>
        </select>
        <input type="submit" value="Recibir datos">
        <br><br>
    </form>
    <?php
        include "funciones_bolsa.php";
    
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $archivo = fopen("./bolsa/ibex35.txt", "r");
            
            $palabra = $_POST['valor'];

            //Imprimir primera linea
            imprimirPrimeraLinea($archivo);
            
            // Recorre las líneas restantes buscando la palabra
            while (($linea = fgets($archivo)) !== false)
            {
                // Extraer el último valor, el máximo y el mínimo
                $ultimo_valor = substr($linea, 23, 5); 
                $max_valor = substr($linea, 60, 5); 
                $min_valor = substr($linea, 69, 5);

                // Busca la subcadena en la línea usando strstr() y si encuentra la palabra, imprime esa linea
                if (strstr($linea, $palabra))
                {
                    mostrarLinea($linea);
                    echo "El valor <b>Cotizacion</b> de {$palabra} es: " . htmlspecialchars(trim($ultimo_valor)) . "<br>";
                    echo "<b>Cotizacion maxima: </b> " . htmlspecialchars(trim($max_valor)) . "<br>";
                    echo "<b>Cotizacion minima: </b> " . htmlspecialchars(trim($min_valor)) . "<br>";
                    break;
                }
            }

            fclose($archivo);
        }
    ?>
</body>
</html>