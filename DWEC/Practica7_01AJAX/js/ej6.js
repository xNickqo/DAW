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

    let peticion = new XMLHttpRequest();
    if (window.XMLHttpRequest){ 
        peticion = new XMLHttpRequest(); 
    }else if (window.ActiveXObject){ 
        peticion = new ActiveXObject("Microsoft.XMLHTTP"); 
    }

    peticion.open("GET", "php/ej6a.php", true);
    
    peticion.onreadystatechange = function() {
        if (peticion.readyState === 4 && peticion.status === 200) {

            let data = JSON.parse(peticion.responseText);
            
            let marcaSelect = document.getElementById("marca");
            data.marcas.forEach(function (marca) {
                let option = document.createElement("option");
                option.value = marca;
                option.textContent = marca;
                marcaSelect.appendChild(option);
            });

            // Llenar el select de electrodomésticos
            let electrodomesticoSelect = document.getElementById("electrodomestico");
            data.electrodomesticos.forEach(function (electrodomestico) {
                let option = document.createElement("option");
                option.value = electrodomestico;
                option.textContent = electrodomestico;
                electrodomesticoSelect.appendChild(option);
            });
        }
    };
    peticion.send();
}

// Obtener el precio cuando se seleccionen marca y electrodomesticos
function obtener() {
    let marca = document.getElementById("marca").value;
    let electrodomestico = document.getElementById("electrodomestico").value;
    
    if (marca && electrodomestico) {

        let peticion = new XMLHttpRequest();
        if (window.XMLHttpRequest){ 
            peticion = new XMLHttpRequest(); 
        }else if (window.ActiveXObject){ 
            peticion = new ActiveXObject("Microsoft.XMLHTTP"); 
        }

        peticion.open("POST", "php/ej6b.php", true);

        peticion.setRequestHeader("Content-Type","application/json"); 

        peticion.onreadystatechange = function() {
            if (peticion.readyState === 4 && peticion.status === 200) {
                let respuestaJSON = JSON.parse(peticion.responseText);
                if (respuestaJSON) {
                    document.getElementById("altura").value = respuestaJSON.altura;
                    document.getElementById("fondo").value = respuestaJSON.fondo;
                    document.getElementById("ancho").value = respuestaJSON.ancho;
                }
            }
        };

        let datos = JSON.stringify({ marca: marca, electrodomestico: electrodomestico });
        peticion.send(datos);
    }
}
