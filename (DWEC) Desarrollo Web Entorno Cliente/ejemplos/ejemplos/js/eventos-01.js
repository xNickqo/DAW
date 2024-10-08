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

/*Validar un formulario
- validaciones exhaustivas. Mirar carácter a carácter
- validaciones con expresiones regulares
	- expreiones regulares directas
	- expreiones regulares del objeto RegExp*/


/*Caja de texto del nombre, empieza por 3 letras, termina por dos letras,
en medio puede tener letras, espacios y los caracteres º, ª, . y -, sabiendo
que su longitud está comprendida entre 7 y 28 caracteres.*/
function validarNombre(cadena) {
	let valido=true;
	let laCadena= cadena.trim().toLowerCase();
	if (laCadena.length < 7 || laCadena.length > 28)
		valido=false
	else
	{
		let indice=0;
		let otros="ñáéíóúü";
		while (valido && indice < 3)
		{
			if (laCadena.at(indice) < "a" || laCadena.at(indice) > "z")
				if (! otros.includes(laCadena.at(indice)))
					valido=false;
			indice+=1;
		}
		
		indice=laCadena.length -2;
		while (valido && indice < laCadena.length)
		{
			if (laCadena.at(indice) < "a" || laCadena.at(indice) > "z")
				if (! otros.includes(laCadena.at(indice)))
					valido=false;
			indice+=1;
		}
		
		indice=3;
		let mas="·-ºª ";
		while (valido && indice < laCadena.length -2 )
		{
			if (laCadena.at(indice) < "a" || laCadena.at(indice) > "z")
				if (! otros.includes(laCadena.at(indice)))
					if (! mas.includes(laCadena.at(indice)))
						valido=false;
			indice+=1;
		}
	}
	return valido;
}

/*Caja de texto de la localidad, empieza por letra, termina por letra,
en medio puede tener letras, espacios y los caracteres º, ª, ., / , "," y -, sabiendo
que su longitud está comprendida entre 5 y 35 caracteres.	*/
function validarLocalidad(cadena)
{
	let valido=true;
	let laCadena= cadena.trim().toLowerCase();
	if (laCadena.length < 5 || laCadena.length > 35)
		valido=false
	else
	{
		let indice=0;
		let otros="ñáéíóúü";
		if (laCadena.at(indice) < "a" || laCadena.at(indice) > "z")
			if (! otros.includes(laCadena.at(indice)))
				valido=false;
					
		indice=laCadena.length - 1;
		if (laCadena.at(indice) < "a" || laCadena.at(indice) > "z")
			if (! otros.includes(laCadena.at(indice)))
				valido=false;
	
		indice=1;
		let mas="·-ºª ,/";
		while (valido && indice < laCadena.length -1 )
		{
			if (laCadena.at(indice) < "a" || laCadena.at(indice) > "z")
				if (! otros.includes(laCadena.at(indice)))
					if (! mas.includes(laCadena.at(indice)))
						valido=false;
			indice+=1;
		}
	}
	return valido;
}
	
/*Caja de texto del código empieza por cuatro letras, le siguen 3 dígitos, luego 1 
caracter que puede ser "\", "|", "#", continua con cinco caracteres que pueden ser
letras o dígitos, le siguen tres caracteres que pueden tomar los valores "RAM", "3WC",
"URT", "URI" y termina con dos caracteres que pueden ser letras o dígitos.*/

function validarCodigo(cadena) {
	let valido = true;
	let laCadena = cadena.trim().toLowerCase();
	if (laCadena.length != 18)
		valido = false;
	else {
		let indice = 0;
		let otros = "ñáéíóúü";
		while (valido && indice < 4) {
			if (laCadena.at(indice) < "a" || laCadena.at(indice) > "z")
				if (!otros.includes(laCadena.at(indice)))
					valido = false;
			indice += 1;
		}
		indice = 4;
		while (valido && indice < 7) {
			if (laCadena.at(indice) < "0" || laCadena.at(indice) > "9")
				valido = false;
			indice += 1;
		}
		indice = 7;
		let masCar = "\\|#";
		if (!masCar.includes(laCadena.at(indice)))
			valido = false;
		indice = 8;
		while (valido && indice < 13) {
			if (laCadena.at(indice) < "a" || laCadena.at(indice) > "z")
				if (!otros.includes(laCadena.at(indice)))
					if (laCadena.at(indice) < "0" || laCadena.at(indice) > "9")
						valido = false;
			indice += 1;
		}
		indice = 13;
		let subCad = laCadena.substr(indice, 3);
		let losValores = ["ram", "3wc", "urt", "uri"];
		if (!losValores.includes(subCad))
			valido = false;
		indice = 16;
		while (valido && indice < laCadena.length) {
			if (laCadena.at(indice) < "a" || laCadena.at(indice) > "z")
				if (!otros.includes(laCadena.at(indice)))
					if (laCadena.at(indice) < "0" || laCadena.at(indice) > "9")
						valido = false;
			indice += 1;
		}
	}
	return valido;
}
	
function validarFormulario()
{
	const nombre = document.formu.nombre.value;
	const localidad = document.formu.localidad.value;
	const codigo = document.formu.codigo.value;

	const esNombreValido = validarNombre(nombre);
	const esLocalidadValida = validarLocalidad(localidad);
	const esCodigoValido = validarCodigo(codigo);

	if (esNombreValido && esLocalidadValida && esCodigoValido)
	{
		alert("Todos los campos son válidos.");
	}
	else
	{
		let mensaje = "Errores en:\n";
		if (!esNombreValido) mensaje += "- Nombre\n";
		if (!esLocalidadValida) mensaje += "- Localidad\n";
		if (!esCodigoValido) mensaje += "- Código\n";
		alert(mensaje);
	}
}
	
