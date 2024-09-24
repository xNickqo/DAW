window.onload = inicio;

function inicio()
{
    document.form.comprobar.onclick=comprobar;
}

function isLetter(char)
{
    return (char >= 'a' && char <= 'z');
}

function comprobar()
{
    let nombre = document.form.nombre.value.trim().toLowerCase();
    let mensaje = document.form.mensaje;
    let validCharacters = ['º', 'ª', '-', ' '];

    if (nombre.length < 3 || nombre.length > 27)
    {
        mensaje.value = "El nombre debe tener entre 3 y 27 caracteres.";
        return ;
    }

    if (!isLetter(nombre[0]) || !isLetter(nombre[nombre.length - 1]))
    {
        mensaje.value = "El nombre debe empezar y terminar por una letra.";
        return ;
    }

    for (let i = 1; i < nombre.length - 1; i++)
    {
        if (!isLetter(nombre[i]) && !validCharacters.includes(nombre[i]))
        {
            mensaje.value = "El nombre contiene caracteres inválidos.";
            return ;
        }
    }
    mensaje.value = "Nombre válido.";
}

