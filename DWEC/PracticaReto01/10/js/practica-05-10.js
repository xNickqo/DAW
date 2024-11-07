window.onload = inicio;

function inicio() {
    document.forms[0].comprobar.onclick = comprobar;
}

function isLetter(c) {
    return (c >= 'a' && c <= 'z') || (c >= 'A' && c <= 'Z');
}

function isDigit(c) {
    return c >= '0' && c <= '9';
}

function comprobar() {
    let url = document.forms[0].url.value.trim();
    let mensaje = document.forms[0].mensaje;

    // Comprobar si empieza con http:// o https:// o no tiene nada
    if (url.startsWith("http://")) {
        url = url.slice(7);
    } else if (url.startsWith("https://")) {
        url = url.slice(8);
    }

    // Comprobar si empieza con "www."
    if (!url.startsWith("www.")) {
        mensaje.value = "URL no válida: falta 'www.'";
        return false;
    }

    url = url.slice(4); // Eliminar "www."

    // Dividir la URL en dos partes: dominio y extensión
    let partes = url.split('.');
    if (partes.length !== 2) {
        mensaje.value = "URL no válida: debe contener un dominio y una extensión";
        return false;
    }

    let dominio = partes[0];
    let extension = partes[1];

    // Comprobar que el dominio comience con una letra
    if (!isLetter(dominio[0])) {
        mensaje.value = "URL no válida: el dominio debe comenzar con una letra";
        return false;
    }

    // Comprobar que el dominio solo contenga letras, dígitos o guiones
    for (let i = 0; i < dominio.length; i++) {
        if (!isLetter(dominio[i]) && !isDigit(dominio[i]) && dominio[i] !== '-') {
            mensaje.value = "URL no válida: el dominio contiene caracteres inválidos";
            return false;
        }
    }

    // Comprobar que el dominio termine con una letra o dígito
    if (!isLetter(dominio[dominio.length - 1]) && !isDigit(dominio[dominio.length - 1])) {
        mensaje.value = "URL no válida: el dominio debe terminar con una letra o un dígito";
        return false;
    }

    // Comprobar que la extensión tenga entre 2 y 4 letras
    if (extension.length < 2 || extension.length > 4) {
        mensaje.value = "URL no válida: la extensión debe tener entre 2 y 4 letras";
        return false;
    }

    // Comprobar que la extensión solo contenga letras
    for (let i = 0; i < extension.length; i++) {
        if (!isLetter(extension[i])) {
            mensaje.value = "URL no válida: la extensión contiene caracteres no válidos";
            return false;
        }
    }

    // Si todas las validaciones pasan, mostramos que la URL es válida
    mensaje.value = "URL válida.";
    return true;
}
