$(window).on("load", inicio);

function inicio() {
    // Inicializamos el menú con jQuery UI
    $("#menu").menu();

    // Cuando se haga clic en "García Lorca"
    $("#garcia-lorca").on("click", function() {
        window.open('garcia_lorca.html', '_blank');
    });

    // Cuando se haga clic en "Formulario"
    $("#formulario").on("click", function() {
        window.open('formulario.html', '_blank');
    });

    // Cuando se haga clic en "España"
    $("#espana").on("click", function() {
        window.open('espana.html', '_blank');
    });

    // Cuando se haga clic en "Progreso"
    $("#progreso").on("click", function() {
        window.open('progreso.html', '_blank');
    });
}