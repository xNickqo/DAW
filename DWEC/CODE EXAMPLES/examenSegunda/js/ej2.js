if (document.addEventListener)
	window.addEventListener("load",inicio)
else if (document.attachEvent)
	window.attachEvent("onload",inicio);
	
	
function inicio(){
	let loc=document.getElementById("localidad");
	if (document.addEventListener)
		loc.addEventListener("change", creacion)
	else if (document.attachEvent)
		loc.attachEvent("onchange", creacion);

	let boton = document.getElementById("borrar");
    boton.addEventListener("click", function(event) {
		console.log("Texto del botón: " + boton.textContent);
		event.preventDefault();
		console.log("¡Botón clickeado!");
        let paisSeleccionado = document.getElementById("paises").value;
        if (boton.value === "Borrar ") {
            borrar(paisSeleccionado);
        } else if (boton.value === "Añadir") {
            añadir(paisSeleccionado);
        }
    });
}

function creacion(){
	let localidadSelect = document.getElementById("localidad");
    let monumentosList = document.getElementById("monumetos");

	let localidadesMonumentos = {
		"Burgos": [
        "Arco de Santa María", "Monasterio de San Juan", "Puente de Santa María", "Arco de San Esteban", 
        "Solar del Cid", "Arco de Fernán González", "Antiguo Seminario Mayor", 
        "Monasterio de Santa María la Real de las Huelgas", "Catedral", "El Cid Campeador"
    ],
    "Córdoba": [
        "Mezquita-Catedral", "Alcázares de los Reyes Cristianos", "Medina Azahara", "Puente Romano", 
        "Caballerizas Reales", "Torre de la Calahorra", "Templo Romano", "Torre de la Malmuerta", 
        "Alminar de San Juan", "Mausoleos Romanos", "Capilla de San Bartolomé"
    ],
    "A Coruña": [
        "Torre de Hércules", "Obelisco Millenium", "Iglesia de las Capuchinas", "Castillo de San Antón", 
        "Convento de Santa Bárbara", "Convento de Santo Domingo", "Iglesia de San Jorge", 
        "Iglesia de San Nicolás", "Colegiata de Santa María", "Iglesia de Santiago"
    ],
    "León": [
        "Catedral", "Basílica de San Isidoro", "Casa de Botines", "Convento de las Concepciones", 
        "Cripta de Puerta Obispo", "Iglesia de los Padres Capuchinos", "Iglesia de Nuestra Señora del Camino", 
        "Iglesia de San Marcelo", "Iglesia de Santa Ana"
    ],
    "Mérida": [
        "Teatro Romano", "Templo de Diana", "Acueducto de los Milagros", "Puente romano sobre el Guadiana", 
        "Anfiteatro Romano", "Arco de Trajano", "Alcazaba árabe", "Basílica de Santa Eulalia", 
        "Foro romano", "Circo Romano", "Catedral de Santa María", "Puente romano sobre el Albarregas", 
        "Templo de Marte"
    ],
    "Salamanca": [
        "Catedral Nueva", "Catedral Vieja", "Fachada de la Universidad", "Casa de las Conchas", "La Clerencia", 
        "Convento de San Esteban", "Plaza Mayor", "Casa Lis"
    ],
    "Segovia": [
        "Alcázar", "Acueducto", "Catedral", "Real Casa de Moneda", "Casa de los Picos", "Iglesia de San Martín", 
        "Iglesia de la Santísima Trinidad", "Iglesia de San Esteban", "Iglesia de San Millán", 
        "Iglesia de la Vera Cruz", "Iglesia del Corpus Cristi", "Monasterio del Parral"
    ],
    "Sevilla": [
        "Giralda", "Torre del Oro", "Archivo de Indias", "Casa Pilatos", "Catedral", "Palacio de San Telmo", 
        "Hospital de la Caridad", "Parque de María Luisa", "Reales Alcázares", "Real Maestranza de Caballería", 
        "Plaza España", "Basílica de la Macarena", "Jardines de Murillo"
    ],
    "Zamora": [
        "Catedral", "Puente de Piedra", "Puerta del Obispo", "Puerta de Doña Urraca", "Muralla", 
        "Monasterio de la Carballeda", "Puerta de la Traición", "Molinos de Agua", "Castillo", "Palacio de los Monos"
    ]
	}

	monumentosList.textContent = '';

    let monumSel = [];

    for (let option of localidadSelect.selectedOptions) {
        let localidad = option.text;
        if (localidadesMonumentos[localidad]) {
            monumSel = monumSel.concat(localidadesMonumentos[localidad]);
        }
    }

    // Ordenar alfabéticamente
    monumSel.sort();

    monumSel.forEach(function(monumento) {
        let li = document.createElement('li');
        li.textContent = monumento;
        monumentosList.appendChild(li);
    });
}

function borrar(pais) {
    let regiones = {
		"España": 
		["Asturias", "Galicia", "Cantabria", "País Vasco", "Navarra", "Aragón", "Cataluña", "Castilla y León", "Madrid", "La Rioja", "Extremadura", "Castilla La Mancha", "Valencia", "Murcia", "Andalucía", "Canarias", "Baleares"],    
		"Alemania":
		["Baden-Wurtemberg", "Baviera", "Berlín", "Brandeburgo", "Bremen", "Hamburgo", "Hesse", "Mecklemburgo-Pomerania Occidental", "Baja Sajonia", "Renania del Norte-Westfalia", "Renania-Palatinado", "Sarre", "Sajonia", "Sajonia-Anhalt", "Schleswig-Holstein", "Turingia"],
		"Grecia":
		["Tracia", "Macedonian", "Tesalia", "Epiro", "Grecia Central", "Peloponeso", "Islas del Egeo", "Islas Jónicas", "Creta"],
		"Inglaterra":
		["Gran Londres (Greater London)", "Sudeste de Inglaterra (South East England)", "Sudoeste de Inglaterra (South West England)", "Midlands del Oeste (West Midlands)", "Noroeste de Inglaterra (North West England)", "Nordeste de Inglaterra (North East England)", "Yorkshire y Humber (Yorkshire and the Humber)", "Midlands Oriental (East Midlands)", "Inglaterra mega (East of England)"],
		"Portugal":
		["Algarve", "Alto Alentejo", "Baixo Alentejo", "Beira Alta", "BeiraBaixa", "Beira Litoral", "Douro Litoral", "Estremadura", "Minho", "Ribatejo", "Trás-os-Montes", "Alto Douro"],
		"Italia":
		["Abruzzo", "Basilicata", "Calabria", "Campania", "Cerdeña", "Emilia Romagna", "FriuliVeneziaGiulia", "Lazio", "Liguria", "Lombardia", "Marche", "Molise", "Piamonte", "Puglia", "Sicilia", "Toscana", "Trentino Alto Adige", "Umbria", "Veneto"],
		"Francia":
		["Alsacia", "Aquitania", "Auvernia", "Borgoña", "Bretaña", "Valle del Loira", "Champagne-Ardenas", "Córcega", "Franche-Comte", "Paris / Ile de France", "Languedoc - Roussillon", "Limousin", "Lorena", "Midi-Pyrénées", "Nord Pas-de-Calais", "Normandía", "País del Loira", "Picardía", "Poitou-Charentes", "Provenza-Alpes-Costa Azul", "Rhône-Alpes", "Riviera Costa Azul"]
	};

    let tabla = document.getElementById("regiones");
    let filas = tabla.getElementsByTagName("tr");
    let todasEliminadas = true;

    for (let fila of filas) {
        let celdas = fila.getElementsByTagName("td");
        for (let celda of celdas) {
            if (regiones[pais] && regiones[pais].includes(celda.textContent)) {
                celda.remove();
            }
        }
    }


    filas = tabla.getElementsByTagName("tr");
    for (let fila of filas) {
        let celdas = fila.getElementsByTagName("td");
        if (celdas.length > 0) {
            todasEliminadas = false;
        }
    }

    let boton = document.getElementById("borrar");
    if (todasEliminadas) {
        boton.value = "Añadir";
    }
}

function añadir(pais) {
    let regiones = {
		"España": 
		["Asturias", "Galicia", "Cantabria", "País Vasco", "Navarra", "Aragón", "Cataluña", "Castilla y León", "Madrid", "La Rioja", "Extremadura", "Castilla La Mancha", "Valencia", "Murcia", "Andalucía", "Canarias", "Baleares"],    
		"Alemania":
		["Baden-Wurtemberg", "Baviera", "Berlín", "Brandeburgo", "Bremen", "Hamburgo", "Hesse", "Mecklemburgo-Pomerania Occidental", "Baja Sajonia", "Renania del Norte-Westfalia", "Renania-Palatinado", "Sarre", "Sajonia", "Sajonia-Anhalt", "Schleswig-Holstein", "Turingia"],
		"Grecia":
		["Tracia", "Macedonian", "Tesalia", "Epiro", "Grecia Central", "Peloponeso", "Islas del Egeo", "Islas Jónicas", "Creta"],
		"Inglaterra":
		["Gran Londres (Greater London)", "Sudeste de Inglaterra (South East England)", "Sudoeste de Inglaterra (South West England)", "Midlands del Oeste (West Midlands)", "Noroeste de Inglaterra (North West England)", "Nordeste de Inglaterra (North East England)", "Yorkshire y Humber (Yorkshire and the Humber)", "Midlands Oriental (East Midlands)", "Inglaterra mega (East of England)"],
		"Portugal":
		["Algarve", "Alto Alentejo", "Baixo Alentejo", "Beira Alta", "BeiraBaixa", "Beira Litoral", "Douro Litoral", "Estremadura", "Minho", "Ribatejo", "Trás-os-Montes", "Alto Douro"],
		"Italia":
		["Abruzzo", "Basilicata", "Calabria", "Campania", "Cerdeña", "Emilia Romagna", "FriuliVeneziaGiulia", "Lazio", "Liguria", "Lombardia", "Marche", "Molise", "Piamonte", "Puglia", "Sicilia", "Toscana", "Trentino Alto Adige", "Umbria", "Veneto"],
		"Francia":
		["Alsacia", "Aquitania", "Auvernia", "Borgoña", "Bretaña", "Valle del Loira", "Champagne-Ardenas", "Córcega", "Franche-Comte", "Paris / Ile de France", "Languedoc - Roussillon", "Limousin", "Lorena", "Midi-Pyrénées", "Nord Pas-de-Calais", "Normandía", "País del Loira", "Picardía", "Poitou-Charentes", "Provenza-Alpes-Costa Azul", "Rhône-Alpes", "Riviera Costa Azul"]
	};

    let tabla = document.getElementById("regiones");
    let regionesPais = regiones[pais] || [];

    for (let region of regionesPais) {
        let fila = document.createElement("tr");
        let celda = document.createElement("td");
        celda.textContent = region;
        fila.appendChild(celda);
        tabla.appendChild(fila);
    }


    let boton = document.getElementById("borrar");
    boton.value = "Borrar ";
}