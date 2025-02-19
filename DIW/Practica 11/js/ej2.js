$(window).on("load", inicio);

function inicio(){
    $( "#fechaNac" ).datepicker();
    $( "input" ).tooltip();
    $( "#enviar" ).button();

    $("#nombre, #apellidos").on("click", function () {
        $("#dialog").dialog("open");
    });

    $("#dialog").dialog({
        resizable: true,
        autoOpen: false,
        model: true,
        show: {
            effect: "blind",
            duration: 1000
          },
          hide: {
            effect: "explode",
            duration: 1000
          },
        buttons: {
            "Aceptar": function () {
                let nombreDialog = $("#dialog_nombre").val();
                let apellidosDialog = $("#dialog_apellidos").val();

                $("#nombre").val(nombreDialog); 
                $("#apellidos").val(apellidosDialog); 

                $("#dialog").dialog("close");
            },
            "Cancelar": function () {
                $("#dialog").dialog("close");
            }
        }
    });

    function actualizarSueldo() {
        let horas = $("#hrSm").slider("value");
        let precioHora = $("#prHt").val();

        console.log('Horas:', horas);
        console.log('Precio por hora:', precioHora);
        
        let sueldo = horas * precioHora;
        console.log('Sueldo calculado:', sueldo);

        $("#sueldo").text(sueldo)
    }

    $( "#hrSm" ).slider({
        value:2, 
        min:0, 
        max:40, 
        step:1, 
        orientation:"horizontal",
        slide: function() {
            let valorHoras = $(this).slider("value");
            $("#horasDisplay").text(valorHoras);
            actualizarSueldo();
        },
        change: function() {
            actualizarSueldo();
        }
    }
    );

    $( "#prHt" ).spinner({
        value: 5,
        min:5, 
        max:40, 
        step:2,
        change: function() {
            actualizarSueldo();
        }
    }
    );

    $( "#comunidadAutonoma" ).button();
}