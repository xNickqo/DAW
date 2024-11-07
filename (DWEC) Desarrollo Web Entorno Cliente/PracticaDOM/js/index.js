if (document.addEventListener)
	window.addEventListener("load",inicio);
else if (document.attachEvent)
	window.attachEvent("onload",inicio);


function inicio() {
	let botonDef=document.getElementById("crearDef");

	if (document.addEventListener)
		botonDef.addEventListener("click", crearDefiniciones);
	else if (document.attachEvent)
		botonDef.attachEvent("onclick", crearDefiniciones);

    let botonLoc = document.getElementById("crearLoc");

    if (document.addEventListener)
		botonLoc.addEventListener("click", crearLocalidades);
	else if (document.attachEvent)
		botonLoc.attachEvent("onclick", crearLocalidades);
}

/* Cuando se pulse el botón de “Añadir Definición” vamos a añadir los datos de las cajas
de texto a una lista de definición (ambas cajas de texto deben tener valor), que se encuentra a
continuación, en la cual la palabra es el término y el concepto es la definición. Si el término se
repite en la lista de definición entonces deberemos añadir ese nuevo concepto como una
nueva definición del término. */
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


/* Cuando se pulse el botón de “Añadir Localidad” vamos a añadir el dato de la caja de
texto (debe tener valor) a una lista no ordenada, los valores en la lista no ordenada deberán
aparecer ordenados alfabéticamente en modo ascendente y la localidad que se añade no debe
estar presente en la lista no ordenada. */
function crearLocalidades() {
    let localidad = document.getElementById("localidad").value.trim();
    let listaLoc = document.getElementById("listaLoc");

    if (localidad.length > 0)
    {
        let todos = document.getElementsByTagName("li");
        let localidadExistente = null;
        let i = 0;
        while(i < todos.length)
        {
            if(todos.item(i).textContent === localidad)
            {
                localidadExistente = todos[i];
                break ;
            }
            i++;
        }
        if (!localidadExistente)
        {
            let nuevoLI = document.createElement("li");
            let contenido= document.createTextNode(localidad);
            nuevoLI.appendChild(contenido);
            listaLoc.append(nuevoLI);
        }
        else
        {
            alert("La localidad que has introducido ya existe");
            return;
        }
    }
    else
    {
        alert("Falta el contenido de localidades");
    }
}