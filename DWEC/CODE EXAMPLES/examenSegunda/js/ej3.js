$(document).ready(function () {
    inicio();
});

function inicio() {
    $("#aplicar").click(aplicarColores);

    $(".salamanca").mouseenter(function() {
        $(this).addClass("saltarina");
    });

    $(".salamanca").mouseleave(function() {
        $(this).removeClass("saltarina");
    });

    $("#cambiar").click(function() {
        let comu = $("#comunidades").val();
        let fila = $("#ciudades tbody tr");
        
        if ($("#provinciasEliminadas").length === 0) {
            $("body").append('<ol id="provinciasEliminadas"></ol>');
        }


        for (let i = 0; i < fila.length; i++){
            
            let celda = $(fila[i]).find("td");
            let comunidad = $(celda[0]).text();
            
            if (comu.includes(comunidad)) {
                $(fila[i]).remove();
            
                let li = $("<li></li>").text($(celda[0]).text() + " - " + $(celda[1]).text() + " - " + $(celda[2]).text() + " - " + $(celda[3]).text());
                    
                $("#provinciasEliminadas").append(li);
               
            }
        }
        
    });

}

function aplicarColores(){
    $("#coches tbody tr").each(function(index) {
        if (index % 2 === 0) {
            $(this).find("td:first-child, td:last-child").css("color", "green");
            $(this).find("td:first-child, td:last-child").css("background-color", "orange"); 

            $(this).find("td:nth-child(2)").css("color", "red");
            $(this).find("td:nth-child(2)").css("background-color", "yellow"); 
        } else { 
            $(this).find("td:first-child, td:last-child").css("color", "red");
            $(this).find("td:first-child, td:last-child").css("background-color", "yellow");

            $(this).find("td:nth-child(2)").css("color", "green");
            $(this).find("td:nth-child(2)").css("background-color", "orange");
        }
    });
}