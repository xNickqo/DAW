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

        fetch('php/ej4.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: datos
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Error en la solicitud");
            }
            return response.text();
        })
        .then(texto => {
            sueldo.value = texto.trim();
        })
        .catch(error => {
            console.error("Error en la petición:", error);
        });

    } else {
        alert("Por favor, complete todos los campos.");
    }
}


