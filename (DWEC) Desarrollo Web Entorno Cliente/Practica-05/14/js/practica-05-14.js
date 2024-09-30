window.onload = inicio;

function inicio() {
    document.form.comprobar.onclick = comprobar;
}

function comprobar() {
    let codigo = document.form.codigo.value.trim().toLowerCase();
    let mensaje = document.form.mensaje;

    mensaje.value = "";

    
}
