if (document.addEventListener)
	window.addEventListener("load",iniciar)
else if (document.attachEvent)
	window.attachEvent("onload",iniciar);


function iniciar(){
	inicio();
	let selmarca=document.getElementById("marca");
	let seldimen=document.getElementById("dimension");
	if (document.addEventListener){
		selmarca.addEventListener("change",tasar);
		seldimen.addEventListener("change",tasar);
	} else if (document.attachEvent){
		selmarca.attachEvent("onchange",tasar);
		seldimen.attachEvent("onchange",tasar);
	}
}

function inicio(){
	let conexion
	if (window.XMLHttpRequest)
		conexion=new XMLHttpRequest()
	else if (window.ActiveXObject)
		conexion=new ActiveXObject("Microsoft.XMLHTTP");
	if (document.addEventListener)
		conexion.addEventListener("readystatechange",cargar)
	else if (document.attachEvent)
		conexion.attachEvent("onreadystatechange",cargar);
	conexion.open("GET","php/practica-02-04-1.php");
	conexion.send(null);
}

function cargar(evento) {
	if (evento.target.readyState==4)
		if (evento.target.status==200){
			let datos=evento.target.responseXML;
			let mismarcas=datos.getElementsByTagName("marca");
			let padre=document.getElementById("marca");
			for (let i=0;i<mismarcas.length;i++){
				let opcion=document.createElement("option");
				let texto=document.createTextNode(mismarcas.item(i).textContent);
				opcion.appendChil(texto);
				padre.appendChild(opcion);
			}
			let misdim=datos.getElementsByTagName("medida");
			let madre=document.getElementById("dimensiones");
			for (let i=o;i < misdim.length;i++){
				let opcion=document.createElement("option");
				let texto=document.createTextNode(misdim.item(i).textContent);
				opcion.appendChil(texto);
				madre.appendChild(opcion);
			}	
		}		
}

function tasar(){
	let peticion
	if (window.XMLHttpRequest)
		peticion=new XMLHttpRequest()
	else if (window.ActiveXObject)
		peticion=new ActiveXObject("Microsoft.XMLHTTP");
	if (document.addEventListener)
		peticion.addEventListener("readystatechange",mostrarpre)
	else if (document.attachEvent)
		peticion.attachEvent("onreadystatechange",mostrarpre);
	peticion.open("GET","php/practica-02-04-2.php");
	peticion.send(null);
}


function mostrarpre(evento){
	if (evento.target.readyState==4)
		if (evento.target.status==200){
			let datos=evento.target.responseXML;
		}
}