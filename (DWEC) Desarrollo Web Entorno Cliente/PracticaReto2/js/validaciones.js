// Verifica si el carácter es un dígito
function isDigit(caracter) {
    return caracter >= '0' && caracter <= '9';
}

// Verifica si el carácter es una letra
function isLetter(caracter) {
    return caracter >= 'A' && caracter <= 'Z';
}

function esNif(nif) {

    let controlChars = "TRWAGMYFPDXBNJZSQVHLCKE";

    // 1ª Forma: 8 dígitos + letra de control
    if (nif.length === 9)
    {
        let i = 0;
        while (i < 8)
        {
            if (!isDigit(nif[i]))
                return 0;
            i++;
        }

        // Validar si el último carácter es una letra
        if (isLetter(nif[8]))
        {
            // Extraer los 8 primeros dígitos como número
            let numeros = parseInt(nif.substring(0, 8), 10);
            // Calcular la letra de control correcta
            let letraCalculada = controlChars[numeros % 23];

            // Comparar la letra calculada con la proporcionada
            if (letraCalculada === nif[8])
                return 1;
            else
                return 2;

        }

        // 2ª Forma: Letra inicial + 7 dígitos + letra de control
        let validInitialLetters = ['X', 'Y', 'Z', 'L', 'K'];

        if (validInitialLetters.includes(nif[0]))
        {
            let i = 1;
            while (i < 8)
            {
                if (!isDigit(nif[i]))
                    return 0;
                i++;
            }

            if (isLetter(nif[8]))
            {
                // Reemplazar la letra inicial si es X, Y o Z
                let numero = parseInt(nif.substring(1, 8), 10);

                if (nif[0] === 'X')
                    numero = parseInt("0" + nif.substring(1, 8), 10);
                if (nif[0] === 'Y')
                    numero = parseInt("1" + nif.substring(1, 8), 10);
                if (nif[0] === 'Z')
                    numero = parseInt("2" + nif.substring(1, 8), 10);

                let letraCalculada = controlChars[numero % 23];
                if (letraCalculada === nif[8])
                    return 1;
                else
                    return 2;
            }
        }
    }

    // Verificar si es un DNI (6 a 8 dígitos con mínimo 100000)
    if (nif.length >= 6 && nif.length <= 8)
    {
        let numero = parseInt(nif, 10);
        if (numero >= 100000)
            return 3;
    }

    return 0;
}

function esCif(cif) {

    let lettersIfNumber = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'U', 'V'];
    let lettersIfLetter = ['P', 'Q', 'R', 'S', 'W'];

    if (cif.length !== 9)
        return 0;

    if (!lettersIfNumber.includes(cif[0]) && !lettersIfLetter.includes(cif[0]))
        return 0

    let sumaImpares = 0;
    let sumaPares = 0;
    let i = 1;
    while (i < 8)
    {
        let digito = parseInt(cif[i], 10);
        if (i % 2 === 0)
        {
            let aux = digito * 2;
            if (aux > 9)
                aux = Math.floor(aux / 10) + (aux % 10);
            sumaImpares += aux;
        }
        else
            sumaPares += digito;
        i++;
    }

    let sumaTotal = sumaImpares + sumaPares;
    let resto = sumaTotal % 10;

    let digitoControl = 0;
    if (resto === 0)
        digitoControl = 0;
    else
        digitoControl = 10 - resto;

    let caracterControl = cif[8];

    // Si la letra inicial está en lettersIfNumber, el control debe ser un número
    if (lettersIfNumber.includes(cif[0]))
    {
        if (parseInt(caracterControl, 10) === digitoControl)
            return 1;
        else
            return 2;
    }
    // Si la letra inicial está en lettersIfLetter, el control debe ser una letra
    else if (lettersIfLetter.includes(cif[0]))
    {
        let conversion = ['J', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];

        if (conversion[digitoControl] === caracterControl)
            return 1;
        else
            return 2;
    }

    return 0;
}

function NIFCIF(dato) {

    dato = dato.trim().toUpperCase();

    // Comprobar si es un NIF
    let nif = esNif(dato);
    if (nif === 1) {
        return 'N1';
    } else if (nif === 2) {
        return 'N2';
    } else if (nif === 3) {
        return 'N3';
    }

    // Comprobar si es un CIF
    let cif = esCif(dato);
    if (cif === 1) {
        return 'C1';
    } else if (cif === 2) {
        return 'C2';
    }

    return 0;
}

function codigosControl(codigoBanco, numSucursal, numCuenta) {

    if (isNaN(codigoBanco) || isNaN(numSucursal) || isNaN(numCuenta))
        return "El código del banco, la sucursal y el número de cuenta deben ser numéricos.\n";

    if (codigoBanco.length !== 4 || numSucursal.length !== 4 || numCuenta.length !== 10)
        return "Error[codigoControl], en el tamaño de las variables \n";

    let numero1 = 0;
    numero1 += parseInt(codigoBanco[0]) * 4;
    numero1 += parseInt(codigoBanco[1]) * 8;
    numero1 += parseInt(codigoBanco[2]) * 5;
    numero1 += parseInt(codigoBanco[3]) * 10;

    let numero2 = 0;
    numero2 += parseInt(numSucursal[0]) * 9;
    numero2 += parseInt(numSucursal[1]) * 7;
    numero2 += parseInt(numSucursal[2]) * 3;
    numero2 += parseInt(numSucursal[3]) * 6;

    let total = numero1 + numero2;
    let resto = total % 11;
    let primero = 11 - resto;
    if(primero === 10)
        primero = 1;
    else
        primero = 0;

    let numero3 = 0;
    numero3 += parseInt(numCuenta[0]) * 1;
    numero3 += parseInt(numCuenta[1]) * 2;
    numero3 += parseInt(numCuenta[2]) * 4;
    numero3 += parseInt(numCuenta[3]) * 8;
    numero3 += parseInt(numCuenta[4]) * 5;
    numero3 += parseInt(numCuenta[5]) * 10;
    numero3 += parseInt(numCuenta[6]) * 9;
    numero3 += parseInt(numCuenta[7]) * 7;
    numero3 += parseInt(numCuenta[8]) * 3;
    numero3 += parseInt(numCuenta[9]) * 6;

    let resto3 = numero3 % 11;
    let segundo = 11 - resto3;
    if (segundo === 10) {
        segundo = 1;
    } else if (segundo === 11) {
        segundo = 0;
    }

    return String(primero) + String(segundo);
}

function calculoIBANEspanya(codigoCuenta) {

    if (codigoCuenta.length !== 20)
        return "Error en el tamaño de las variables \n";

    let calc = codigoCuenta + '142800';
    let resto = parseFloat(calc) % 97;
    let codigoControl = 98 - resto;
    codigoControl = String(codigoControl).padStart(2, '0');

    let iban = 'ES' + codigoControl + codigoCuenta;

    return iban;
}

function comprobarIBAN(codigoIBAN) {

    if (codigoIBAN.length > 34)
        return "Error: IBAN muy largo \n";

    let letras = codigoIBAN.substring(0, 4)
    let calc = codigoIBAN.substring(4) + letras;

    let i = 0;
    let numericIban = '';
    while (i < calc.length)
    {
        if (isDigit(calc[i]))
            numericIban += calc[i];
        else if (isLetter(calc[i]))
        {
            numericIban += (calc[i].charCodeAt(0) - 55).toString();
        }
        else
            return false;
        i++;
    }

    let remainder = BigInt(numericIban) % BigInt(97);
    if (remainder !== BigInt(1))
        return false;

    return true;
}

function razonNombre(cadena) {

    let resultado = "";

    if(cadena.length < 1)
        resultado = "El nombre/razon social no es correcta, < 1 caracter \n";
    else
    {
        if(!isLetter(cadena[0]))
            resultado = "El nombre/razon social no es correcta, No comienza por una letra \n";

        let i = 1;
        while (i < cadena.length - 1)
        {
            let char = cadena[i];

            if (!isLetter(char) && !isDigit(char))
            {
                if (char !== 'º' && char !== 'ª' && char !== '-' && char !== '.')
                {
                    resultado = "El nombre/razon social no es correcta, caracter/es invalidos \n";
                    break ;
                }
            }
            i++;
        }

        let lastChar = cadena[i];
        if (!isLetter(lastChar) && !isDigit(lastChar))
        {
            if (lastChar !== '.')
                resultado = "El nombre/razon social no es correcta, debe acabar en punto, letra o caracter \n";
        }
    }
    return resultado;
}

function CodigoEmpresa(codigo) {

    let resultado = "";

    if(codigo.length < 5 || codigo.length > 10)
        resultado = "El codigo de la empresa no es correcto, caracter no comprendido entre 5-10 \n";
    else
    {
        let i = 0;
        while(i < codigo.length)
        {
            if(!isLetter(codigo[i]) && !isDigit(codigo[i]))
            {
                resultado = "El codigo de la empresa no es correcto, no es ni una letra ni un numero \n";
                break;
            }
            i++;
        }
    }
    return resultado;
}

function validarDireccion(cadena) {

    let resultado = "";

    if(cadena.length < 1)
        resultado = "la direccion no es correcta, < 1 caracter \n";
    else
    {
        if(!isLetter(cadena[0]))
            resultado = "La direccion no es correcta, No comienza por una letra \n";

        let i = 1;
        while (i < cadena.length - 1)
        {
            let char = cadena[i];

            if (!isLetter(char) && !isDigit(char))
            {
                if (char !== 'º' && char !== 'ª' && char !== '-' && char !== '.' && char !== '/')
                {
                    resultado = "La direccion no es correcta, caracter/es invalidos \n";
                    break;
                }
            }
            i++;
        }

        let lastChar = cadena[i];
        if (!isLetter(lastChar) && !isDigit(lastChar))
            resultado = "La direccion no es correcta, debe acabar en letra o caracter \n";
    }
    return resultado;
}

function validarLocalidad(cadena) {

    let resultado = "";

    if (cadena.length < 1)
        resultado = "La localidad no es correcta, < 1 caracter \n";
    else
    {
        if (!isLetter(cadena[0]) || !isLetter(cadena[cadena.length - 1]))
            resultado = "La localidad no es correcta, No comienza y termina por una letra \n";
        else
        {
            for (let i = 1; i < cadena.length - 1; i++) {
                let char = cadena[i];

                if (!isLetter(char) && char !== ' ')
                {
                    resultado = "La localidad no es correcta, caracter/es invalidos \n";
                    break;
                }
            }
        }
    }
    return resultado;
}

function validarCodigoPostal(codigoPostal) {

    let resultado = "";

    if(codigoPostal < 1000 || codigoPostal > 52999)

        resultado = "El codigo postal no es correcto \n";
    else
        saberProvincia(codigoPostal);

    return resultado;
}

function saberProvincia(codigoPostal) {
    let provincia = "";
    let codigoPostalCadena = codigoPostal.toString();
    let provincias =   ["Álava", "Albacete","Alicante","Almeria","Ávila","Badajoz",
                        "Islas Baleares","Barcelona","Burgos","Cáceres","Cádiz",
                        "Castellón","Ciudad Real","Córdoba","A Coruña","Cuenca",
                        "Girona","Granada","Guadalajara","Gipuzkoa","Huelva",
                        "Huesca", "Jaén","León","Lleida","La Rioja","Lugo",
                        "Madrid","Málaga", "Murcia","Navarra","Ourense","Asturias",
                        "Palencia","Las Palmas", "Pontevedra","Salamanca",
                        "Santa Cruz de Tenerife", "Cantabria", "Segovia",
                        "Sevilla", "Soria","Tarragona", "Teruel", "Toledo",
                        "Valencia", "Valladolid","Bizkaia","Zamora", "Zaragoza",
                        "Ceuta","Melilla"];

    let i = 1;
    while(i <= 52)
    {
        if(i < 10)
        {
            if((codigoPostalCadena[0] + codigoPostalCadena[1]) == ("0" + i.toString()))
            {
                provincia = provincias[i - 1];
                break ;
            }
        }
        else
        {
            if((codigoPostalCadena[0] + codigoPostalCadena[1]) == (i.toString()))
            {
                provincia = provincias[i - 1];
                break ;
            }
        }
        i += 1;
    }
    document.formu.provincia.value = provincia;
}

function validarNumTel(numero) {

    resultado = "";

    if(numero < 0)
        resultado = "Error, numero negativo";
    if(numero.length != 9)
        resultado = "Error, la longitud de numero no puede ser distinta de 9 \n";
    if((numero[0] != 6) && (numero[0] != 7) && (numero[0] != 9))
        resultado = "Error, el numero debe comenzar por 6, 7 o 9 \n";
    return resultado;
}

function validarFax(numero) {

    resultado = "";

    if(numero < 0)
        resultado = "Error, fax negativo";
    if(numero.length != 9)
        resultado = "Error, la longitud del fax no puede ser distinta de 9 \n";
    if(numero[0] != 9)
        resultado = "Error, el fax debe comenzar por 9 \n";
    return resultado;
}

function validarFecha(cadena) {

    let partes = cadena.split("/");
    resultado = "";

    if (partes.length !== 3)
        resultado = "La fecha debe tener el formato día/mes/año.\n";

    let [dia, mes, anio] = partes;

    dia = parseInt(dia, 10);
    mes = parseInt(mes, 10);
    anio = parseInt(anio, 10);

    if (isNaN(dia) || isNaN(mes) || isNaN(anio))
        resultado = "La fecha debe contener solo números.\n";

    if (dia < 1 || dia > 31)
        resultado = "El día debe estar entre 1 y 31.\n";
    if (mes < 1 || mes > 12)
        resultado = "El mes debe estar entre 1 y 12.\n";
    if ((anio < 100 && anio > 99) || anio < 0)
        resultado = "El año debe tener dos o cuatro dígitos.\n";

    let fecha = new Date(anio, mes - 1, dia);
    if (fecha.getDate() !== dia || fecha.getMonth() !== mes - 1 || fecha.getFullYear() !== anio)
        resultado = "La fecha no es válida.\n";

    return resultado;
}

function validarComunidades(comunidadesSeleccionadas) {

    let contador = 0;
    let i = 0;

    while (i < comunidadesSeleccionadas.options.length)
    {
        if (comunidadesSeleccionadas.options[i].selected)
            contador++;
        i++;
    }

    if (contador < 2)
        return "Debes seleccionar al menos dos comunidades autónomas.\n";

    return "";
}

function validarSector(sectoresEconomicos) {

    let sectoresSeleccionados = false;
    let i = 0;

    while (i < sectoresEconomicos.length)
    {
        if (sectoresEconomicos[i].checked)
        {
            sectoresSeleccionados = true;
            break;
        }
        i++;
    }

    if (!sectoresSeleccionados)
        return "Debes seleccionar al menos un sector económico.\n";

    return "";
}

function validarTipoEmpresa(tipoEmpresa) {

    let i = 0;

    while (i < tipoEmpresa.length)
    {
        if (tipoEmpresa[i].checked)
            return "";
        i++;
    }
    return "Debes seleccionar un tipo de empresa.\n";
}
