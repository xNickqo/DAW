if (document.addEventListener) {
    window.addEventListener("load", inicio);
} else if (document.attachEvent) {
    window.attachEvent("onload", inicio);
}

function inicio() {
    let calcVelocidad = document.querySelector("#calcular");
    calcVelocidad.addEventListener("click", comprobarFilasTabla);
}

function comprobarFilasTabla(evento) {
    evento.preventDefault();

    let tableBody = document.querySelector("#tablaCoches tbody");
    let filas = tableBody.getElementsByTagName("tr");
    if (filas.length === 0) {
        alert("No hay coches en la tabla para calcular la velocidad.");
    } else {
        console.log("Hay filas en la tabla. Continuamos con el cálculo.");

        let xmlResult = "<resultado>";

        // Recorrer las filas de la tabla
        for (let i = 0; i < filas.length; i++) {
            let fila = filas[i];
            let celdas = fila.getElementsByTagName("td");

            // Obtener los datos de cada columna
            let coche = celdas[0].textContent;
            let velocidad = celdas[1].textContent;
            let aceleracion = celdas[2].textContent;
            let tiempo = celdas[3].textContent;

            // Generar el XML para esta fila
            xmlResult += `
                <vehiculos>
                    <coche>${coche}</coche>
                    <velocidad>${velocidad}</velocidad>
                    <aceleracion>${aceleracion}</aceleracion>
                    <tiempo>${tiempo}</tiempo>
                </vehiculos>
            `;
        }

        xmlResult += "</resultado>";

        tableBody.dataset.resultado = xmlResult;

        console.log(xmlResult);
        peticionFetch(xmlResult);
    }
}

function peticionFetch(data) {
    fetch('php/velocidad.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/xml',
        },
        body: data
    })
    .then(function (respuesta) {
        if (respuesta.ok) {
            return respuesta.text();
        } else {
            throw new Error('Error en la solicitud: ' + respuesta.statusText);
        }
    })
    .then(function (texto) {
        let parser = new DOMParser();
        let xmlDoc = parser.parseFromString(texto, "text/xml");

        let resultado = xmlDoc.getElementsByTagName("resultado")[0];
        let vehiculos = resultado.getElementsByTagName("vehiculos");

        let tableBody = document.querySelector("#tablaCoches tbody");
        for (let i = 0; i < vehiculos.length; i++) {
            let vehiculo = vehiculos[i];
            let coche = vehiculo.getElementsByTagName("coche")[0].textContent;
            let velfinal = vehiculo.getElementsByTagName("velfinal")[0].textContent;

            let filas = tableBody.getElementsByTagName("tr");
            for (let j = 0; j < filas.length; j++) {
                let celdas = filas[j].getElementsByTagName("td");
                let cocheTabla = celdas[0].textContent;

                if (coche === cocheTabla) {
                    celdas[4].textContent = velfinal;
                    break;
                }
            }
        }
    })
    .catch(function (error) {
        console.error("Error en la solicitud:", error);
    });
}

