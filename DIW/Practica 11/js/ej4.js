$(document).ready(function () {
    $("#progressBar").progressbar({
        value: 0
    });

    $("#iniciar").button().on("click", function () {
        let incremento = $("#incremento").val();

        if (!isNaN(incremento) && incremento > 0) {
            let progress = 0;
            $("#progressBar").progressbar("value", progress);

            function actualizarBarra() {
                if (progress < 100) {
                    progress += 1;
                    $("#progressBar").progressbar("value", progress);
                    setTimeout(actualizarBarra, incremento / 100);
                } else {
                    alert("Progreso completado!");
                }
            }

            actualizarBarra();  
        } else {
            alert("Por favor, introduce un tiempo válido en milisegundos.");
        }
    });
});