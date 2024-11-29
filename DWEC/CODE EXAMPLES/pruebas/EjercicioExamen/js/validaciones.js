function isLetter(caracter){
    return (caracter >= 'a' && caracter <= 'z');
}

function validarNombre(nombre){
    let res = "";
    let nombreRegex = /^[a-záéíóúñ ]{5,50}$/i;
    if (nombreRegex.test(nombre)) {
        res = "";
    } else {
        res = "Nombre Incorrecto";
    }
    return res;
}

function validarCorreo(correo){
    let res = "";

    if (correo.indexOf('@') === -1 && correo.indexOf('.') === -1 ){
        res += "Correo electrónico debe contener '@' y '.'\n";
    } else {
        
        let lenNombre = 0;
        let i = 0;
        while (correo[i] !== '@'){
            if(!isLetter(correo[i]) && isNaN(correo[i]) && correo[i] !=='.')
                res += "nombre de correo incorrecto\n";
            if(lenNombre > 15)
                res += "nombre de correo demasiado largo\n";
            i+=1;
            lenNombre+=1;
        }

        let lenDominio = 0;
        i+=1;
        while(correo[i] !== '.' && lenDominio <= 5){
            if(!isLetter(correo[i]))
                res += "dominio incorrecto\n";
            i+=1;
            lenDominio+=1;
        }

        let lenExtension = 0;
        i+=1;
        while(correo[i] !== '\0' && lenExtension <= 3)
        {
            if(!isLetter(correo[i]))
                res += "extension incorrecta";
            i+=1;
            lenExtension+=1;
        }
    }
    return res;
}

/*La fecha puede tener 1 o 2 digitos en el mes y 2 o 4 digitos en la fecha*/
function validarFecha(fecha){
    let res = "";

    let fechaRegExp = /^(0?[1-9]|[12][0-9]|[3][01])\/(0?[1-9]|1[0-2])\/(\d{2}|\d{4})$/i;
    if (fechaRegExp.test(fecha)) {   
        let parte = fecha.split("/");
        let dia = parte[0];
        let mes = parte[1];
        let año = parte[2];

        //Comprobamos que esten correctos los dias
        let mesCon31 = [1, 3, 5 ,7 ,8, 10, 12];
        let mesCon30 = [4, 6, 9 , 11];

        let diaMes = 0;

        if(mes === 2)               diaMes = 28;
        if(mesCon30.includes(mes))  diaMes = 30;
        if(mesCon31.includes(mes))  diaMes = 31;

        if(dia > diaMes)
            res = "Este mes tiene menos dias ;)";

        //Copmprobamos que no este poniendo una fecha de nacimiento en un año que todavia no existe
        let fechaActual = new Date();
        let añoActual = fechaActual.getFullYear();
        if(año > añoActual)
            res = "No estamos en el futuro crack";

    } else {
        res = "Fecha Incorrecta";
    }
    return res;
}

function validarEdad(fecha){
    let parte = fecha.split("/");
    let diaNacimiento = parte[0];
    let mesNacimiento = parte[1];
    let añoNacimiento = parte[2];

    let fechaActual = new Date();
    let diaActual = fechaActual.getDate();
    let mesActual = fechaActual.getMonth() + 1; // Empieza por 0 el mes en este metodo
    let añoActual = fechaActual.getFullYear();

    let edad = añoActual - añoNacimiento;

    //Si el cumpleaños no ha pasado todavia le restamos 1 año
    if(mesActual < mesNacimiento || (mesActual === mesNacimiento && diaActual < diaNacimiento))
        edad-=1;
    return edad;
}

function validarTelefono(tel){
    let res = "";

    if(tel.length < 9 || tel.length > 9) {
        res += "La longitud es incorrecta\n";
    } else {
        if(tel[0] !== 6 && tel[0] !== 7 && tel[0] !== 9)
            res += "El telefono debe comenzar por 6, 7 o 9";
    }

    return res;
}

function validarIban(iban){
    let res = "";

    if (iban.length > 34)
        res += "IBAN muy largo\n";

    let letras = iban.substring(0, 4) // Capturamos los 4 primeros digitos de la cadena
    let nums = iban.substring(4) + letras; // Capturamos desde el 4 hasta el final de la cadena

    let i = 0;
    let total = '';
    while (i < nums.length)
    {
        //Concatenamos numero por numero
        if (!isNaN(nums[i]))
        {
            total += nums[i];
        }
        //Si es una letra la convertimos a un numero A=10, B=11, C=12...
        else if (isLetter(nums[i]))
        {
            //A=65 en ASCII - 55 = 10
            total += (nums[i].charCodeAt(0) - 55).toString();
        }
        else
        {
            res += "No es ni una letra ni un numero\n";
        }
        i+=1;
    }

    // total % 97 = 1 el IBAN tiene una estructura correcta
    let resto = BigInt(total) % BigInt(97);
    if (resto !== BigInt(1))
        res = "Estructura del IBAN incorrecta";

    return res;
}

function validarMensaje(mensaje){
    let res = "";

    if (mensaje.length < 20 || mensaje.length > 500)
        res += "Longitud erronea en el mensaje";

    let palabra = mensaje.split(" ");
    let i = 0;
    while(i < palabra.length)
    {
        if (palabra[i] === "cabron" || palabra[i] === "puta" 
            || palabra[i] === "perra" || palabra[i] === "maricon"
                || palabra[i] === "gilipollas")
            res += "No se pueden usar palabras ofensivas";
        i+=1;
    }

    return res;
}