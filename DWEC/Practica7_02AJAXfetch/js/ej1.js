if (document.addEventListener)
	window.addEventListener("load",inicio)
else if (document.attachEvent)
	window.attachEvent("onload",inicio);

function inicio(){
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

			fetch(archivo, inicial).then(function(respuesta){
				if(Response.ok)
					return respuesta.text;
			}).then(function(texto){
				contenido.textContent = texto;
			}).catch(function(error){
				console.error("Error en la peticion: ", error);
			});

		});
	}
}
