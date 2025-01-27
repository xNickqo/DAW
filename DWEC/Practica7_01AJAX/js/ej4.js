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
        let peticion = new XMLHttpRequest();
        if (window.XMLHttpRequest){ 
            peticion = new XMLHttpRequest(); 
        }else if (window.ActiveXObject){ 
            peticion = new ActiveXObject("Microsoft.XMLHTTP"); 
        }

        peticion.onreadystatechange = function() {
            if (peticion.readyState == 4 && peticion.status == 200) {
                sueldo.value = peticion.responseText.trim();
            }
        };

        peticion.open("POST", 'php/ej4.php', true);
        peticion.send(datos);
    } else {
        alert("Por favor, complete todos los campos.");
    }
}


