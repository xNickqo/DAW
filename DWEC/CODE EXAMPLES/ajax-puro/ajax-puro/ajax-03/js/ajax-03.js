if (document.addEventListener)
	window.addEventListener("load", inicio)
else if (document.attachEvent)
	window.attachEvent("onload", inicio);

function inicio(){
	let boton=document.getElementById("obtener");
	if (document.addEventListener)
		boton.addEventListener("click", procesar)
	else if (document.attachEvent)
		boton.attachEvent("onclick", procesar);
}

function procesar(){
	let nom=document.getElementById("nombre").value.trim();
	let ape=document.getElementById("apellidos").value.trim();
	let conexion;
	
	if (window.XMLHttpRequest)
		conexion = new XMLHttpRequest
	else if (window.ActiveXObject)
		conexion= new ActiveXObject("Microsoft.XMLHttp");
	
	if (document.addEventListener)
		conexion.addEventListener("readystatechange", recibido)
	else if (document.attachEvent)
		conexion.attachEvent("onreadystatechange", recibido);
	
	conexion.open("POST","php/ajax-03.php");
	
	let datos = new FormData();
	datos.append("nombre",nom);
	datos.append("apellidos",ape);
	
	conexion.send(datos);
}

function recibido(evento){
	if (evento.target.readyState==4)
		if (evento.target.status==200)
			document.getElementById("sueldo").value=evento.target.responseText;	
}
