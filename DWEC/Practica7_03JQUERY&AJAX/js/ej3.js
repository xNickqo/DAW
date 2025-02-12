if (document.addEventListener)
	window.addEventListener("load",inicio)
else if (document.attachEvent)
	window.attachEvent("onload",inicio);

function inicio(){
    let obtenerNotaBtn = document.querySelector("input[type='submit']");
    
    if(document.readyState == 'complete'){
        if(document.addEventListener){
            obtenerNotaBtn.addEventListener("click", enviarPeticionAJAX);
        }else if(document.attachEvent){
            obtenerNotaBtn.addEventListener("onclick", enviarPeticionAJAX);
        }
    }
}

function enviarPeticionAJAX(evento){
    evento.preventDefault();

    let nombre = document.getElementById("nombre").value;
    let apellidos = document.getElementById("apellidos").value;
    let modulo = document.getElementById("modulo").value;
    let nota = document.getElementById("nota").value;
    let nota_ro = document.getElementById("nota_ro");

    if (nombre.value != '' && apellidos.value != '' && modulo.value != '' &&  nota.value != '') {

        $.ajax({
            url: "php/ej3.php",
            type: "POST",
            data: {
                nombre: nombre,
                apellidos: apellidos,
                modulo: modulo,
                nota: nota},
            beforeSend: function(){
                console.log("CARGANDO LA PETICION...");
            },
            success: function(respuesta){
                nota_ro.value = respuesta.trim();
                console.log("Respuesta del servidor: ", respuesta);
            },
            error: function(xhr, status, error){
                console.error("Error en la peticion: ",error);
            },
            complete: function(){
                console.log("La peticion finalizo");
            }
        });

        /*
        --$.post()--
        $.post("php/ej3.php", { nombre: nombre, apellidos: apellidos, modulo: modulo, nota: nota }, function(respuesta) {
            nota_ro.value = respuesta.trim();
            console.log("Respuesta del servidor con $.post(): ", respuesta);
        });

        --$load()--
        $("#nota_ro").load("php/ej3.php?nombre=" + encodeURIComponent(nombre) + 
                           "&apellidos=" + encodeURIComponent(apellidos) + 
                           "&modulo=" + encodeURIComponent(modulo) + 
                           "&nota=" + encodeURIComponent(nota));
        */

    } else {
        alert("Por favor, complete todos los campos.");
    }
}


