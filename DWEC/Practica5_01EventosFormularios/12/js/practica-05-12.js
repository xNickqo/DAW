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
    let direccion = document.form.direccion.value.trim();
    let mensaje = document.form.mensaje;

    mensaje.value = "";

    if (direccion.length > 42 || direccion.length < 8)
    {
        mensaje.value = "direccion no valida: Longitud erronea";
        return false;
    }

    let i = 0;
    while (i < direccion.length)
    {
        if (!isLetter(direccion[0]))
        {
            mensaje.value = "direccion no valida: debe comenzar por 1 letra";
            return false;
        }

        if (!isLetter(direccion[direccion.length - 1]) && !isDigit(direccion[direccion.length - 1]))
        {
            mensaje.value = "direccion no valida: debe terminar por 1 letra o digito";
            return false;
        }
        
        if (!isLetter(direccion[i]) && !isDigit(direccion[i]) && direccion[i] === 'º'
            && direccion[i] === 'ª' && direccion[i] === '/' && direccion[i] === '-')
        {
            mensaje.value = "direccion no valida: caracteres invalidos";
            return false;
        }
        i++;
    }

    mensaje.value = "Direccion válida.";
    return true;
}
