$(window).on("load", inicio);

function inicio() {
    $("#pagina").selectmenu();
    $("#pagina").on("selectmenuchange", function() {
        var opcion = $(this).val();
        if (opcion) {
            window.location.href = opcion + ".html";
        }
    });
}