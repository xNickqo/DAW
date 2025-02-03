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

    let nombre = document.getElementById("nombre");
    let apellidos = document.getElementById("apellidos");
    let modulo = document.getElementById("modulo");
    let nota = document.getElementById("nota");
    let nota_ro = document.getElementById("nota_ro");

    if (nombre.value != '' && apellidos.value != '' && modulo.value != '' &&  nota.value != '') {

        let params = 'nombre=' + encodeURIComponent(nombre.value) +
                       '&apellidos=' + encodeURIComponent(apellidos.value) +
                       '&modulo=' + encodeURIComponent(modulo.value) +
                       '&nota=' + encodeURIComponent(nota.value);

        fetch('php/ej3.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: params
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Error en la solicitud");
            }
            return response.text();
        })
        .then(texto => {
            nota_ro.value = texto.trim();
        })
        .catch(error => {
            console.error("Error en la petición:", error);
        });
    } else {
        alert("Por favor, complete todos los campos.");
    }
}


