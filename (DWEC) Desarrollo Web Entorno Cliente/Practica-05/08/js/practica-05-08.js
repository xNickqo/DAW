window.onload = inicio;

function inicio() {
    document.form.comprobar.onclick = comprobar;
}

function comprobar() {
    let fecha = document.form.fecha.value.trim();
    let mensaje = document.form.mensaje;

    let partes = fecha.split("/");
    if (partes.length !== 3) {
        mensaje.value = "Formato de fecha incorrecto. Debe ser D/M/AAAA.";
        return ;
    }

    let dia = parseInt(partes[0], 10);
    let mes = parseInt(partes[1], 10);
    let año = parseInt(partes[2], 10);

    if (isNaN(año) || año < 1000 || año > 9999) {
        mensaje.value = "El año debe tener cuatro dígitos.";
        return;
    }

    if (isNaN(mes) || mes < 1 || mes > 12) {
        mensaje.value = "El mes debe estar entre 01 y 12.";
        return;
    }

    if (isNaN(dia) || dia < 1 || dia > 31) {
        mensaje.value = "El día debe estar entre 01 y 31.";
        return;
    }

    let fechaValida = new Date(año, mes - 1, dia);

    if (fechaValida.getFullYear() === año && 
        fechaValida.getMonth() === (mes - 1) && 
        fechaValida.getDate() === dia)
        mensaje.value = "Fecha válida.";
    else
        mensaje.value = "La fecha no es válida.";

    mensaje.value = "Fecha válida.";
}


