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
		else {
			let indice=0;
			let otros="ñáéíóúü";
			while (valido && indice < 3){
				if (laCadena.at(indice) < "a" || laCadena.at(indice) > "z")
					if (! otros.includes(laCadena.at(indice)))
						valido=false;
				indice+=1;
			}
			
			indice=laCadena.length -2;
			while (valido && indice < laCadena.length){
				if (laCadena.at(indice) < "a" || laCadena.at(indice) > "z")
					if (! otros.includes(laCadena.at(indice)))
						valido=false;
				indice+=1;
			}
			
			indice=3;
			let mas="·-ºª ";
			while (valido && indice < laCadena.length -2 ){
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
	function validarLocalidad(cadena) {
		let valido=true;
		let laCadena= cadena.trim().toLowerCase();
		if (laCadena.length < 5 || laCadena.length > 35)
			valido=false
		else {
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
			while (valido && indice < laCadena.length -1 ){
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
	
	function validarCodigo(cadena){
		let valido=true;
		let laCadena= cadena.trim().toLowerCase();	
		if (laCadena.length != 18)
			valido = false
		else {
			let indice=0;
			let otros="ñáéíóúü";
			while (valido && indice < 4){
				if (laCadena.at(indice) < "a" || laCadena.at(indice) > "z")
					if (! otros.includes(laCadena.at(indice)))
						valido=false;
				indice+=1;
			}
			indice= 4;
			while (valido && indice < 7){
				if (laCadena.at(indice) < "0" || laCadena.at(indice) > "9")
					valido=false;
				indice+=1;
			}
			indice= 7;
			let masCar="\|#";
			if (!masCar.includes(laCadena.at(indice)))
				valido=false;
			indice=8;	
			while (valido && indice < 13{
				if (laCadena.at(indice) < "a" || laCadena.at(indice) > "z")
					if (! otros.includes(laCadena.at(indice)))
						if (laCadena.at(indice) < "0"|| laCadena.at(indice) > "9")
							valido=false;
				indice+=1;
			}	
			indice=13
			let subCad=laCadena.substr(indice, 3);
			let losValores=["RAM", "3WC","URT", "URI"];
			if (!losValores.includes(subCad))
				valido=false;
			indice=16;
			while (valido && indice < laCadena.length){
				if (laCadena.at(indice) < "a" || laCadena.at(indice) > "z")
					if (! otros.includes(laCadena.at(indice)))
						if (laCadena.at(indice) < "0"|| laCadena.at(indice) > "9")
							valido=false;
				indice+=1;
			}
		}
		return valido;
	}
		
	
	