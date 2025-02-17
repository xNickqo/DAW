window.onload = inicio;

function inicio(){
    let btn = document.miFormulario.submit;
    if(document.addEventListener){
        btn.addEventListener("click", validaciones);
    } else if(document.attachEvent){
        btn.attachEvent("click", validaciones);
    }
}

function validaciones(event){
    event.preventDefault();
    let correcto = false;
    let error = "";

    let nombre = document.miFormulario.nombre.value;
    let validacionNombre = validarNombre(nombre);
    validar(validacionNombre, error);

    let correo = document.miFormulario.correo.value;
    let validacionCorreo = validarCorreo(correo);
    error = validar(validacionCorreo, error);

    let tel = document.miFormulario.tel.value;
    let validacionTel = validarTel(tel);
    error = validar(validacionTel, error);

    let direccion = document.miFormulario.direccion.value;
    let validacionDireccion = validarDireccion(direccion);
    error = validar(validacionDireccion, error);

    let codigoPostal = document.miFormulario.codigoPostal.value;
    let validacionCodigoPostal = validarCodigoPostal(codigoPostal);
    error = validar(validacionCodigoPostal, error);

    let fechaNac = document.miFormulario.fechaNac.value;
    let validacionFechaNac = validarFechaNac(fechaNac);
    error = validar(validacionFechaNac, error);

    let url = document.miFormulario.url.value;
    let validacionURL = validarURL(url);
    error = validar(validacionURL, error);

    if(error == ''){
        correcto = true;
        window.alert("Formulario enviado correctamente sin errores");
    }else{
        window.alert(error);
    }

    return correcto;
}

function validar(validacion, error){
    if(validacion !== ""){
        error += validacion+"\n";
    }
    return error;
}

function isLetter(char){
    return ((char >= 'a' && char <= 'z') || (char >= 'A' && char <= 'z') );
}

function validarNombre(nombre){
    let error = "";

    if(nombre.length < 5 || nombre.length > 20)
        error += "Longitud erronea";

    if(nombre[0] >= 'A' && nombre[0] <= 'Z'){
        let i = 1;
        while(i < nombre.length){
            if(!isLetter(nombre[i]))
                error += "El nombre deben ser solo letras";
            i+=1;
        }
    } else {
        error += "El nombre no comienza por una letra mayuscula";
    }
    return error;
}

function validarCorreo(correo){
    let error = "";

    let split = correo.split('@');
    let usuario = split[0];
    let dominioCompleto = split[1];

    // Validar caracteres en el usuario
    let i = 0;
    let existe = true;
    while (existe && i < usuario.length) {
        if (!isLetter(usuario[i]) && isNaN(usuario[i]) && usuario[i] !== '.' && usuario[i] !== '-') {
            error += "Caracteres inválidos en el usuario.\n";
            existe = false;
        }
        i++;
    }

    // Validar que el dominio tenga al menos un '.'
    let dominio = "";
    let puntoEncontrado = false;

    i = 0;
    while (puntoEncontrado == false && i < dominioCompleto.length) {
        if (dominioCompleto[i] === '.') {
            dominio = dominioCompleto.slice(i);
            //console.log(dominio);
            puntoEncontrado = true;
        }
        i+=1;
    }

    if (!puntoEncontrado) {
        error += "El dominio debe contener al menos un '.'\n";
    } else {
        let dominiosPermitidos = [".com", ".net", ".es", ".org"];
        let dominioValido = false;

        for (let j = 0; j < dominiosPermitidos.length; j++) {
            if (dominio === dominiosPermitidos[j]) {
                dominioValido = true;
                break;
            }
        }

        if (!dominioValido) {
            error += "Dominio inválido. Debe ser .com, .net, .es o .org.\n";
        }
    }

    return error;
}

function validarTel(num){
    let error = "";


    //console.log(num.length);
    if(num.length !== 9 && num.length !== 10){
        error += "Longitud erronea";
    }

    if(num[0] !== '9' && num[0] !== '6' && num[0] !== '7'){
        error += "Debe comenzar por 9 7 o 6";
    }

    let i = 0;
    let existe = true;
    while(existe && i < num.length){
        if(isNaN(num[i]))
        {
            error += "El telefono solo debe contener numeros";
            existe = false;
        }
        i+=1;
    }

    
    return error;
}

function validarDireccion(dir){
    let error = "";

    if(dir.length < 5 || dir.length > 50)
        error += "Longitud erronea\n";

    let c = dir.slice(0,3);
    if(c !== "C/ ")
        error += "La direccion debe comenzar por 'C/ '\n";

    let nombreCalle = dir.slice(3);

    let i = 0;
    while(isLetter(nombreCalle[i]) || nombreCalle[i] === ' '){
        if (!isNaN(nombreCalle[i])){
            break;
        }
        i += 1;
    }

    let numeroCalle = nombreCalle.slice(i);
    if (numeroCalle.length < 1 || numeroCalle.length > 3 || isNaN(numeroCalle)) {
        error += "El número de la calle debe ser entre 1 y 3 dígitos\n";
    }
    return error;
}

function validarCodigoPostal(cod){
    let error = "";

    let reg = /^[1-9]{1}\d{4}$/;
    if(!reg.test(cod)){
        error += "Solo 5 digitos y no puede empezar por 0";
    }

    return error;
}

function validarFechaNac(fecha){
    let error = "";

    let reg = /^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/(\d{4})$/;
    if(!reg.test(fecha)){
        error += "DD/MM/AAAA";
    }

    return error;
}

function validarURL(url){
    let error = "";

    let nombre = "";
    if (url.startsWith("http://")) {
        nombre = url.slice(7);
    } else if (url.startsWith("https://")) {
        nombre = url.slice(8);
    } else {
        error += "La URL debe comenzar con 'http://' o 'https://'\n";
    }
    console.log("Nombre: "+nombre);

    let i= 0;
    let puntoEncontrado = false;
    let continuar = true;
    while(continuar && i < nombre.length){
        if(!isLetter(nombre[i]) && !isNaN(nombre[i]) && nombre[i] !== '-'){
            error+="Caracteres para la url invalidos";
            continuar = false;
        }
        if(nombre[i] === '.')
            puntoEncontrado = true;
        i+=1;
    }

    if(!puntoEncontrado){
        error += "No se encontro un punto";
    }

    let partes = nombre.split('.');
    let dominio = "." + partes[partes.length - 1];

    let dominiosPermitidos = [".com", ".net", ".es", ".org"];

    if (!dominiosPermitidos.includes(dominio)) {
        error += "Dominio no válido\n";
    }

    return error;
}


