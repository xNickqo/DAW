if (document.addEventListener)
	window.addEventListener("load",inicio)
else if (document.attachEvent)
	window.attachEvent("onload",inicio);
	
	
function inicio(){
	let boton=document.getElementById("crear");
	//let boton2=document.getElementById("borrar");
	if (document.addEventListener) {
		boton.addEventListener("click", creacion)
		//boton2.addEventListener("click", borrado)
	}else if (document.attachEvent){
		boton.attachEvent("onclick", creacion);
		//boton2.addEventListener("click", borrado)
	}
}

function creacion(){
	let valorCaja=document.getElementById("pais").value.trim();
	let cajaValor=document.getElementById("capital").value.trim();
	if (valorCaja.length > 0 && cajaValor.length > 0) {
		let tabla=document.getElementById("paises");
		let padre=tabla.querySelector("tbody");
		let todos=padre.getElementsByTagName("tr");
		let indice=0;
		let inexis=true;
		while (inexis && indice < todos.length){
			let celdas=todos.item(indice).getElementsByTagName("td");
			if (celdas[0].textContent.toLowerCase() == valorCaja.toLowerCase() && 
				celdas[1].textContent.toLowerCase() == cajaValor.toLowerCase())
				inexis=false
			else if (celdas[0].textContent.toLowerCase() > valorCaja.toLowerCase()){
				inexis=false;
				let fila=document.createElement("tr");
				let col1=document.createElement("td");
				let col2=document.createElement("td");
				let con1=document.createTextNode(valorCaja);
				let con2=document.createTextNode(cajaValor);
				col1.append(con1);
				col2.append(con2);
				fila.appendChild(col1);
				fila.appendChild(col2);
				todos.item(indice).before(fila);
			} else if (celdas[0].textContent.toLowerCase() == valorCaja.toLowerCase() && 
					   celdas[1].textContent.toLowerCase() > valorCaja.toLowerCase()){
				inexis=false;
				let fila=document.createElement("tr");
				let col1=document.createElement("td");
				let col2=document.createElement("td");
				let con1=document.createTextNode(valorCaja);
				let con2=document.createTextNode(cajaValor);
				col1.append(con1);
				col2.append(con2);
				fila.appendChild(col1);
				fila.appendChild(col2);
				todos.item(indice).before(fila);
			}
			indice+=1;
		}
		if (inexis) {
			let fila=document.createElement("tr");
			let col1=document.createElement("td");
			let col2=document.createElement("td");
			let con1=document.createTextNode(valorCaja);
			let con2=document.createTextNode(cajaValor);
			col1.append(con1);
			col2.append(con2);
			fila.appendChild(col1);
			fila.appendChild(col2);
			padre.append(fila);
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
