if (document.addEventListener)
	window.addEventListener("load",inicio)
else if (document.attachEvent)
	window.attachEvent("onload",inicio);

function inicio(){
    let boton = document.querySelector("input[type='submit']");
    
    if(document.addEventListener){
        boton.addEventListener("click", enviarPeticionAJAX);
    }else if(document.attachEvent){
        boton.addEventListener("onclick", enviarPeticionAJAX);
    }

}

function enviarPeticionAJAX(evento){
    evento.preventDefault();

    let nombre = document.getElementById("nombre").value;
    let apellidos = document.getElementById("apellidos").value;
    let puestoTrabajo = document.getElementById("puestoTrabajo").value;

    let sueldo = document.getElementById("sueldo");

    if (nombre != '' && apellidos != '' && puestoTrabajo != '') {
        let miformulario = document.getElementById("formulario"); 
        let datos = new FormData(miformulario);

        $.ajax({
            url: "php/ej4.php",
            type: "POST",
            data: datos,
            processData: false,
            contentType: false,
            beforeSend: function(){
                console.log("CARGANDO LA PETICION...");
            },
            success: function(respuesta){
                sueldo.value = respuesta.trim();
                console.log("Respuesta del servidor: ", respuesta);
            },
            error: function(xhr, status, error){
                console.error("Error en la peticion: ",error);
            },
            complete: function(){
                console.log("La peticion finalizo");
            }
        });


    } else {
        alert("Por favor, complete todos los campos.");
    }
}


