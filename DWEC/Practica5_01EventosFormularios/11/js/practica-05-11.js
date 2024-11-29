window.onload = inicio;

function inicio() {
    document.form.comprobar.onclick = comprobar;
}

function isLetter(c) {
    return (c >= 'a' && c <= 'z') || (c >= 'A' && c <= 'Z');
}

function isDigit(c) {
    return c >= '0' && c <= '9';
}

function comprobar() {
    let localidad = document.form.localidad.value.trim();
    let mensaje = document.form.mensaje;

    mensaje.value = "";

    if (localidad.length > 35 || localidad.length < 7)
    {
        mensaje.value = "Localidad no valida: Longitud erronea";
        return false;
    }

    let i = 0;
    while (i < 3)
    {
        if (!isLetter(localidad[i]))
        {
            mensaje.value = "Localidad no valida: debe comenzar por 3 letras";
            return false;
        }
        i++;
    }

    let parte = localidad.slice(3);

    i = 0;
    while (i < parte.length)
    {
        if (!isLetter(parte[i]) && parte[i] !== ' ')
        {
            mensaje.value = "Localidad no valida: despues de las tres letras puede haber espacio y letras";
            return false;
        }
        if (parte.length < 2 && !isLetter(parte[parte.length - 1]) && !isLetter(parte[parte.length - 2]))
        {
            mensaje.value = "Localidad no valida: debe terminar por 2 letras";
            return false;
        }
        i++;
    }

    mensaje.value = "Localidad válida.";
    return true;
}
