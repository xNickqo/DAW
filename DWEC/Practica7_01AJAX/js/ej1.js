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

			let peticion = new XMLHttpRequest();

			if (window.XMLHttpRequest){ 
				peticion = new XMLHttpRequest(); 
			}else if (window.ActiveXObject){ 
				peticion = new ActiveXObject("Microsoft.XMLHTTP"); 
			}

			peticion.addEventListener("readystatechange", function(){
				console.log(peticion.readyState, peticion.status)
				if (peticion.readyState == 4 && peticion.status == 200){ 
					alert(peticion.responseText);
					contenido.innerHTML = peticion.responseText;
				} 
			});

			peticion.open("GET", archivo, true);

			peticion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

			peticion.send(null);
		});
	}
}
