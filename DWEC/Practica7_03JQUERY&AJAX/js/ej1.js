if (document.addEventListener)
	window.addEventListener("load",inicio);
else if (document.attachEvent)
	window.attachEvent("onload",inicio);

function inicio() {
	//console.log('Script cargado');
	let links = document.querySelectorAll("nav a");
    let contenido = document.getElementById("contenido");

	for (let i = 0; i < links.length; i++) {
		links[i].addEventListener("click", function(event) {
			event.preventDefault();
			let archivo;

			switch (this.id) {
				case "cantabria":
					archivo = "cantabria.txt";
					break;
				case "cordoba":
					archivo = "cordoba.txt";
					break;
				case "segovia":
					archivo = "segovia.html";
					break;
				case "sevilla":
					archivo = "sevilla.html";
					break;
			}

			console.log(archivo);

			$.ajax({
				url: archivo,
				type: "GET",
				data: null,
				async: true,
				cache: true,
				contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
				beforeSend: function(comienzo){
					console.log("Antes de cargar la peticion: ", comienzo);
				},
				success: function(respuesta){
					contenido.innerHTML = respuesta;
					console.log("Respuesta del servidor: ", respuesta);
				},
				error: function(xhr, status, error){
					console.error("Error en la peticion: ",error);
				},
				complete: function(fin){
					console.log("La peticion finalizo: ", fin);
				}
			});

		
		/*
			--GET--
			$.get(archivo, function(respuesta){
				contenido.innerHTML = respuesta;
			}, "text") //dataType: "text"
			.done(function(){
				console.log("2nd success");
			})
			.fail(function(error){
				console.log("Error: ", error);
			})
			.always(function(){
				console.log("Terminado");
			})
			.beforeSend(function(xhr){
				console.log("Antes de la solicitud ",xhr);
			})
			.complete(function(xhr, status){
				console.log("Solicitud completada: ", xhr);
				console.log("Estado: ",status);
			})
			.timeout(5000) //5segundos de tiempo de espera antes de mostrar error
			.cache(false) //No usar cache
			.async(true); //Asincrono


			--LOAD--
			$("#contenido").load(archivo, null, function(response, status, xhr){
					console.log("Peticion completada con .load");
					console.log("Respuesta: ", response);
					console.log("Status: ", status);
					console.log("XHR: ", xhr);
				}).beforeSend(function(xhr){
					console.log("Antes de la solicitud con .load", xhr);
				}).complete(function(xhr, status){
					console.log("La solicitud con .load se completó. Estado: ", status);
				})
				.timeout(5000)
				.cache(false)
				.async(true);
			
		*/
		
		});
		
	}
}
