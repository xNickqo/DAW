<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bolsa4</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="valor">Valor</label>
        <select name="valor" id="valor">
            <option> </option>
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
        <br>
        <label for="mostrar">Mostrar</label>
        <select name="mostrar" id="mostrar">
            <option> </option>
            <option>Ultimo</option>
            <option>Var.%</option>
            <option>Var.</option>
            <option>Ac.% Año</option>
            <option>MAx.</option>
            <option>MIn.</option>
            <option>Vol.</option>
            <option>Capit.</option>
            <option>Hora</option>
        </select>
        <br>
        <input type="submit" value="Visualizar">
        <input type="reset" value="Borrar">
        <br><br>
    </form>
    <?php
        include "funciones_bolsa.php";

        set_error_handler("manejadorErrores");
    
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $archivo = fopen("ibex35.txt", "r");
            
            if($archivo)
            {
                $palabra = $_POST['valor'];
                $mostrar = $_POST['mostrar'];

                imprimirPrimeraLinea($archivo);
                
                // Recorre las líneas restantes buscando la palabra
                while (($linea = fgets($archivo)) !== false)
                {
                    $valores = inicializarValores($linea);
                    // Busca la subcadena en la línea usando strstr() y si encuentra la palabra, imprime esa linea
                    if (strstr($linea, $palabra))
                    {
                        mostrarLinea($linea);
                        mostrarValorSeleccionado($valores, $mostrar);
                        break;
                    }
                }
            }
            fclose($archivo);
        }
    ?>
</body>
</html>