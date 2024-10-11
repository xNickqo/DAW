// Verifica si el carácter es un dígito
function isDigit(caracter) {
    return caracter >= '0' && caracter <= '9';
}

// Verifica si el carácter es una letra
function isLetter(caracter) {
    return caracter >= 'A' && caracter <= 'Z';
}

function esNif(nif)
{
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

function esCif(cif){
    let lettersIfNumber = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'U', 'V'];
    let lettersIfLetter = ['P', 'Q', 'R', 'S', 'W'];

    if (cif.length !== 9)
        return 0;

    if (!lettersIfNumber.includes(cif[0]) && !lettersIfLetter.includes(cif[0]))
        return 0

    let numeros = parseInt(cif.substring(1, 8), 10);

    let sumaImpares = 0;
    let sumaPares = 0;
    let i = 0;
    while (i < 7)
    {
        let digito = parseInt(cif[i + 1], 10);
        if (i % 2 === 0)
        {
            let aux = digito * 2;
            if (aux > 9)
                aux = Math.floor(aux / 10) + (aux % 10);
            sumaImpares += aux;
        }
        else
        {
            sumaPares += digito;
        }
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

function NIFCIF(dato)
{
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

function validarFormulario(){
    let error = '';

    //Nif
    let nif = document.formu.nif.value.trim().toUpperCase();
    let res_esNif = esNif(nif);
    if (res_esNif === 1) {
        error += "Se ha introducido un NIF correcto<br>";
    } else if (res_esNif === 2) {
        error += "Se ha introducido un NIF erróneo. El carácter de control es erróneo<br>";
    } else if (res_esNif === 3) {
        error += "Se ha introducido un DNI, se ha pasado un número de entre 6 y 8 dígitos con un valor mínimo de 100000<br>";
    } else if (res_esNif === 0) {
        error += "Se ha introducido un dato no válido. No es NIF ni DNI<br>";
    }

    //Cif
    let cif = document.formu.cif.value.trim().toUpperCase(); 
    let res_esCif = esCif(cif);
    if (res_esCif === 1) {
        error += "Se ha introducido un CIF correcto<br>";
    } else if (res_esCif === 2) {
        error += "Se ha introducido un CIF erróneo. El carácter de control es erróneo<br>";
    } else if (res_esCif === 0) {
        error += "Se ha introducido un dato no válido. No es CIF<br>";
    }

    let nifcif = document.formu.nifcif.value.trim().toUpperCase();
    let res_esNifCif = NIFCIF(nifcif);
    if (res_esNifCif === 'C1') {
        error += "Se ha introducido un CIF correcto<br>";
    } else if (res_esNifCif === 'C2') {
        error += "Se ha introducido un CIF erróneo. El carácter de control es erróneo<br>";
    } else if (res_esNifCif === 'N1') {
        error += "Se ha introducido un NIF correcto<br>";
    } else if (res_esNifCif === 'N2') {
        error += "Se ha introducido un NIF erróneo. El carácter de control es erróneo<br>";
    } else if (res_esNifCif === 'N3') {
        error += "Se ha introducido un DNI, se ha pasado un número de entre 6 y 8 dígitos con un valor mínimo de 100000<br>";
    } else if (res_esNifCif === 0) {
        error += "Se ha introducido un dato no válido. No es CIF<br>";
    }


    // Mostrar mensajes de error
    document.getElementById('mensajeErrores').innerHTML = error;
}