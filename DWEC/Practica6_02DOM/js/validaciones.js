if (document.addEventListener)
	window.addEventListener("load",inicio)
else if (document.attachEvent)
	window.attachEvent("onload",inicio);
	
	
function inicio(){

    let errores = "";

    // Cambio de color los inputs
    let inputs = document.querySelectorAll('input[type="text"]');
    //console.log(inputs);
    for (let i = 0; i < inputs.length; i++) {
        inputs[i].addEventListener('focus', () => {
            inputs[i].style.backgroundColor = 'green';
            inputs[i].style.color = 'white';
        });

        inputs[i].addEventListener('blur', () => {
            inputs[i].style.backgroundColor = 'white';
            inputs[i].style.color = 'black';
        });
    }

    // IDs de los inputs que solo aceptan dígitos
    let inputsIds = [
        "telefono",
        "codigoPostal",
        "codigoBanco",
        "numSucursal",
        "codigoControl",
        "numCuenta",
        "numTrabajadoresEmpresa",
        "numFabricasEmpresa"
    ];
    for (let i = 0; i < inputsIds.length; i++) {
        let input = document.getElementById(inputsIds[i]);
        input.addEventListener('keypress', function(tecla) {
            let caracter = String.fromCharCode(tecla.charCode);
            if(!(caracter >= '0' && caracter <= '9')){
                tecla.preventDefault();
            }
        });
    }

    // Caja de texto localidad solo va a admitir letras y espacios
    let loc = document.getElementById('localidad');
    loc.addEventListener('keypress', function(tecla) {
        let caracter = String.fromCharCode(tecla.charCode);
        let locRegExp = /^[a-záéíóúñ ]$/i;
        if (!(locRegExp.test(caracter))) {
            tecla.preventDefault();
        }
    })

    if (errores == "") {
        let boton=document.getElementById("validar");
        if (document.addEventListener)
            boton.addEventListener("click", validarFormulario)
        else if (document.attachEvent)
            boton.attachEvent("onclick", validarFormulario);
    } else {
        window.alert(errores);
    }
}

function validarFormulario(){

}
