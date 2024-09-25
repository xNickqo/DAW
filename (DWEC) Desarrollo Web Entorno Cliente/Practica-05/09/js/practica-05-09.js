window.onload = inicio;

function inicio() {
    document.form.comprobar.onclick = comprobar;
}

function isLetter(caracter) {
    return (caracter >= 'a' && caracter <= 'z') || (caracter >= 'A' && caracter <= 'Z');
}

function isOnlyLetters(cadena) {
    for (let i = 0; i < cadena.length; i++) {
        if (!isLetter(cadena[i])) {
            return false;
        }
    }
    return true;
}

function comprobar() {
    let email = document.form.email.value.trim();
    let mensaje = document.form.mensaje;

    mensaje.value = "";

    if (!isLetter(email[0])) {
        mensaje.value = "El primer caracter debe ser una letra.";
        return;
    }


    let arrobaEncontrada = false;
    let puntoEncontrado = false;
    let dominio = "";

    for (let i = 0; i < email.length; i++) {
        if (email[i] === '@') {
            arrobaEncontrada = true;
            for (let j = i + 1; j < email.length; j++) {
                if (email[j] === '.') {
                    puntoEncontrado = true;
                    dominio = email.slice(j + 1);
                    break;
                }
            }
            break;
        }
    }

    // Validación: Falta el '@'
    if (!arrobaEncontrada) {
        mensaje.value = "El email debe contener un '@'";
        return;
    }

    // Validación: Falta el punto '.' después del '@'
    if (!puntoEncontrado) {
        mensaje.value = "El email debe contener un '.'";
        return;
    }

    // Validación: El dominio (parte después del punto) debe tener entre 2 y 4 letras
    if (dominio.length < 2 || dominio.length > 4 || !isOnlyLetters(dominio)) {
        mensaje.value = "El dominio después del '.' debe tener entre 2 y 4 letras.";
        return;
    }

    // Si todas las validaciones pasan, mostramos que el email es válido
    mensaje.value = "Email válido.";
}



