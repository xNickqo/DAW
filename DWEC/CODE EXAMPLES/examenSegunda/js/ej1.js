window.onload = inicio;

function inicio(){

    document.formulario.onsubmit = validaciones;

    document.formulario.minuni.onkeypress=soloDigitos;
    document.formulario.unidades.onkeypress=soloDigitos;

    document.formulario.codigo.onfocus=colorear;
    document.formulario.descripcion.onfocus=colorear;
    document.formulario.fecha.onfocus=colorear;
    document.formulario.empresa.onfocus=colorear;
    document.formulario.codempre.onfocus=colorear;
    document.formulario.direccion.onfocus=colorear;
    document.formulario.localidad.onfocus=colorear;
    document.formulario.familia.onfocus=colorear;
    document.formulario.transporte.onfocus=colorear;
    document.formulario.minuni.onfocus=colorear;
    document.formulario.unidades.onfocus=colorear;
    document.formulario.precio.onfocus=colorear;
	
	document.formulario.codigo.onblur=decolorear;
    document.formulario.descripcion.onblur=decolorear;
    document.formulario.fecha.onblur=decolorear;
    document.formulario.empresa.onblur=decolorear;
    document.formulario.codempre.onblur=decolorear;
    document.formulario.direccion.onblur=decolorear;
    document.formulario.localidad.onblur=decolorear;
    document.formulario.familia.onblur=decolorear;
    document.formulario.transporte.onblur=decolorear;
    document.formulario.minuni.onblur=decolorear;
    document.formulario.unidades.onblur=decolorear;
    document.formulario.precio.onblur=decolorear;

}

function soloDigitosPunto(evento){
	let event = evento || window.event;
	let enviar=true;
	let tecla=String.fromCharCode(event.keyCode).toLowerCase();
	if ( tecla <"0" || tecla>"9" || tecla=='.')
		enviar=false;
	return enviar
}

function soloDigitos(evento){
	let event = evento || window.event;
	let enviar=true;
	let tecla=String.fromCharCode(event.keyCode).toLowerCase();
	if ( tecla <"0" || tecla>"9")
		enviar=false;
	return enviar
}

function colorear(evento) {
	let event = evento || window.event;
	event.target.style.backgroundColor="red";
	event.target.style.color="yellow";
	event.target.value="";
}

function decolorear(evento) {
	let event = evento || window.event;
	event.target.style.backgroundColor="white";
	event.target.style.color="black";
}


// Verifica si el carácter es un dígito
function isDigit(caracter) {
    return caracter >= '0' && caracter <= '9';
}

// Verifica si el carácter es una letra
function isLetter(caracter) {
    return caracter >= 'A' && caracter <= 'Z';
}


function validaciones(event){
    event.preventDefault();
    let correcto = false;
    let error = "";

    let codigo = document.formulario.codigo.value;
    let expCod = new RegExp("^\\d{7}$|^\\d{11}$");
    if(!expCod.test(codigo)){
        error += "Codigo erroneo\n";
    }

    let descripcion = document.formulario.descripcion.value;
    let expDesc = new RegExp("^[a-záéíóúñö]{4}[a-záéíóúñö \-0-9]{5,18}[a-záéíóúñö]{1}$", "i");
    if(!expDesc.test(descripcion)){
        error += "Descripcion erronea\n";
    }

    let fecha = document.formulario.fecha.value;
    let expFec = new RegExp("^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/(\\d{4})$");
    if(!expFec.test(fecha)){
        error += "Fecha erronea\n";
    }

    let precio = document.formulario.precio.value.trim().toUpperCase();
    let res_precio = validarPrecio(precio);
    if (res_precio !== "")
        error += res_precio + "\n";
    let expPrec = new RegExp("^(?:1\\d|[2-9]\\d+)(\\.\\d{1,2})$");
    if(!expPrec.test(precio)){
        error += "precio erroneo\n";
    }

    let empresa = document.formulario.empresa.value.trim();
    let expEmp = /^[a-záéíóúñö]{3}[a-záéíóúñö \.]{6,21}[a-záéíóúñö0-9]{1}$/i;
    if(!expEmp.test(empresa)){
        error += "Empresa erronea\n";
    }

    let codempre = document.formulario.codempre.value.trim();
    let expCodEmp = /^\d{3}\.((ABCE)|(CADE)|(FEGU)|(IJOK)|(LIMA))\d{5,8}\.[a-záéíóúñö0-9]{5}$/i;
    if(!expCodEmp.test(codempre)){
        error += "codempre erronea\n";
    }

    let direccion = document.formulario.direccion.value.trim().toUpperCase();
    let expDir = /^[a-záéíóúñö]{2}[a-záéíóúñö0-9\.,\-ºª\\\\]{7,25}[a-záéíóúñö0-9\.]{1}$/i;
    if(!expDir.test(direccion)){
        error += "direccion erronea\n";
    }
    
    let localidad = document.formulario.localidad.value.trim();
    let expLoc = /^[a-záéíóúñö]{5,20}$/;
    if(!expLoc.test(localidad)){
        error += "localidad erronea\n";
    }

    let minuni = document.formulario.minuni.value.trim().toUpperCase();
    let res_minuni = validarMinUni(minuni);
    if (res_minuni !== "")
        error += res_minuni + "\n";

    let unidades = document.formulario.unidades.value.trim().toUpperCase();
    let res_unidades = validarUni(unidades);
    if (res_unidades !== "")
        error += res_unidades + "\n";

    let familia = document.formulario.familia.value.trim().toUpperCase();
    let res_familia = validarFam(familia);
    if (res_familia !== "")
        error += res_familia + "\n";

    let transporte = document.formulario.transporte.value.trim().toUpperCase();
    let res_transporte = validarTransporte(transporte);
    if (res_transporte !== "")
        error += res_transporte + "\n";

    let iva = document.formulario.iva;
    let res_iva = validarIVA(iva);
    if (res_iva !== "");
        error += res_iva + "\n";

    let sector = document.formulario.sector;
    let res_sector = validarSector(sector);
    if (res_sector !== "");
        error += res_iva + "\n";

    let paises = document.formulario.paises;
    let res_paises = validarPaises(paises);
    if (res_paises !== "");
        error += res_paises + "\n";
    
    

    if(error != ""){
        window.alert(error);
    } else {
        correcto = true;
        window.alert("Formulario enviado con exito");
    }
    return correcto;

}

//checkbox
function validarSector(sector) {
    let error = ""
    let seleccionado = false;
    let i = 0;

    while (i < sector.length){
        if (sector[i].checked){
            seleccionado = true;
        }
        i+=1;
    }

    if (!seleccionado)
        error += "Debes seleccionar al menos un sector.\n";

    return error;
}

//radio
function validarIVA(iva) {

    let i = 0;

    while (i < iva.length){
        if (iva[i].checked)
            return "";
        i+=1;
    }
    return "Debes seleccionar un IVA.\n";
}

//options
function validarPaises(paises) {

    let contador = 0;
    let i = 0;

    while (i < paises.options.length)
    {
        if (paises.options[i].selected)
            contador++;
        i++;
    }

    if (contador < 3)
        return "Debes seleccionar al menos tres paises.\n";

    return "";
}

function validarPrecio(precio){
    let error = "";

    let i = 0;
    let continuar = true;
    let contadorPunto = 0;
    while(i < precio.length){
        if(precio[i] === '.'){
            contadorPunto+=1;
        }
        i+=1;
    }
    if(contadorPunto !== 1){
        error += "Solo debe contener 1 punto";
    }

    i = 0;
    while(i < precio.length && continuar){
        if(!isDigit(precio[i]) && precio[i] !== '.'){
            error += "Solo deben ser digitos o punto";
            continuar = false;
        }
        i+=1;
    }

    return error;
}

function validarMinUni(min){
    let error = "";

    if(min.length <2 || min.length >4)
        error += "longitud erronea\n";

    if(min < 30)
        error += "Valor minimo 30\n"

    let i = 0;
    let continuar = true;
    while(i < min.length && continuar){
        if(!isDigit(min[i])){
            error += "Debe contener solo digitos\n";
            continuar = false;
        }
        i+=1;
    }

    return error;
}

function validarUni(uni){
    let error = "";

    if(uni.length <2 || uni.length >7)
        error += "longitud erronea\n";

    let i = 0;
    let continuar = true;
    while(i < uni.length && continuar){
        if(!isDigit(uni[i])){
            error += "Debe contener solo digitos\n";
            continuar = false;
        }
        i+=1;
    }

    return error;
}

function validarFam(fam){
    let error = "";

    if(fam.length <10 || fam.length >21)
        error += "longitud erronea\n";

    let i = 0;
    let continuar = true;
    while(i < 5 && continuar){
        if(!isLetter(fam[i])){
            error += "Debe contener solo letras\n";
            continuar = false;
        }
        i+=1;
    }

    while(i < fam.length-3 && continuar){
        if(!isLetter(fam[i]) && !isDigit(fam[i]) && fam[i] !== ' ' && fam[i] !== '-' && fam[i] !== '.' && fam[i] !== '|'){
            error += "Debe contener solo letras, digitos, ' ', '.', '-', '|'\n";
            continuar = false;
        }
        i+=1;
    }

    console.log("i: ", i);
    while(i < fam.length && continuar){
        if(!isLetter(fam[i])){
            error += "Debe contener solo letras\n";
            continuar = false;
        }
        i+=1;
    }

    return error;
}

function validarTransporte(trans){
    let error = "";

    let val = ["SEUR", "NACEX", "DHL", "MRW"];

    if(!val.includes(trans)){
        error += "Debe ser uno de estos valores SEUR, NACEX, DHL, MRW\n";
    }

    return error;
}
