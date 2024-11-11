if (document.addEventListener)
	window.addEventListener("load",inicio);
else if (document.attachEvent)
	window.attachEvent("onload",inicio);


function inicio() {
    //Registrar cookie
    document.getElementById("aceptar").addEventListener("click", registro);
    document.getElementById("registro").addEventListener("click", mostrarFormularioRegistro);
    document.getElementById("cancelar").addEventListener("click", ocultarFormularioRegistro);
    
    //Entrar con cookie existente
    document.getElementById("entrar").addEventListener("click", mostrarFormularioInicio);
    document.getElementById("iniciar").addEventListener("click", entrar);
    document.getElementById("borrar").addEventListener("click", ocultarFormularioInicio);


    //Definiciones
	let botonDef=document.getElementById("crearDef");
	if (document.addEventListener)
		botonDef.addEventListener("click", crearDefiniciones);
	else if (document.attachEvent)
		botonDef.attachEvent("onclick", crearDefiniciones);

    //Localidades
    let botonLoc = document.getElementById("crearLoc");
    if (document.addEventListener)
		botonLoc.addEventListener("click", crearLocalidades);
	else if (document.attachEvent)
		botonLoc.attachEvent("onclick", crearLocalidades);

    //Coches
    let botonCoche = document.getElementById("crearCoche");
    if (document.addEventListener)
		botonCoche.addEventListener("click", crearTablaCoches);
	else if (document.attachEvent)
		botonCoche.attachEvent("onclick", crearTablaCoches);

    //Comunidades autonomas
    let comunidadSelect = document.getElementById("comun");
    let provinciasSelect = document.getElementById("provincias");
    comunidadSelect.addEventListener("change", actualizarProvincias);
    provinciasSelect.addEventListener("change", mostrarComentario);

    // Mostrar el formulario de mensaje cuando se hace clic en "Añadir mensaje"
    document.getElementById("boton").addEventListener("click", mostrarFormularioMensaje);
    document.getElementById("aceptarMensaje").addEventListener("click", agregarMensaje);
    document.getElementById("cancelarMensaje").addEventListener("click", ocultarFormularioMensaje);
}

function mostrarFormularioRegistro() {
    document.getElementById("formRegistro").setAttribute("open","true");
}

function ocultarFormularioRegistro() {
    document.getElementById("formRegistro").removeAttribute("open");
}

function mostrarFormularioInicio() {
    document.getElementById("formInicio").setAttribute("open","true");
}

function ocultarFormularioInicio() {
    document.getElementById("formInicio").removeAttribute("open");
}

function mostrarFormularioMensaje() {
    document.getElementById("formularioMensaje").style.display = "block";
}

function ocultarFormularioMensaje() {
    document.getElementById("formularioMensaje").style.display = "none";
}

function existeCookie(nombre, contrasena){
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
    let nombre = document.getElementById("nombreUsuario").value.trim();
    let contrasena = document.getElementById("contrasena").value.trim();
    
    // Expresiones regulares para validar nombre y contraseña
    let regexNombre = /^[a-z]{3}[a-z0-9]{5,9}$/i;
    let regexContrasena = /^[a-z]{2}[a-z0-9_]{5,11}[a-z0-9]$/i;

    if(!existeCookie(nombre, contrasena)) {
        if ((regexNombre.test(nombre)) && (regexContrasena.test(contrasena))) {
            // Crear cookie
            document.cookie = `${nombre}=${contrasena}; expires=true 31 Dec 2024 00:00:00 GMT;`;
            alert("Cookie creada con exito");
            ocultarFormularioRegistro();
        } else {
            alert("Error nombre o contraseña");
        }
    } else {
        alert ("La cookie ya existe, no puedes registrarla de nuevo");
    }
}

//Funcion para validar si la cookie existe y usarla
function entrar(){
    let nombre = document.getElementById("nom").value.trim();
    let contrasena = document.getElementById("pas").value.trim();

    //Verificar si la cookie existe
    let misCookies = document.cookie.split(";");
    console.log("Todas las cookies:\n"+document.cookie);

    let existe = false;
    let i = 0;
    while (existe === false && (i < misCookies.length ))
    {
        let parte = misCookies[i].split("="); 
        if (parte[0] === nombre && parte[1] === contrasena)
        {
            alert("Tu cookie existe y sigue activa");
            existe = true;
            document.getElementById("user").textContent = nombre;
            document.getElementById("entrar").value = "Cerrar sesion";
            document.getElementById("entrar").removeEventListener("click", mostrarFormularioInicio);
            document.getElementById("entrar").addEventListener("click", cerrarSesion);
            ocultarFormularioInicio();

            //Mostrar el boton de "añadir mensaje"
            document.getElementById("boton").style.display = "block";
        }
        i++;
    }
    if(existe === false) {
        alert("La cookie no existe");
    }
}

// Función para cerrar sesión
function cerrarSesion() {
    document.getElementById("user").textContent = "USUARIO";
    document.getElementById("entrar").value = "Entrar";
    
    // Eliminar el listener de "Cerrar sesión"
    document.getElementById("entrar").removeEventListener("click", cerrarSesion);
    
    ocultarFormularioInicio();
    
    // Reasignar el evento para abrir el formulario de inicio de sesión
    document.getElementById("entrar").addEventListener("click", mostrarFormularioInicio);
}

function crearDefiniciones() {	
    let palabra = document.getElementById("palabra").value.trim();
    let concepto = document.getElementById("concepto").value.trim();

    if (palabra.length > 0 && concepto.length > 0)
    {
        //Obtenemos la lista por su ID
		let listaDef = document.getElementById("listaDef");

        let todos = document.getElementsByTagName("dt");
        let palabraExistente = null;
        let i = 0;
        while(i < todos.length)
        {
            if(todos.item(i).textContent === palabra)
            {
                palabraExistente = todos[i];
                break ;
            }
            i++;
        }

        // Si la palabra ya existe, solo agregamos una nueva definición debajo de ella
        if (palabraExistente)
        {
            let nuevoDD = document.createElement("dd");
            let contenidoConcepto = document.createTextNode(concepto);
            nuevoDD.appendChild(contenidoConcepto);

            //Añadimos el dd debajo del dt existente
            palabraExistente.parentNode.appendChild(nuevoDD);
        }
        // Si la palabra no existe, creamos un nuevo <dt> y <dd>
        else
        {
            //Creamos los elementos que vamos a introducir dentro del dl
            let nuevoDT = document.createElement("dt");
            let nuevoDD = document.createElement("dd");

            //Capturamos el contenido de los inputs en un textNode
            let contenidoPalabra = document.createTextNode(palabra);
            let contenidoConcepto = document.createTextNode(concepto);

            //Añadimos el textNode como hijo de los elementos creados anteriormente
            nuevoDT.appendChild(contenidoPalabra);
            nuevoDD.appendChild(contenidoConcepto);

            //Añadimos los contenidos a la lista
            listaDef.append(nuevoDT);
            listaDef.append(nuevoDD);
        }
	}
    else
        alert("Ambos campos, palabra y concepto deben tener contenido");
}

function crearLocalidades() {
    let loc = document.getElementById("loc").value.trim();
    let listaLoc = document.getElementById("listaLoc");

    if (loc.length > 0) {
        // Convertir todos los elementos <li> a un array
        let lista = Array.from(listaLoc.getElementsByTagName("li"));
        
        // Suscar si la loc ya existe
        if (loc === lista.some(item => item.textContent)) {
            alert("La loc que has introducido ya existe");
            return;
        }

        // Crear el nuevo elemento de lista con el nombre de la loc
        let nuevoLI = document.createElement("li");
        nuevoLI.textContent = loc;

        // Insertar en la posición correcta para mantener el orden alfabético
        let inserted = false;
        let i = 0
        while (i < lista.length) {
            // Si la loc es alfabéticamente menor que el actual, insertarla antes de ese elemento
            if (loc < lista[i].textContent) {
                listaLoc.insertBefore(nuevoLI, lista[i]);
                inserted = true;
                break;
            }
        }

        // Si no se insertó, significa que la loc es la mayor y va al final
        if (!inserted) {
            listaLoc.appendChild(nuevoLI);
        }
    } else {
        alert("Falta el contenido de localidades");
    }
}

function crearTablaCoches() {
    let marca = document.getElementById("marca").value.trim();
    let modelo = document.getElementById("modelo").value.trim();
    let precio = document.getElementById("precio").value.trim();

    let tablaCoches = document.getElementById("tablaCoches");
    let padre = tablaCoches.querySelector("tbody");
    let filas = padre.getElementsByTagName("tr");

    if (marca && modelo && precio) {
        let existe = false;
        let i = 1; // Ignoramos el encabezado de la tabla
        while (i < filas.length) {
            let celdas = filas.item(i).getElementsByTagName("td");

            let marcaExistente = celdas[0].textContent;
            let modeloExistente = celdas[1].textContent;

            // Si la marca y modelo ya existen, actualizamos el precio
            if (marcaExistente === marca && modeloExistente === modelo) {
                celdas[2].textContent = precio;
                existe = true;
                break;
            }
            i++;
        }

        if (!existe) {
            let fila = document.createElement("tr");

            let col1 = document.createElement("td");
            let col2 = document.createElement("td");
            let col3 = document.createElement("td");

            let con1 = document.createTextNode(marca);
            let con2 = document.createTextNode(modelo);
            let con3 = document.createTextNode(precio);

            col1.appendChild(con1);
            col2.appendChild(con2);
            col3.appendChild(con3);

            fila.appendChild(col1);
            fila.appendChild(col2);
            fila.appendChild(col3);

            padre.appendChild(fila); 
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
    let comunidadSeleccionada = document.getElementById("comun").value;
    let provinciasSelect = document.getElementById("provincias");

    // Limpiar provincias actuales
    while (provinciasSelect.firstChild) {
        provinciasSelect.removeChild(provinciasSelect.firstChild);
    }

    if (comunidadSeleccionada) {
        // Obtener la lista de provincias de la comunidad seleccionada
        let provincias = comunidades[comunidadSeleccionada].provincias;

        // Agregar cada provincia al <select> de provincias
        let i = 0;
        while (i < provincias.length) {
            let option = document.createElement("option");
            option.value = provincias[i];
            option.textContent = provincias[i];
            provinciasSelect.appendChild(option);
            i++;
        }
    } 
}

// Función para mostrar el comentario si se selecciona una provincia
function mostrarComentario() {
    let comunidadSeleccionada = document.getElementById("comun").value;
    let provinciaSeleccionada = document.getElementById("provincias").value;
    let comentarioP = document.getElementById("coment");

    if (comunidadSeleccionada && provinciaSeleccionada) {
        comentarioP.textContent = comunidades[comunidadSeleccionada].comentario;
    }
}

function agregarMensaje() {
    let titulo = document.getElementById("titulo").value.trim();
    let comentario = document.getElementById("comentario").value.trim();
    let imagenSeleccionada = document.querySelector('input[name="imagen"]:checked');

    if (titulo === "" || comentario === "" || !imagenSeleccionada) {
        alert("Por favor, completa todos los campos.");
        return;
    }

    // Obtener la imagen seleccionada
    let imagenUrl = "";
    switch (imagenSeleccionada.value) {
        case "image1":
            imagenUrl = "image1.jpg";
            break;
        case "image2":
            imagenUrl = "image2.jpg";
            break;
        case "image3":
            imagenUrl = "image3.jpg";
            break;
        case "image4":
            imagenUrl = "image4.jpg";
            break;
        case "image5":
            imagenUrl = "image5.jpg";
            break;
        case "image6":
            imagenUrl = "image6.jpg";
            break;
    }

    // Crear el contenedor para el mensaje
    let chatDiv = document.getElementById("chat");

    let nuevoMensaje = document.createElement("div");
    nuevoMensaje.classList.add("mensaje");

    // Crear la imagen del usuario
    let imagenElemento = document.createElement("img");
    imagenElemento.src = imagenUrl;
    imagenElemento.alt = "Fallo Imagen";
    
    // Crear el nombre de usuario
    let nombreUsuario = document.createElement("strong");
    nombreUsuario.textContent = document.getElementById("user").textContent;

    // Crear el título del mensaje
    let mensajeTitulo = document.createElement("h4");
    mensajeTitulo.textContent = titulo;

    // Crear el comentario
    let mensajeComentario = document.createElement("p");
    mensajeComentario.textContent = comentario;

    // Añadir los elementos al contenedor del mensaje
    nuevoMensaje.appendChild(imagenElemento);
    nuevoMensaje.appendChild(nombreUsuario);
    nuevoMensaje.appendChild(mensajeTitulo);
    nuevoMensaje.appendChild(mensajeComentario);

    // Añadir el mensaje al chat
    chatDiv.appendChild(nuevoMensaje);

    // Ocultar el formulario
    ocultarFormularioMensaje();

    // Limpiar los campos del formulario
    document.getElementById("titulo").value = "";
    document.getElementById("comentario").value = "";
    document.querySelector('input[name="imagen"]:checked').checked = false;
}
