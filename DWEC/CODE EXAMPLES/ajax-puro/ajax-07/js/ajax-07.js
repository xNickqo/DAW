if (document.addEventListener)
	window.addEventListener("load", inicio)
else if (document.attachEvent)
	window.attachEvent("onload", inicio);

function inicio(){
	let boton=document.getElementById("obtener");
	let botonEmple=document.getElementById("masTabla");
	if (document.addEventListener){
		boton.addEventListener("click", procesar);
		botonEmple.addEventListener("click", mas);
	} else if (document.attachEvent) {
		boton.attachEvent("onclick", procesar);
		botonEmple.attachEvent("onclick", mas);
	}
	
}

function mas(){
	let nom=document.getElementById("nombre").value.trim();
	let ape=document.getElementById("apellidos").value.trim();
	if (nom!="" && ape!=""){
		let tabla=document.getElementById("tableEmpleados");
		let padre=tabla.tBodies[0];
		let nuevaFila=document.createElement("tr");
		let nuevoNom=document.createElement("td");
		let nuevoApe=document.createElement("td");
		let nuevoSuel=document.createElement("td");
		let datoNom=document.createTextNode(nom);
		let datoApe=document.createTextNode(ape);
		let datoSuel=document.createTextNode("0");
		nuevoNom.append(datoNom);
		nuevoApe.append(datoApe);
		nuevoSuel.append(datoSuel);
		nuevaFila.append(nuevoNom);
		nuevaFila.append(nuevoApe);
		nuevaFila.append(nuevoSuel);
		padre.append(nuevaFila);
	}
}

function procesar(){
	
	let conexion;
	
	if (window.XMLHttpRequest)
		conexion = new XMLHttpRequest
	else if (window.ActiveXObject)
		conexion= new ActiveXObject("Microsoft.XMLHttp");
	
	if (document.addEventListener)
		conexion.addEventListener("readystatechange", recibido)
	else if (document.attachEvent)
		conexion.attachEvent("onreadystatechange", recibido);
	
	conexion.open("POST","php/ajax-07.php");
	conexion.setRequestHeader("Content-Type","application/json");
	
	let misDatos=new Array();
	let tabla=document.getElementById("tableEmpleados");
	let padre=tabla.tBodies[0];
	let filas=padre.rows;
	for (i =0 ; i< filas.length; i++){
		let columnas=filas.item(i).cells;
		let nom=columnas.item(0).textContent;
		let ape=columnas.item(1).textContent;
		let datos=new Object();
		datos.nombre=nom;
		datos.apellidos=ape;
		misDatos[i]=datos;
	}
	let objetosJSON=JSON.stringify(misDatos);
	conexion.send(objetosJSON);
}

function recibido(evento){
	if (evento.target.readyState==4)
		if (evento.target.status==200){
			let datos=evento.target.responseText;	
			let variosDatos=JSON.parse(datos);
			let tabla=document.getElementById("tableEmpleados");
			let padre=tabla.tBodies[0];
			let filas=padre.rows;
			for (let i=0; i < variosDatos.length; i++){
				let columas=filas.item(i).cells;
				columas.item(2).textContent=variosDatos[i].sueldo;
			}
		}
}
