window.onload = () => {
    document.form.comprobar.onclick = comprobar;
};

// Función para mostrar mensajes
function mensaje(texto = "Código Incorrecto")
{
    document.form.mensaje.value = texto;
}

// Función para comprobar si el carácter es una letra
function comp_letra(caracter)
{
    let codigo = caracter.charCodeAt(0);
    return (codigo >= 'a' && codigo <= 'z') || (codigo >= 'A' && codigo <= 'Z');
}

// Función para comprobar si el carácter es un dígito
function comp_digito(caracter)
{
    let codigo = caracter.charCodeAt(0);
    return codigo >= '0' && codigo <= '9';
}

// Función para comprobar letras seguidas específicas
function comp_letrasSeguidas(c1, c2)
{
    let combinacionesValidas = [['A', 'N'],
                                ['E', 'S'],
                                ['D', 'L'],
                                ['U', 'S']];

    for (let [letra1, letra2] of combinacionesValidas)
    {
        if (c1 === letra1 && c2 === letra2)
            return true;
    }
    return false;
}

// Función para comprobar caracteres especiales: #, @, $, &
function comp_especiales(caracter)
{
    let especiales = ['#', '@', '$', '&'];
    return especiales.includes(caracter);
}

// Función para comprobar otros caracteres especiales: %, /, ?, !
function comp_especiales2(caracter)
{
    let especiales = ['%', '/', '?', '!'];
    return especiales.includes(caracter);
}

// Función para procesar un patrón de letras seguidas
function procesarPatron(cadena, posInicial)
{
    let secuencias = [[6, 7], [5, 6], [4, 5], [3, 4]];

    for (let secuencia of secuencias)
    {
        if (comp_letrasSeguidas(cadena[secuencia[0]], cadena[secuencia[1]]))
            return secuencia[1] + 1;
    }

    mensaje();
    return posInicial;
}

// Función para comprobar una secuencia de dígitos
function comprobarDigitos(cadena, posInicial, cantidad)
{
    for (let i = posInicial; i < posInicial + cantidad; i++)
    {
        if (!comp_digito(cadena[i]))
        {
            mensaje();
            return 0;
        }
    }
    return cantidad;
}

// Función para comprobar una secuencia de letras
function comprobarLetras(cadena, posInicial, cantidad)
{
    for (let i = posInicial; i < posInicial + cantidad; i++)
    {
        if (!comp_letra(cadena[i]))
            return false;
    }
    return true;
}

// Función para comprobar si hay letras, dígitos o caracteres especiales al final
function comprobarCaracteresEspeciales(cadena) {
    for (let i = 0; i < cadena.length; i++) {
        if (!comp_letra(cadena[i]) && !comp_digito(cadena[i]) && !comp_especiales2(cadena[i])) {
            return false;
        }
    }
    return true;
}

// Función para procesar letras o dígitos en secuencia
function procesarLetrasODigitos(cadena, ultimoCaracter) {
    if (comp_letra(cadena[ultimoCaracter])) {
        ultimoCaracter++;
        if (comp_letra(cadena[ultimoCaracter])) {
            ultimoCaracter++;
            if (!comp_letra(cadena[ultimoCaracter])) {
                ultimoCaracter += comprobarDigitos(cadena, ultimoCaracter, 3);
            } else {
                ultimoCaracter++;
            }
        } else {
            ultimoCaracter += comprobarDigitos(cadena, ultimoCaracter, 3);
        }
    } else {
        ultimoCaracter += comprobarDigitos(cadena, ultimoCaracter, 3);
    }
    return ultimoCaracter + 3;
}

// Función principal para iniciar la comprobación del código
function comprobar()
{
    let cadena = document.form.codigo.value;

    if (cadena.length < 20 || cadena.length > 26)
        mensaje();
    else 
        comprobarCodigo(cadena);
}

function comprobarCodigo(cadena)
{
    let seguir = true;
    let ultimoCaracter = 0;

    // Comprobar primeros 3 dígitos
    for (let i = 0; i < 3; i++)
    {
        if (!comp_digito(cadena[i]))
        {
            seguir = false;
            mensaje();
            return ;
        }
    }

    ultimoCaracter = procesarPatron(cadena, 3);

    if (!comp_especiales(cadena[ultimoCaracter]))
    {
        seguir = false;
        mensaje();
    } 
    else 
        ultimoCaracter++;


    // Comprobar 5 letras a continuación
    if (!comprobarLetras(cadena, ultimoCaracter, 5))
    {
        seguir = false;
        mensaje();
    }
    ultimoCaracter += 5;

    // Comprobar secuencia de letras o dígitos
    ultimoCaracter = procesarLetrasODigitos(cadena, ultimoCaracter);
    
    // Comprobar últimos 2 caracteres
    if (!comprobarLetras(cadena, ultimoCaracter, 2))
    {
        seguir = false;
        mensaje();
    }

    // Comprobar los últimos 6 caracteres (letras, dígitos o especiales)
    if (!comprobarCaracteresEspeciales(cadena.slice(-6)))
    {
        seguir = false;
        mensaje();
    }

    if (seguir)
        mensaje("Código Correcto");
}
