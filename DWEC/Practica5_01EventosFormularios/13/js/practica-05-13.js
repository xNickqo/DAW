window.onload = inicio;

function inicio() {
    document.form.comprobar.onclick = comprobar;
}

function comprobar() {
    let palindromo = document.form.palindromo.value.trim().toLowerCase();
    let mensaje = document.form.mensaje;

    mensaje.value = "";

    // Cadena auxiliar a partir de la original, sin espacios
    let noSpacesPal = "";
    let i = 0;
    while (i < palindromo.length)
    {
        if((palindromo[i] !== ' '))
            noSpacesPal += palindromo[i];
        i++;
    }

    // Indroducir cadena al reves
    len = noSpacesPal.length - 1;
    let reves = "";
    while (len >= 0)
    {
        reves += noSpacesPal[len]
        len--;
    }

    // Validacion
    if (noSpacesPal === reves) {
        mensaje.value = "Es palindromo.";
        return true;
    } else {
        mensaje.value = "NO";
        return false;
    }
}
