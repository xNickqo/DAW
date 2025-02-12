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
    $.ajax({
        url:"php/ej6a.php",
        type: "get",
        dataType:"json",
        success: function(data){
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
        },
        error: function(error){
            console.error("Error: ",error);
        }
    })

}

// Obtener el precio cuando se seleccionen marca y electrodomesticos
function obtener() {
    let marca = document.getElementById("marca").value;
    let electrodomestico = document.getElementById("electrodomestico").value;

    if (marca && electrodomestico) {
        let datos = JSON.stringify({ marca: marca, electrodomestico: electrodomestico });

        $.ajax({
            url:"php/ej6b.php",
            type:"post",
            dataType:"json",
            contentType:"application/json",
            data: datos,
            success: function (respuestaJSON) {
                document.getElementById("ancho").value = respuestaJSON.ancho || "";
                document.getElementById("altura").value = respuestaJSON.altura || "";
                document.getElementById("fondo").value = respuestaJSON.fondo || "";
            },
            error: function (xhr, status, error) {
                console.error("Error al obtener dimensiones:", error);
            }
        });
    }
}
