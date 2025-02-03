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
    fetch("php/ej5a.php")
        .then(response => {
            if (!response.ok) 
                throw new Error("Error en la solicitud");
            return response.text();
        })
        .then(str => new window.DOMParser().parseFromString(str, "text/xml"))
        .then(respuestaXML => {
            if (respuestaXML) {
                let marcas = respuestaXML.getElementsByTagName("marca");
                let dimensiones = respuestaXML.getElementsByTagName("dimensiones");

                let marcaSelect = document.getElementById("marca");
                let dimensionesSelect = document.getElementById("dimensiones");

                // Limpiar opciones previas
                marcaSelect.innerHTML = '<option value="">Seleccione una marca</option>';
                dimensionesSelect.innerHTML = '<option value="">Seleccione dimensiones</option>';

                // Llenar el select de marcas
                for (let i = 0; i < marcas.length; i++) {
                    let option = document.createElement("option");
                    option.value = marcas[i].textContent;
                    option.textContent = marcas[i].textContent;
                    marcaSelect.appendChild(option);
                }

                // Llenar el select de dimensiones
                for (let i = 0; i < dimensiones.length; i++) {
                    let option = document.createElement("option");
                    option.value = dimensiones[i].textContent;
                    option.textContent = dimensiones[i].textContent;
                    dimensionesSelect.appendChild(option);
                }
            }
        })
        .catch(error => console.error("Error en la petición:", error));
}

function obtenerPrecio() {
    let marca = document.getElementById("marca").value;
    let dimensiones = document.getElementById("dimensiones").value;

    if (marca && dimensiones) {
        let cadenaXML = `<datos><DatosTelevisores><marca>${marca}</marca><dimensiones>${dimensiones}</dimensiones></DatosTelevisores></datos>`;

        fetch("php/ej5b.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: cadenaXML,
        })
        .then(response => {
            if (!response.ok) 
                throw new Error("Error en la solicitud");
            return response.text();
        })
        .then(str => new window.DOMParser().parseFromString(str, "text/xml"))
        .then(respuestaXML => {
            if (respuestaXML) {
                let precio = respuestaXML.getElementsByTagName("precio")[0]?.textContent || "";
                document.getElementById("precio").value = precio;
            }
        })
        .catch(error => console.error("Error en la petición:", error));
    } else {
        document.getElementById("precio").value = "";
    }
}