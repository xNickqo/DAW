window.onload = inicio;

function inicio(){
    document.formu.onsubmit = validarFormulario;
}

function validarFormulario(){
    let correcto = true;

    //Acceder a los campos del formulario
    let nombre = document.formu.nombre.value.trim().toLowerCase();
    let correo = document.formu.correo.value.trim().toLowerCase();
    let fechaNacimiento = document.formu.fechaNacimiento.value.trim().toLowerCase();
    let telefono = document.formu.telefono.value.trim().toLowerCase();
    let iban = document.formu.iban.value.trim().toLowerCase();
    let mensaje = document.formu.mensaje.value.trim().toLowerCase();

    let error = "";


    //Nombre
    let resNombre = validarNombre(nombre);
    if(resNombre !== "") {
        correcto = false;
        error += "Nombre Incorrecto\n";
    }

    //Correo electronico
    let resCorreo = validarCorreo(correo);
    if(resCorreo !== "") {
        correcto = false;
        error += "Correo Incorrecto\n";
    }

    //Fecha de nacimiento
    let resFecha = validarFecha(fechaNacimiento);
    if(resFecha !== "") {
        correcto = false;
        error += "Fecha Incorrecta\n";
    }

    //Validar si es mayor de edad
    let edad = validarEdad(fechaNacimiento);
    if(edad < 18)
        error += "Debes ser mayor de edad";

    //Telefono
    let resTelefono = validarTelefono(telefono);
    if(resTelefono !== "") {
        correcto = false;
        error += "Telefono Incorrecto\n";
    }

    //IBAN
    let resIban = validarIban(iban);
    if(resIban !== "") {
        correcto = false;
        error += "IBAN Incorrecto\n";
    }

    //Mensaje
    let resMensaje = validarMensaje(mensaje);
    if(resMensaje !== "") {
        correcto = false;
        error += "Mensaje Incorrecto\n";
    }

    if (correcto === false)
        alert(error);
    else
        alert("Formulario enviado correctamente");

    return correcto;
}