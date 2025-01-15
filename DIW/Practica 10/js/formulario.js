$(window).on("load",inicio);

function inicio()
{
    $("#hrSm").on("input",valorRange);
    $("#hrSm").on("input",mostrarSueldo);
    $("#prHt").on("input",mostrarSueldo);
}

function valorRange()
{
    let range = $("#hrSm").val();
    $("#horasDisplay").text(range);
}

function mostrarSueldo()
{
    let range = $("#hrSm").val();
    let precio = $("#prHt").val();
    $("#sueldo").text((parseInt(range)*precio));
}