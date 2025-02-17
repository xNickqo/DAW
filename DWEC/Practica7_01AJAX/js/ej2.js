if (document.addEventListener)
	window.addEventListener("load",inicio)
else if (document.attachEvent)
	window.attachEvent("onload",inicio);

function inicio(){

    let obtenerNotaBtn = document.querySelector("input[type='submit']");
    obtenerNotaBtn.addEventListener("click", enviarPeticionAJAX);

}

function enviarPeticionAJAX(evento) {
    evento.preventDefault();

    let nombre = document.getElementById("nombre").value;
    let apellidos = document.getElementById("apellidos").value;
    let modulo = document.getElementById("modulo").value;
    let nota = document.getElementById("nota");

    if (nombre.value != '' && apellidos.value != '' && modulo.value != '') {

        let peticion = new XMLHttpRequest();

        if (window.XMLHttpRequest){ 
            peticion = new XMLHttpRequest(); 
        }else if (window.ActiveXObject){ 
            peticion = new ActiveXObject("Microsoft.XMLHTTP"); 
        }

        peticion.onreadystatechange = function() {
            if (peticion.readyState == 4 && peticion.status == 200) {
                nota.value = peticion.responseText.trim();
            }
        };

        let url = 'php/ej2.php?nombre='+nombre+'&apellidos='+apellidos+'&modulo='+modulo;

        peticion.open("GET", url, true);
        peticion.send();
    } else {
        alert("Por favor, complete todos los campos.");
    }
}
