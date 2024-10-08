function validarFormulario() {
    let cadena = document.formu.nif.value.trim().toUpperCase(); 

    let resultado = esNif(cadena);

    if (resultado === 1) {
        window.alert("Se ha introducido un NIF correcto");
    } else if (resultado === 2) {
        window.alert("Se ha introducido un NIF erróneo. El carácter de control es erróneo");
    } else if (resultado === 3) {
        window.alert("Se ha introducido un DNI, se ha pasado un número de entre 6 y 8 dígitos con un valor mínimo de 100000");
    } else if (resultado === 0) {
        window.alert("Se ha introducido un dato no válido. No es NIF ni DNI");
    }
}

// Verifica si el carácter es un dígito
function isDigit(caracter) {
    return caracter >= '0' && caracter <= '9';
}

// Verifica si el carácter es una letra
function isLetter(caracter) {
    return caracter >= 'A' && caracter <= 'Z';
}

function esNif(cadena)
{
    let controlChars = "TRWAGMYFPDXBNJZSQVHLCKE";

    // 1ª Forma: 8 dígitos + letra de control
    if (cadena.length === 9)
    {
        let i = 0;
        while (i < 8)
        {
            if (!isDigit(cadena[i]))
                return 0;
            i++;
        }

        // Validar si el último carácter es una letra
        if (isLetter(cadena[8]))
        {
            // Extraer los 8 primeros dígitos como número
            let numeros = parseInt(cadena.substring(0, 8), 10);
            // Calcular la letra de control correcta
            let letraCalculada = controlChars[numeros % 23];

            // Comparar la letra calculada con la proporcionada
            if (letraCalculada === cadena[8])
                return 1;
            else
                return 2;
            
        }

        // 2ª Forma: Letra inicial + 7 dígitos + letra de control
        let validInitialLetters = ['X', 'Y', 'Z', 'L', 'K'];

        if (validInitialLetters.includes(cadena[0]))
        {
            let i = 1;
            while (i < 8)
            {
                if (!isDigit(cadena[i]))
                    return 0;
                i++;
            }

            if (isLetter(cadena[8]))
            {
                // Reemplazar la letra inicial si es X, Y o Z
                let numero = parseInt(cadena.substring(1, 8), 10);
                if (cadena[0] === 'Y') numero = parseInt("1" + cadena.substring(1, 8), 10); // Reemplazar Y por 1
                if (cadena[0] === 'Z') numero = parseInt("2" + cadena.substring(1, 8), 10); // Reemplazar Z por 2

                // Calcular la letra de control correcta
                let letraCalculada = controlChars[numero % 23];

                // Comparar la letra calculada con la proporcionada
                if (letraCalculada === cadena[8]) {
                    return 1;
                } else {
                    return 2;
                }
            }
        }
    }

    // Verificar si es un DNI (6 a 8 dígitos con mínimo 100000)
    if (cadena.length >= 6 && cadena.length <= 8)
    {
        let numero = parseInt(cadena, 10);
        if (numero >= 100000)
            return 3;
    }

    return 0;
}
