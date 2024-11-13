if (document.addEventListener)
	window.addEventListener("load",inicio)
else if (document.attachEvent)
	window.attachEvent("onload",inicio);
	
	
function inicio(){
	let boton=document.getElementById("crear");
	let boton2=document.getElementById("borrar");
	if (document.addEventListener) {
		boton.addEventListener("click", creacion)
		boton2.addEventListener("click", borrado)
	}else if (document.attachEvent){
		boton.attachEvent("onclick", creacion);
		boton2.addEventListener("click", borrado)
	}
}

function creacion(){
	let valorCaja=document.getElementById("pais").value.trim();
	if (valorCaja.length > 0) {
		let lista=document.getElementById("paises");
		let todos=lista.getElementsByTagName("option");
		let inexistente=true;
		let indice=0;
		while (inexistente && indice < todos.length){
			if (todos.item(indice).textContent == valorCaja)
				inexistente=false
			else if (valorCaja < todos.item(indice).textContent){
				inexistente=false;
				let nuevo=document.createElement("option");
				let contenido=document.createTextNode(valorCaja);
				nuevo.appendChild(contenido);
				lista.insertBefore(nuevo, todos.item(indice));
				//todos.item(indice).before(nuevo);
			}
			indice+=1;
		}
		if (inexistente){
			let nuevo=document.createElement("option");
			let contenido=document.createTextNode(valorCaja);
			nuevo.appendChild(contenido);
			lista.append(nuevo);
		}
	}
}

function borrado() {
	let lista=document.getElementById("paises");
	if (lista.children.length > 0) {
		for (i=lista.selectedOptions.length -1; i >=0; i--)
			lista.selectedOptions[i].remove()
	}
}
