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

        let url = 'php/ej2.php?nombre=' + encodeURIComponent(nombre.value) +
                  '&apellidos=' + encodeURIComponent(apellidos.value) +
                  '&modulo=' + encodeURIComponent(modulo.value);

     
        fetch(url).then(function(respuesta) {
            if (!respuesta.ok) {
                throw new Error("Error en la petición");
            }
            return respuesta.text(); 
        })
        .then(function(texto) {
            nota.value = texto.trim();
        })
        .catch(function(error) {
            console.error("Error en la petición:", error);
        });
    } else {
        alert("Por favor, complete todos los campos.");
    }
}
