if (document.addEventListener)
	window.addEventListener("load",inicio)
else if (document.attachEvent)
	window.attachEvent("onload",inicio);
	
	
function inicio(){
	let boton=document.getElementById("crear");
	if (document.addEventListener)
		boton.addEventListener("click", creacion)
	else if (document.attachEvent)
		boton.attachEvent("onclick", creacion);
}

function creacion(){
	let valorCaja=document.getElementById("pais").value.trim();
	if (valorCaja.length > 0) {
		let lista=document.getElementById("paises");
		let todos=lista.getElementsByTagName("li");
		let inexistente=true;
		let indice=0;
		while (inexistente && indice < todos.length){
			if (todos.item(indice).textContent == valorCaja)
				inexistente=false
			else if (valorCaja < todos.item(indice).textContent){
				inexistente=false;
				let nuevo=document.createElement("li");
				let contenido=document.createTextNode(valorCaja);
				nuevo.appendChild(contenido);
				lista.insertBefore(nuevo, todos.item(indice));
				//todos.item(indice).before(nuevo);
			}
			indice+=1;
		}
		if (inexistente){
			let nuevo=document.createElement("li");
			let contenido=document.createTextNode(valorCaja);
			nuevo.appendChild(contenido);
			lista.append(nuevo);
		}
	}
}