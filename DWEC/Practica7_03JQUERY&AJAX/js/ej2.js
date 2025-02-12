if (document.addEventListener)
	window.addEventListener("load",inicio)
else if (document.attachEvent)
	window.attachEvent("onload",inicio);

function inicio(){

    let obtenerNotaBtn = document.querySelector("input[type='submit']");
    obtenerNotaBtn.addEventListener("click", enviarPeticionFetch);

}

function enviarPeticionFetch(evento) {
    evento.preventDefault();

    let nombre = document.getElementById("nombre");
    let apellidos = document.getElementById("apellidos");
    let modulo = document.getElementById("modulo");
    let nota = document.getElementById("nota");

    if (nombre.value != '' && apellidos.value != '' && modulo.value != '') {

        let url = 'php/ej2.php?nombre=' + nombre.value +
                  '&apellidos=' + apellidos.value +
                  '&modulo=' + modulo.value;

        $.ajax({
            url: url,
            type: "GET",
            success: function(respuesta){
                nota.value = respuesta.trim();
                console.log("Respuesta del servidor: ", respuesta);
            },
            error: function(xhr, status, error){
                console.error("Error en la peticion: ",error);
            }
        });


    /*
        --GET--
        $.get(url, function(respuesta){
            nota.value = respuesta.trim;
        }, "text") //dataType: "text"
        .done(function(){
            console.log("2nd success");
        })
        .fail(function(error){
            console.log("Error: ", error);
        })
        .always(function(){
            console.log("Terminado");
        })
        .beforeSend(function(xhr){
            console.log("Antes de la solicitud ",xhr);
        })
        .complete(function(xhr, status){
            console.log("Solicitud completada: ", xhr);
            console.log("Estado: ",status);
        })
        .timeout(5000) //5segundos de tiempo de espera antes de mostrar error
        .cache(false) //No usar cache
        .async(true); //Asincrono


        --LOAD--
        $("#contenido").load(url, null, function(response, status, xhr){
                console.log("Peticion completada con .load");
                console.log("Respuesta: ", response);
                console.log("Status: ", status);
                console.log("XHR: ", xhr);
            }).beforeSend(function(xhr){
                console.log("Antes de la solicitud con .load", xhr);
            }).complete(function(xhr, status){
                console.log("La solicitud con .load se completó. Estado: ", status);
            })
            .timeout(5000)
            .cache(false)
            .async(true);
        
    */

    } else {
        alert("Por favor, complete todos los campos.");
    }
}
