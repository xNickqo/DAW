$(window).on("load", inicio);

function inicio(){
    $( "#fechaNac" ).datepicker();
    $( "input" ).tooltip();
    $( "#enviar" ).button();

    $("#nombre, #apellidos").on("focus", function () {
        if($("#dialog").dialog("isOpen"))
            $("#dialog").dialog("option", "hidden", false);
        else
            $("#dialog").dialog("open");
    });

    $("#dialog").dialog({
        autoOpen: false,
        buttons: {
            "Aceptar": function () {
                let nombreDialog = $("#dialog_nombre").val();
                let apellidosDialog = $("#dialog_apellidos").val();

                $("#nombre").val(nombreDialog); 
                $("#apellidos").val(apellidosDialog); 

                $("#dialog").dialog("option", "hidden", true);
            },
            "Cancelar": function () {
                $("#dialog").dialog("option", "hidden", true);
            }
        }
    });

    $( "#hrSm" ).slider({
        value:2, 
        min:0, 
        max:40, 
        step:1, 
        orientation:"horizontal",

    }
    );

    $( "#prHt" ).spinner({ 
        min:5, 
        max:40, 
        step:2
    }
    );

    $( "#comunidadAutonoma" ).button();
}