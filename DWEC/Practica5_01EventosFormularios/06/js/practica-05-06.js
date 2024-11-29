window.onload = inicio;

function inicio()
{
    document.form.comprobar.onclick=comprobar;
}

function comprobar()
{
    let cadena = document.form.cadena.value.toLowerCase();
    let subcadena = document.form.vocal.value.toLowerCase();

    let count = 0;

    let cad_len = cadena.length;
    let sub_len = subcadena.length;

    for (let i = 0; i <= cad_len - sub_len; i++)
    {
        let substr = cadena.substring(i, i + sub_len);

        if (substr === subcadena)
            count++;
    }

    document.form.mensaje.value = count;

}

