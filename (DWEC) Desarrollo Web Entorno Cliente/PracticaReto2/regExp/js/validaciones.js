function esNif(nif) {

    let forma1 = /^\d{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i;
    let controlChars = "TRWAGMYFPDXBNJZSQVHLCKE";

    if(forma1.test(nif))
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

    let forma2 = /^[XYZLK]\d{7}[TRWAGMYFPDXBNJZSQVHLCKE]$/i;
    if (forma2.test(nif))
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

function esCif(cif) {

    let forma1 = /^[A-HJUV]\d{8}$/i;
    let forma2 = /^[PQRSW]\d{7}[a-zñáéíóúü]$/i;

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
    //console.log(digitoControl);
    let caracterControl = cif[8];

    if (forma1.test(cif))
    {
        if (parseInt(caracterControl, 10) === digitoControl)
            return 1;
        else
            return 2;
    }
    else if (forma2.test(cif))
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

    let bancoRegex = /^\d{4}$/;
    let sucursalRegex = /^\d{4}$/;
    let cuentaRegex = /^\d{10}$/;

    if (!bancoRegex.test(codigoBanco) || !sucursalRegex.test(numSucursal) || !cuentaRegex.test(numCuenta)) {
        return "---[Código del banco][sucursal][número de cuenta] deben ser numéricos y tener el tamaño correcto.\n";
    }

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

    let cuentaRegex = /^\d{20}$/;

    if (!cuentaRegex.test(codigoCuenta)) {
        return "---[Código de cuenta] debe tener 20 dígitos numéricos.\n";
    }

    let calc = codigoCuenta + '142800';
    let resto = parseFloat(calc) % 97;
    let codigoControl = 98 - resto;
    codigoControl = String(codigoControl).padStart(2, '0');

    let iban = 'ES' + codigoControl + codigoCuenta;

    return iban;
}

function isDigit(char) {
    return /^\d$/.test(char);
}

function isLetter(char) {
    return /^[A-Za-z]$/.test(char);
}

function comprobarIBAN(codigoIBAN) {

    let ibanRegex = /^[A-Z]{2}\d{2}[A-Z0-9]{11,30}$/i;

    if (!ibanRegex.test(codigoIBAN)) {
        return "---[IBAN] inválido o demasiado largo.\n";
    }

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

    let nombre = /^[a-zñáéíóúü][a-zñáéíóúü0-9ªº\-.]{1,}[a-zñáéíóúü0-9.]$/i;
    let resultado = "";

    if(!nombre.test(cadena))
        return "---[Nombre] incorrecto\n";
    return resultado;
}

function CodigoEmpresa(codigo) {

    let empresa = /^[[a-zñáéíóúü0-9]{5,10}$/i;
    let resultado = "";

    if (!empresa.test(codigo))
        return "---[Codigo empresa] es incorrecto\n";
    return resultado;
}

function validarDireccion(cadena) {

    let resultado = "";
    let direccionRegex = /^[a-zA-Záéíóúüñ][a-z0-9ºª\-.\/]*[a-z0-9]$/i;

    if (!direccionRegex.test(cadena))
        return "---[Direccion] es incorrecta.\n";

    return resultado;
}

function validarLocalidad(cadena) {

    let resultado = "";
    let localidadRegex = /^[a-zA-Záéíóúüñ]([a-zA-Záéíóúüñ ]*[a-záéíóúüñ])?$/i;

    if (!localidadRegex.test(cadena))
        return "---[Localidad] es incorrecta.\n";

    return resultado;
}

function validarCodigoPostal(codigoPostal) {

    let resultado = "";
    let codigoPostalRegex = /^(0?[1-4]\d{3}|5[0-2]\d{2}|[1-9]\d{3})$/;

    if(!codigoPostalRegex.test(codigoPostal))
        resultado = "---[Codigo postal] es incorrecto \n";
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
    let telefonoRegex = /^(6|7|9)\d{8}$/;

    if(numero < 0)
        resultado = "---[TLF] numero negativo\n";
    if(numero.length != 9)
        resultado = "---[TLF] la longitud de numero no puede ser distinta de 9 \n";
    if(!telefonoRegex.test(numero))
        resultado = "---[TLF] el numero debe comenzar por 6, 7 o 9 \n";
    return resultado;
}

function validarFax(numero) {

    resultado = "";
    let faxRegex = /^9\d{8}$/;

    if(numero < 0)
        resultado = "---[FAX] negativo";
    if(numero.length != 9)
        resultado = "---[FAX] la longitud del fax no puede ser distinta de 9 \n";
    if(!faxRegex.test(numero))
        resultado = "---[FAX] el fax debe comenzar por 9 \n";
    return resultado;
}

function validarFecha(cadena) {
    //d/m/aa o dd/mm/aaaa
    let regex = /^(0?[1-9]|[12][0-9]|3[01])\/(0?[1-9]|1[0-2])\/(\d{2}|\d{4})$/;
    if (!regex.test(cadena)) 
        return "---[Fecha] La fecha debe tener el formato día/mes/año, donde día y mes pueden tener uno o dos dígitos y el año puede ser de 2 o 4 dígitos.\n";

    let partes = cadena.split("/");
    let [dia, mes, anio] = partes.map(part => parseInt(part, 10));

    if (dia < 1 || dia > 31)
        return "---[Fecha] El día debe estar entre 1 y 31.\n";
    if (mes < 1 || mes > 12)
        return "---[Fecha] El mes debe estar entre 1 y 12.\n";
    if (anio < 0 || (anio < 100 && anio > 99))
        return "---[Fecha] El año debe tener dos o cuatro dígitos.\n";

    let fecha = new Date(anio, mes - 1, dia);
    if (fecha.getDate() !== dia || fecha.getMonth() !== mes - 1 || fecha.getFullYear() !== anio)
        return "---[Fecha] La fecha no es válida.\n";

    return "";
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
        return "---[Comunidades] Debes seleccionar al menos dos comunidades autónomas.\n";

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
        return "---[Sector] Debes seleccionar al menos un sector económico.\n";

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
    return "---[Tipo de empresa] Debes seleccionar un tipo de empresa.\n";
}
