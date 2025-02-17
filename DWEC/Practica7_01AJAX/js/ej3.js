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

        let peticion = new XMLHttpRequest();

        if (window.XMLHttpRequest){ 
            peticion = new XMLHttpRequest(); 
        }else if (window.ActiveXObject){ 
            peticion = new ActiveXObject("Microsoft.XMLHTTP"); 
        }

        peticion.onreadystatechange = function() {
            if (peticion.readyState == 4 && peticion.status == 200) {
                nota_ro.value = peticion.responseText.trim();
            }
        };

        peticion.open("POST", 'php/ej3.php', true);
        peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        peticion.send('nombre='+nombre+'&apellidos'+apellidos+'&modulo='+modulo+'&nota='+nota);
    } else {
        alert("Por favor, complete todos los campos.");
    }
}


