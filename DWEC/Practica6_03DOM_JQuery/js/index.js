$(document).ready(function () {
    inicio();
});

function inicio() {
    // Registrar cookie
    $("#aceptar").on("click",registro);
    $("#registro").on("click",mostrarFormularioRegistro);
    $("#cancelar").on("click",ocultarFormularioRegistro);

    // Entrar con cookie existente
    $("#entrar").on("click",mostrarFormularioInicio);
    $("#iniciar").on("click",entrar);
    $("#borrar").on("click",ocultarFormularioInicio);

    // Definiciones
    $("#crearDef").on("click",crearDefiniciones);
    $("#quitarDef").on("click",quitarDefiniciones);

    // Localidades
    $("#crearLoc").on("click",crearLocalidades);

    // Coches
    $("#crearCoche").on("click",crearTablaCoches);

    // Comunidades autónomas
    $("#comun").on("change", actualizarProvincias);
    $("#provincias").on("change", mostrarComentario);

    // Mostrar el formulario de mensaje
    $("#boton").on("click",mostrarFormularioMensaje);
    $("#aceptarMensaje").on("click",agregarMensaje);
    $("#cancelarMensaje").on("click",ocultarFormularioMensaje);
}

function mostrarFormularioRegistro() {
    $("#formRegistro").attr("open", true);
}

function ocultarFormularioRegistro() {
    $("#formRegistro").removeAttr("open");
}

function mostrarFormularioInicio() {
    $("#formInicio").attr("open", true);
}

function ocultarFormularioInicio() {
    $("#formInicio").removeAttr("open");
}

function mostrarFormularioMensaje() {
    $("#formularioMensaje").show();
}

function ocultarFormularioMensaje() {
    $("#formularioMensaje").hide();
}

function existeCookie(nombre, contrasena) {
    let misCookies = document.cookie.split("; ");
    let existe = false;
    let i = 0;
    while (existe === false && (i < misCookies.length)) {
        let parte = misCookies[i].split("="); 
        if (parte[0] === nombre && parte[1] === contrasena)
            existe = true;
        i++;
    }
    return existe;
}

// Función para validar y registrar al usuario
function registro() {
    let nombre = $("#nombreUsuario").val().trim();
    let contrasena = $("#contrasena").val().trim();
    
    // Expresiones regulares para validar nombre y contraseña
    let regexNombre = /^[a-z]{3}[a-z0-9]{5,9}$/i;
    let regexContrasena = /^[a-z]{2}[a-z0-9_]{5,11}[a-z0-9]$/i;

    if(!existeCookie(nombre, contrasena)) {
        if ((regexNombre.test(nombre)) && (regexContrasena.test(contrasena))) {
            // Crear cookie
            document.cookie = `${nombre}=${contrasena}; expires=Wed, 31 Dec 2025 00:00:00 GMT;`;
            alert("Cookie creada con exito");
            console.log("Cookies:\n" + document.cookie);
            ocultarFormularioRegistro();
        } else {
            alert("Error nombre o contraseña");
        }
    } else {
        alert ("La cookie ya existe, no puedes registrarla de nuevo");
    }
}

function entrar() {
    let nombre = $("#nom").val().trim();
    let contrasena = $("#pas").val().trim();

    let misCookies = document.cookie.split(";");
    console.log("Todas las cookies:\n" + document.cookie);

    let existe = false;
    let i = 0;
    while (!existe && i < misCookies.length) {

        let parte = misCookies[i].split("="); 

        if (parte[0].trim() === nombre && parte[1].trim() === contrasena) {
            alert("Tu cookie existe y sigue activa");
            existe = true;

            $("#user").text(nombre);
            $("#entrar").val("Cerrar sesion");

            // Eliminar el listener de "Mostrar formulario"
            $("#entrar").off("click", mostrarFormularioInicio);

            // Agregar el listener para "Cerrar sesión"
            $("#entrar").on("click", cerrarSesion);

            ocultarFormularioInicio();

            // Mostrar el botón de "añadir mensaje"
            $("#boton").show();
        }
        i++;
    }
    if (!existe)
        alert("La cookie no existe");
}

function cerrarSesion() {
    $("#user").text("USUARIO");
    $("#entrar").val("Entrar");

    // Eliminar el listener de "Cerrar sesión"
    $("#entrar").off("click", cerrarSesion);
    
    ocultarFormularioInicio();
    $("#boton").hide();
    
    // Reasignar el evento para abrir el formulario de inicio de sesión
    $("#entrar").on("click", mostrarFormularioInicio);
}

function crearDefiniciones() {	
    let palabra = $("#palabra").val().trim();
    let concepto = $("#concepto").val().trim();

    if (palabra.length > 0 && concepto.length > 0) {
        let $listaDef = $("#listaDef");
        let $todos = $("dt");
        let palabraExistente = null;
        let i = 0;
        while (i < $todos.length) {
            if ($($todos[i]).text() === palabra) {
                palabraExistente = $todos[i];
                break;
            }
            i++;
        }

        // Si la palabra ya existe, solo agregamos una nueva definición debajo de ella
        if (palabraExistente) {
            let $nuevoDD = $("<dd>").text(concepto);
            // Añadimos el dd debajo del dt existente
            $(palabraExistente).parent().append($nuevoDD);
        } else {
            // Si la palabra no existe, creamos un nuevo <dt> y <dd>

            // Creamos los elementos que vamos a introducir dentro del dl
            let $nuevoDT = $("<dt>").text(palabra);
            let $nuevoDD = $("<dd>").text(concepto);

            // Añadimos los contenidos a la lista
            $listaDef.append($nuevoDT);
            $listaDef.append($nuevoDD);
        }
	} else {
        alert("Ambos campos, palabra y concepto deben tener contenido");
    }
}

function quitarDefiniciones() {

}

function crearLocalidades() {
    let loc = $("#localidad").val();
    let $listaLoc = $("#listaLoc");

    if (loc.length === 0) {
        alert("Falta el contenido de localidades");
    } else {
        // Convertir todos los elementos <li> a un array
        let lista = $listaLoc.find("li").toArray();

        // Verificar si la localidad ya existe
        let localidadExiste = lista.some(item => $(item).text() === loc);
        if (localidadExiste) {
            alert("La loc que has introducido ya existe");
        } else {
            // Crear el nuevo elemento <li> con el nombre de la localidad
            let $nuevoLI = $("<li>").text(loc);
            let inserted = false;

            // Intentar insertar el nuevo <li> en la posición correcta para mantener el orden alfabético
            let i = 0;
            while (i < lista.length && !inserted) {
                if (loc < $(lista[i]).text()) {
                    // Insertar antes del elemento actual
                    $nuevoLI.insertBefore($(lista[i]));
                    inserted = true;
                }
                i++;
            }
            if (!inserted)
                $listaLoc.append($nuevoLI);
        }
    }
}

function crearTablaCoches() {
    let marca = $("#marca").val().trim();
    let modelo = $("#modelo").val().trim();
    let precio = $("#precio").val().trim();

    let $tablaCoches = $("#tablaCoches");
    let $padre = $tablaCoches.find("tbody");
    let $filas = $padre.find("tr");

    if (marca && modelo && precio) {
        let existe = false;
        let i = 1; // Ignoramos el encabezado de la tabla
        while (i < $filas.length) {
            let $celdas = $($filas[i]).find("td");

            let marcaExistente = $celdas.eq(0).text();
            let modeloExistente = $celdas.eq(1).text();

            // Si la marca y modelo ya existen, actualizamos el precio
            if (marcaExistente === marca && modeloExistente === modelo) {
                $celdas.eq(2).text(precio);
                existe = true;
                break;
            }
            i++;
        }

        if (!existe) {
            let $fila = $("<tr>");

            let $col1 = $("<td>").text(marca);
            let $col2 = $("<td>").text(modelo);
            let $col3 = $("<td>").text(precio);

            $fila.append($col1, $col2, $col3);
            $padre.append($fila);
        }
    } else {
        alert("Complete todos los campos [marca, modelo, precio]");
    }
}

let comunidades = {
    Asturias: {
        provincias: ["Oviedo", "Gijón", "Avilés", "Mieres", "Langreo"],
        comentario: "Asturias es una comunidad autónoma situada al norte de España, conocida por sus paisajes montañosos y su costa."
    },
    Andalucia: {
        provincias: ["Sevilla", "Málaga", "Granada", "Córdoba", "Almería", "Cádiz", "Huelva", "Jaén", "Málaga", "Cádiz"],
        comentario: "Andalucía es una de las regiones más grandes y pobladas de España, famosa por su cultura, gastronomía y el flamenco."
    },
    Aragon: {
        provincias: ["Zaragoza", "Huesca", "Teruel"],
        comentario: "Aragón es una comunidad autónoma situada en el noreste de España, famosa por sus paisajes montañosos y el Pilar en Zaragoza."
    },
    Baleares: {
        provincias: ["Palma de Mallorca", "Ibiza", "Menorca", "Formentera"],
        comentario: "Las Islas Baleares son una comunidad autónoma que se encuentra en el mar Mediterráneo, conocida por sus hermosas playas y turismo."
    },
    Canarias: {
        provincias: ["Las Palmas", "Santa Cruz de Tenerife"],
        comentario: "Las Islas Canarias son un archipiélago en el océano Atlántico, con un clima subtropical y paisajes volcánicos únicos."
    },
    Cantabria: {
        provincias: ["Santander", "Torrelavega", "Castro Urdiales", "Colindres"],
        comentario: "Cantabria es una comunidad autónoma ubicada al norte de España, famosa por su costa y las cuevas de Altamira."
    },
    CastillaLeon: {
        provincias: ["Ávila", "Burgos", "León", "Palencia", "Salamanca", "Segovia", "Soria", "Valladolid", "Zamora"],
        comentario: "Castilla y León es la comunidad autónoma más grande de España y se caracteriza por su historia medieval y su patrimonio cultural."
    },
    CastillaLaMancha: {
        provincias: ["Albacete", "Ciudad Real", "Cuenca", "Guadalajara", "Toledo"],
        comentario: "Castilla-La Mancha es una comunidad autónoma en el centro de España, famosa por sus llanuras, molinos de viento y el legado de Don Quijote."
    },
    Cataluña: {
        provincias: ["Barcelona", "Girona", "Lleida", "Tarragona"],
        comentario: "Cataluña es una comunidad autónoma en el noreste de España, conocida por su arquitectura modernista, el arte de Gaudí y la Costa Brava."
    },
    Valencia: {
        provincias: ["Valencia", "Alicante", "Castellón"],
        comentario: "La Comunidad Valenciana es famosa por sus playas, la Ciudad de las Artes y las Ciencias en Valencia y la fiesta de las Fallas."
    },
    Extremadura: {
        provincias: ["Badajoz", "Cáceres"],
        comentario: "Extremadura es una comunidad autónoma en el suroeste de España, conocida por sus paisajes naturales, monumentos romanos y su gastronomía."
    },
    Galicia: {
        provincias: ["A Coruña", "Lugo", "Ourense", "Pontevedra"],
        comentario: "Galicia está en el noroeste de España, famosa por su costa atlántica, el Camino de Santiago y sus platos como el pulpo a la gallega."
    },
    Madrid: {
        provincias: ["Madrid"],
        comentario: "Madrid es la capital de España, una ciudad vibrante conocida por sus museos, plazas, parques y vida nocturna."
    },
    Navarra: {
        provincias: ["Pamplona", "Tudela"],
        comentario: "Navarra es conocida por la fiesta de San Fermín y la famosa corrida de toros de Pamplona, además de sus montañas y paisajes naturales."
    },
    Murcia: {
        provincias: ["Murcia", "Cartagena"],
        comentario: "Murcia es una comunidad autónoma situada en el sureste de España, famosa por sus huertas y playas en la Costa Cálida."
    },
    PaisVasco: {
        provincias: ["Álava", "Bizkaia", "Gipuzkoa"],
        comentario: "El País Vasco es una comunidad autónoma en el norte de España, conocida por su cultura vasca, la gastronomía y el paisaje montañoso."
    },
    LaRioja: {
        provincias: ["Logroño"],
        comentario: "La Rioja es una comunidad autónoma famosa por sus vinos, la cultura del vino y sus bodegas en el valle del Ebro."
    },
    Ceuta: {
        provincias: ["Ceuta"],
        comentario: "Ceuta es una ciudad autónoma española ubicada en el norte de África, famosa por su posición estratégica y su puerto."
    },
    Melilla: {
        provincias: ["Melilla"],
        comentario: "Melilla es una ciudad autónoma española también situada en el norte de África, conocida por su arquitectura y su puerto comercial."
    }
};

function actualizarProvincias() {
    let comunidadSeleccionada = $("#comun").val();
    let $provinciasSelect = $("#provincias");

    // Limpiar provincias actuales
    $provinciasSelect.empty();

    if (comunidadSeleccionada) {
        // Obtener la lista de provincias de la comunidad seleccionada
        let provincias = comunidades[comunidadSeleccionada].provincias;

        // Agregar cada provincia al <select> de provincias
        let i = 0;
        while (i < provincias.length) {
            let $option = $("<option>").val(provincias[i]).text(provincias[i]);
            $provinciasSelect.append($option);
            i++;
        }
    } 
}

// Función para mostrar el comentario si se selecciona una provincia
function mostrarComentario() {
    let comunidadSeleccionada = $("#comun").val();
    let provinciaSeleccionada = $("#provincias").val();
    let $comentarioP = $("#coment");

    if (comunidadSeleccionada && provinciaSeleccionada) {
        $comentarioP.text(comunidades[comunidadSeleccionada].comentario);
    }
}

function agregarMensaje() {
    let titulo = $("#titulo").val().trim();
    let comentario = $("#comentario").val().trim();
    let imagenSeleccionada = $('input[name="imagen"]:checked');

    if (titulo === "" || comentario === "" || !imagenSeleccionada) {
        alert("Por favor, completa todos los campos.");
        return ;
    }

    // Obtener la imagen seleccionada
    let imagenUrl = "";
    switch (imagenSeleccionada.val()) {
        case "image1":
            imagenUrl = "img/image1.png";
            break;
        case "image2":
            imagenUrl = "img/image2.png";
            break;
        case "image3":
            imagenUrl = "img/image3.png";
            break;
        case "image4":
            imagenUrl = "img/image4.png";
            break;
        case "image5":
            imagenUrl = "img/image5.png";
            break;
        case "image6":
            imagenUrl = "img/image6.png";
            break;
    }

    // Crear el contenedor para el mensaje
    let $chatDiv = $("#chat");

    let $nuevoMensaje = $("<div>").addClass("mensaje");

    // Crear la imagen del usuario
    let $imagenElemento = $("<img>").attr("src", imagenUrl).attr("alt", "Fallo Imagen");
    
    // Crear el nombre de usuario
    let $nombreUsuario = $("<strong>").text($("#user").text());

    // Crear el título del mensaje
    let $mensajeTitulo = $("<h4>").text(titulo);

    // Crear el comentario
    let $mensajeComentario = $("<p>").text(comentario);

    // Añadir los elementos al contenedor del mensaje
    $nuevoMensaje.append($imagenElemento, $nombreUsuario, $mensajeTitulo, $mensajeComentario);

    // Añadir el mensaje al chat
    $chatDiv.append($nuevoMensaje);

    // Ocultar el formulario
    ocultarFormularioMensaje();

    // Limpiar los campos del formulario
    $("#titulo").val("");
    $("#comentario").val("");
    $('input[name="imagen"]:checked').prop("checked", false);
}
