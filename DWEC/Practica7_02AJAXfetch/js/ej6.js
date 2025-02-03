if (document.addEventListener) {
    window.addEventListener("load", inicio);
} else if (document.attachEvent) {
    window.attachEvent("onload", inicio);
}

function inicio() {

    cargar();

    if(document.addEventListener){
        document.getElementById("marca").addEventListener("change", obtener);
    }else if(document.attachEvent){
        document.getElementById("marca").addEventListener("change", obtener);
    }

    if(document.addEventListener){
        document.getElementById("electrodomestico").addEventListener("change", obtener);
    }else if(document.attachEvent){
        document.getElementById("electrodomestico").addEventListener("change", obtener);
    }
}

function cargar() {
    fetch("php/ej6a.php")
        .then(response => {
            if (!response.ok) throw new Error("Error en la solicitud");
            return response.json();
        })
        .then(data => {
            let marcaSelect = document.getElementById("marca");
            let electrodomesticoSelect = document.getElementById("electrodomestico");

            // Llenar el select de marcas
            data.marcas.forEach(marca => {
                let option = document.createElement("option");
                option.value = marca;
                option.textContent = marca;
                marcaSelect.appendChild(option);
            });

            // Llenar el select de electrodomésticos
            data.electrodomesticos.forEach(electrodomestico => {
                let option = document.createElement("option");
                option.value = electrodomestico;
                option.textContent = electrodomestico;
                electrodomesticoSelect.appendChild(option);
            });
        })
        .catch(error => console.error("Error en la petición:", error));
}

// Obtener el precio cuando se seleccionen marca y electrodomesticos
function obtener() {
    let marca = document.getElementById("marca").value;
    let electrodomestico = document.getElementById("electrodomestico").value;

    if (marca && electrodomestico) {
        let datos = JSON.stringify({ marca: marca, electrodomestico: electrodomestico });

        fetch("php/ej6b.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: datos,
        })
        .then(response => {
            if (!response.ok) throw new Error("Error en la solicitud");
            return response.json();
        })
        .then(respuestaJSON => {
            if (respuestaJSON) {
                document.getElementById("altura").value = respuestaJSON.altura || "";
                document.getElementById("fondo").value = respuestaJSON.fondo || "";
                document.getElementById("ancho").value = respuestaJSON.ancho || "";
            }
        })
        .catch(error => console.error("Error en la petición:", error));
    }
}
