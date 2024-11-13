window.onload=inicio;

function inicio(){
	document.formu.nombre.onkeypress=soloLetras;
	document.formu.apellidos.onkeypress=soloLetras;
	document.formu.localidad.onkeypress=soloLetras;
	document.formu.edad.onkeypress=soloDigitos;
	
	document.formu.nombre.onfocus=colorear;
	document.formu.apellidos.onfocus=colorear;
	document.formu.localidad.onfocus=colorear;
	document.formu.edad.onfocus=colorear;
	
	document.formu.nombre.onblur=decolorear;
	document.formu.apellidos.onblur=decolorear;
	document.formu.localidad.onblur=decolorear;
	document.formu.edad.onblur=decolorear;
	
}
	
	
function soloLetras(evento){
	let elevento = evento || window.event;
	let enviar=true;
	let tecla=String.fromCharCode(elevento.keyCode).toLowerCase();
	let otros=new Array("ñ","á","é","í","ó","ú","ü"," ");
	let otros01=["ñ","á","é","í","ó","ú","ü"," "];
	let otros02="ñáéíóúü ";
	if ( tecla <"a" || tecla>"z")
		if (! otros.includes(tecla))
			enviar=false;
	return enviar
}
	
	
function soloDigitos(evento){
	let elevento = evento || window.event;
	let enviar=true;
	let tecla=String.fromCharCode(elevento.keyCode).toLowerCase();
	if ( tecla <"0" || tecla>"9")
		enviar=false;
	return enviar
}

function colorear(evento) {
	let elevento = evento || window.event;
	elevento.target.style.backgroundColor="blue";
	elevento.target.style.color="white";
	elevento.target.value="";
}

function decolorear(evento) {
	let elevento = evento || window.event;
	elevento.target.style.backgroundColor="white";
	elevento.target.style.color="black";
}



