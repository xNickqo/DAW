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
    $.ajax({
        url: "php/ej5a.php",
        type: "GET",
        dataType: "xml",
        success: function (respuestaXML) {
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
        },
        error: function (xhr, status, error) {
            console.error("Error al cargar marcas y dimensiones:", error);
        }
    });

}

function obtenerPrecio() {
    let marca = document.getElementById("marca").value;
    let dimensiones = document.getElementById("dimensiones").value;

    if (marca && dimensiones) {
        let cadenaXML = `<datos><DatosTelevisores><marca>${marca}</marca><dimensiones>${dimensiones}</dimensiones></DatosTelevisores></datos>`;

        $.ajax({
            url: "php/ej5b.php",
            type: "POST",
            data: cadenaXML,
            contentType: "application/x-www-form-urlencoded",
            dataType: "xml",
            success: function (respuestaXML) {
                let precio = respuestaXML.getElementsByTagName("precio")[0]?.textContent || "";
                document.getElementById("precio").value = precio;
            },
            error: function (xhr, status, error) {
                console.error("Error al obtener precio:", error);
            }
        });
    } else {
        document.getElementById("precio").value = "";
    }
}