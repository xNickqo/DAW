window.onload = inicio;

function inicio()
{
    document.form.hacer.onclick=funcionHacer;
}

function funcionHacer()
{
    let nom = document.form.nombre.value;
    
    let ape = document.form.apellidos.value;

    let completo = nom + " " + ape;
    document.form.completo.value = completo;
    
    let todas= document.form.provincias;
    let valores= "";
    for(let i = 0; i < todas.length; i++)
    {
        if (todas[i].selected)
        {
            valores += todas[i].value + "\n";
        }
    }
    document.form.misprovincias.value=valores;
}
