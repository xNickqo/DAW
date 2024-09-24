window.onload = inicio;

function inicio()
{
    document.form.comprobar.onclick=comprobar;
}

function comprobar()
{
    let cadena = document.form.cadena.value.toLowerCase();
    let i = 0;
    let vocales = 0;
    let consonantes = 0;

    let contadorA = 0;
    let contadorE = 0;
    let contadorI = 0;
    let contadorO = 0;
    let contadorU = 0;

    document.form.a.value = 0;
    document.form.e.value = 0;
    document.form.i.value = 0;
    document.form.o.value = 0;
    document.form.u.value = 0;
    document.form.vocales.value = 0;
    document.form.consonantes.value = 0;

    while (i < cadena.length)
    {
        let char = cadena[i];

        if (char === 'a' || char === 'e' || char === 'i' || char === 'o' || char === 'u')
        {
            vocales++;
            if (char === 'a') 
                contadorA++;
            if (char === 'e') 
                contadorE++;
            if (char === 'i') 
                contadorI++;
            if (char === 'o') 
                contadorO++;
            if (char === 'u') 
                contadorU++;
        } 
        else if (char >= 'b' && char <= 'z' && 
            char !== 'e' && char !== 'i' && char !== 'o' && char !== 'u')
                consonantes++;
        i++;
    }
    
    document.form.a.value = contadorA;
    document.form.e.value = contadorE;
    document.form.i.value = contadorI;
    document.form.o.value = contadorO;
    document.form.u.value = contadorU;
    document.form.vocales.value = vocales;
    document.form.consonantes.value = consonantes;
}

