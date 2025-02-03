if (document.addEventListener)
	window.addEventListener("load",inicio);
else if (document.attachEvent)
	window.attachEvent("onload",inicio);

function inicio() {
	console.log('Script cargado');
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

			let inicial = {  
				headers: {"Content-Type": "application/x-www-form-urlencoded"}, 
			};

			console.log(archivo);

			fetch(archivo, inicial)
				.then(function(respuesta) {
					if (respuesta.ok)
						return respuesta.text();
				})
				.then(function(texto) {
					contenido.innerHTML = texto;
				})
				.catch(function(error) {
					console.error("Error en la petición: ", error);
				});
		});
	}
}
