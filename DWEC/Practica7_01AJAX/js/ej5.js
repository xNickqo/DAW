if (document.addEventListener) {
    window.addEventListener("load", inicio);
} else if (document.attachEvent) {
    window.attachEvent("onload", inicio);
}

function inicio() {
    let boton = document.querySelector("input[type='button']"); // Asegúrate de que sea un botón.
    
    if (document.addEventListener) {
        boton.addEventListener("click", enviarPeticion);
    } else if (document.attachEvent) {
        boton.attachEvent("onclick", enviarPeticion);
    }
}

function enviarPeticion() {
    // Capturamos los valores del formulario
    let marca = document.getElementById("marca").value;
    let dimensiones = document.getElementById("dimensiones").value;

    // Construimos el XML
    let cadenaXML = `
        <DatosTelevisores>
            <marca>${marca}</marca>
            <dimensiones>${dimensiones}</dimensiones>
            <precio>600€</precio>
        </DatosTelevisores>
    `;

    // Creamos el objeto XMLHttpRequest
    let peticion = new XMLHttpRequest();
    if (window.XMLHttpRequest) { 
        peticion = new XMLHttpRequest(); 
    } else if (window.ActiveXObject) { 
        peticion = new ActiveXObject("Microsoft.XMLHTTP"); 
    }

    // Configuramos la solicitud
    peticion.open("POST", "php/ej5.php", true);
    peticion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Manejamos la respuesta
    peticion.onreadystatechange = function () {
        if (peticion.readyState === 4 && peticion.status === 200) {
            let respuestaXML = peticion.responseXML;
            
            if (respuestaXML) {
                let datosTelevisores = respuestaXML.getElementsByTagName("DatosTelevisores")[0];
                let marcaRespuesta = datosTelevisores.getElementsByTagName("marca")[0].textContent;
                let dimensionesRespuesta = datosTelevisores.getElementsByTagName("dimensiones")[0].textContent;
                let precioRespuesta = datosTelevisores.getElementsByTagName("precio")[0].textContent;

                // Mostramos los datos
                alert(`Marca: ${marcaRespuesta}\nDimensiones: ${dimensionesRespuesta}\nPrecio: ${precioRespuesta}`);
            } else {
                alert("La respuesta del servidor no es un XML válido.");
            }
        }
    };

    // Enviamos los datos
    peticion.send(cadenaXML);
}
