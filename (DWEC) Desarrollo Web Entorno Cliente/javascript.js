window.onload = inicio;

function inicio()
{
    document.formula.hacer.onclick=funcionHacer;
}

function funcionHacer()
{
    let nom = document.formula.nombre.value;
    
    let ape = document.formula.apellidos.value;

    let completo = nom + " " + ape;
    document.formula.completo.value = completo;
    
    let todas= document.formula.povincias;
    let valores= "";
    for(let i = 0; i < todas.length; i++)
    {
        if (todas[i].selected)
        {
            valores += todas[i].value + "\n";
        }
    }
    document.formula.misprovincias.value=valores;
}
