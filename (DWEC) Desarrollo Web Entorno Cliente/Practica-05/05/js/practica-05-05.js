window.onload = inicio;

function inicio()
{
    document.form.convertir.onclick=converter;
}

function decToBin(dec)
{
    let aux = '';

    while (dec > 0)
    {
        aux = (dec % 2) + aux;
        dec = Math.floor(dec/2); 
    }
    while (aux.length < 8)
        aux = '0' + aux;
    return (aux);
}

function decToOct(dec)
{
    let aux = '';

    while (dec > 0)
    {
        aux = (dec % 8) + aux;
        dec = Math.floor(dec/8); 
    }
    while (aux.length < 3)
        aux = '0' + aux;
    return (aux);
}

function decToHex(dec)
{
    let hex = dec.toString(16).toUpperCase();
    while (hex.length < 2)
    {
        hex = '0' + hex;
    }
    return hex;
}

function converter()
{
    let dec = Number(document.form.decimal.value);
    
    if(!isNaN(dec))
    {
        let bin = decToBin(dec);
        document.form.binario.value = bin;

        let oct = decToOct(dec);
        document.form.octal.value = oct;

        let hex = decToHex(dec);
        document.form.hexadecimal.value = hex;
    }
    else 
        alert("Ingrese un numero");
}
