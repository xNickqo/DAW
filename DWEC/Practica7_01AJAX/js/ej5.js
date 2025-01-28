if (document.addEventListener) {
    window.addEventListener("load", inicio);
} else if (document.attachEvent) {
    window.attachEvent("onload", inicio);
}

function inicio() {

    cargarMarcasYDimensiones();

    if(document.addEventListener){
        document.getElementById("marca").addEventListener("change", obtenerPrecio);
    }else if(document.attachEvent){
        document.getElementById("marca").addEventListener("change", obtenerPrecio);
    }

    if(document.addEventListener){
        document.getElementById("dimensiones").addEventListener("change", obtenerPrecio);
    }else if(document.attachEvent){
        document.getElementById("dimensiones").addEventListener("change", obtenerPrecio);
    }
}

function cargarMarcasYDimensiones() {

    let peticion = new XMLHttpRequest();
    if (window.XMLHttpRequest){ 
        peticion = new XMLHttpRequest(); 
    }else if (window.ActiveXObject){ 
        peticion = new ActiveXObject("Microsoft.XMLHTTP"); 
    }

    peticion.open("GET", "php/ej5a.php", true);
    
    peticion.onreadystatechange = function() {
        if (peticion.readyState === 4 && peticion.status === 200) {

            let respuestaXML = peticion.responseXML;
            
            if (respuestaXML) {
                let marcas = respuestaXML.getElementsByTagName("marca");
                let dimensiones = respuestaXML.getElementsByTagName("dimensiones");

                // Llenar el select de marcas
                let marcaSelect = document.getElementById("marca");
                for (let i = 0; i < marcas.length; i++) {
                    let option = document.createElement("option");
                    option.value = marcas[i].textContent;
                    option.textContent = marcas[i].textContent;
                    marcaSelect.appendChild(option);
                }

                // Llenar el select de dimensiones
                let dimensionesSelect = document.getElementById("dimensiones");
                for (let i = 0; i < dimensiones.length; i++) {
                    let option = document.createElement("option");
                    option.value = dimensiones[i].textContent;
                    option.textContent = dimensiones[i].textContent;
                    dimensionesSelect.appendChild(option);
                }
            }
        }
    };
    peticion.send();
}

// Obtener el precio cuando se seleccionen marca y dimensiones
function obtenerPrecio() {
    let marca = document.getElementById("marca").value;
    let dimensiones = document.getElementById("dimensiones").value;
    
    if (marca && dimensiones) {
        let cadenaXML = `<datos><DatosTelevisores><marca>${marca}</marca><dimensiones>${dimensiones}</dimensiones></DatosTelevisores></datos>`;

        let peticion = new XMLHttpRequest();
        if (window.XMLHttpRequest){ 
            peticion = new XMLHttpRequest(); 
        }else if (window.ActiveXObject){ 
            peticion = new ActiveXObject("Microsoft.XMLHTTP"); 
        }

        peticion.open("POST", "php/ej5b.php", true);

        peticion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        peticion.onreadystatechange = function() {
            if (peticion.readyState === 4 && peticion.status === 200) {
                let respuestaXML = peticion.responseXML;
                if (respuestaXML) {
                    let precio = respuestaXML.getElementsByTagName("precio")[0].textContent;
                    document.getElementById("precio").value = precio;
                }
            }
        };

        peticion.send(cadenaXML);
    } else {
        document.getElementById("precio").value = "";
    }
}
