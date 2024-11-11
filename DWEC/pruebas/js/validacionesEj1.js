window.onload = inicio;

function inicio (){
    document.formu.onsubmit = validarFormulario;
}

/* NOMBRE
Usa una expresion regular para permitir solo letras y espacios
El nombre debe contenet almenos 2 palabras, nombre y apellidos 
Sino error*/
function validarNombre(nombre){
    let res = "";
    let nombreRegExp = /^[a-záéíúóñ]+(\s[a-záéíóúñ]+)$/i;
    if(!(nombreRegExp.test(nombre)))
        res = "Nombre incorrecto";
    return res;
}

/* CORREO
Valida que el formato del correo sea parecido a usuario@dominio.com*/
function validarCorreo(mail){
    let res = "";
    let correoRegExp = /^[a-z0-9.%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i;
    if (!correoRegExp.test(mail))
        res = "correo incorrecto";
    return res;
}

/* CONTRASEÑA
La contraseña debe tener almenos 8 caracteres, 1 letra mayuscula, almenos 1 minuscula y un numero */
function validarContraseña(pass){
    let res="";
    let counta = 0;
    let countn = 0;
    let countA = 0;
    let i = 0;
    while (i < pass.length)
    {
        if (!isNaN(pass[i]))
            countn++;
        if (pass[i] === pass[i].toUpperCase())
            countA++;
        if (pass[i] === pass[i].toLowerCase())
            counta++;
        i++;
    }
    if (countn < 1)
        res="La contraseña debe tener almenos 1 numero";
    if (counta < 1)
        res="La contraseña debe tener almenos 1 minuscula";
    if (countA < 1)
        res="La contraseña debe tener almenos 1 mayuscula";
    if (pass.length < 8)
        res="La contarseña debe tener mas de 8 caracteres";
    return res;
}

/* TELEFONO
Permite solo numeros y valida que la longitud sea exactamente de 10 digitos */
function validarTel(tel){
    let res = "";
    let telRegExp = /^\d{10}$/;
    if (!telRegExp.test(tel))
        res="telefono incorrecto";
    return res;
}

/* FECHA
Valida que el usuario tenga almenos 18 años*/
function validarFecha(fecha){
    let res = "";
    let hoy = new Date();
    let fechaNac = new Date(fecha);
    let edad = hoy.getFullYear() - fechaNac.getFullYear();
    let mes = hoy.getMonth() - fechaNac.getMonth();
    if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNac.getDate()))
        edad--;
    if (edad < 18)
        res ="Necesitas ser mayor de 18años";
    return res;
}


function validarFormulario(){
    let error = "";
    
    let nombre = document.formu.nombre.value;
    let validacionNombre = validarNombre(nombre);
    if(validacionNombre !== "")
        error += validacionNombre + "\n";

    let correo = document.formu.correo.value;
    let resCorreo = validarCorreo(correo);
    if(resCorreo !== "")
        error += resCorreo + "\n";

    let pass = document.formu.pass.value;
    let resPass = validarContraseña(pass);
    if (resPass !== "")
        error += resPass + "\n";

    let tel = document.formu.tel.value;
    let resTel = validarTel(tel);
    if (resTel !== "")
        error += resTel + "\n";

    let fecha = document.formu.fecha.value;
    let resFecha = validarFecha(fecha);
    if (resFecha !== "")
        error += resFecha + "\n";

    if(error === "")
        alert("Formulario enviado correctamente");
    else
        alert(error);
}