if (document.addEventListener)
	window.addEventListener("load",inicio)
else if (document.attachEvent)
	window.attachEvent("onload",inicio);
	
	
function inicio(){
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


    let boton = document.getElementById("validar");

    if (document.addEventListener)
        boton.addEventListener("click", validarFormulario)
    else if (document.attachEvent)
        boton.attachEvent("onclick", validarFormulario);
}

function validarFormulario() {
    let errores = '';
    let correcto = false;

    //Razon_nombre
    let razon_nombre = document.formu.razon_nombre.value.trim().toUpperCase();
    let res_razonNombre = razonNombre(razon_nombre);
    if (res_razonNombre !== "") {
        document.getElementById('razon_nombre_error').value = "La Razón Social/Apellidos y Nombre no es válida.";
        errores += "La Razón Social/Apellidos y Nombre no es válida.\n";
    }

    //Codigo empresa
    let codigoEmpresa = document.formu.codigoEmpresa.value.trim().toUpperCase();
    let res_codigoEmpresa = CodigoEmpresa(codigoEmpresa);
    if (res_codigoEmpresa !== ""){
        document.getElementById('codigoEmpresa_error').value = "El Código de la empresa no es válido. Debe tener entre 5 y 10 caracteres, letras y números.";
        errores += "El Código de la empresa no es válido. Debe tener entre 5 y 10 caracteres, letras y números.\n";
    }

/*
    //Nif
    let nif = document.formu.nif.value.trim().toUpperCase();
    let res_esNif = esNif(nif);
    if (res_esNif === 1) {
        errores += "Se ha introducido un NIF correcto\n\n";
    } else if (res_esNif === 2) {
        errores += "Se ha introducido un NIF erróneo. El carácter de control es erróneo\n\n";
    } else if (res_esNif === 3) {
        errores += "Se ha introducido un DNI, se ha pasado un número de entre 6 y 8 dígitos con un valor mínimo de 100000\n\n";
    } else if (res_esNif === 0) {
        errores += "Se ha introducido un dato no válido. No es NIF ni DNI\n\n";
    }

    //Cif
    let cif = document.formu.cif.value.trim().toUpperCase();
    let res_esCif = esCif(cif);
    if (res_esCif === 1) {
        errores += "Se ha introducido un CIF correcto\n\n";
    } else if (res_esCif === 2) {
        errores += "Se ha introducido un CIF erróneo. El carácter de control es erróneo\n\n";
    } else if (res_esCif === 0) {
        errores += "Se ha introducido un dato no válido. No es CIF\n\n";
    }
*/

    //Nifcif
    let nifcif = document.formu.nifcif.value.trim().toUpperCase();
    let res_esNifCif = NIFCIF(nifcif);
    if (res_esNifCif === 'C1') {
        errores += "";
    } else if (res_esNifCif === 'C2') {
        errores += "---[CIF] Se ha introducido un CIF erróneo. El carácter de control es erróneo\n";
    } else if (res_esNifCif === 'N1') {
        errores += "";
    } else if (res_esNifCif === 'N2') {
        errores += "---[NIF] Se ha introducido un NIF erróneo. El carácter de control es erróneo\n";
    } else if (res_esNifCif === 'N3') {
        errores += "---[NIF] Se ha introducido un DNI, se ha pasado un número de entre 6 y 8 dígitos con un valor mínimo de 100000\n";
    } else if (res_esNifCif === 0) {
        errores += "---[NIFCIF] Se ha introducido un dato no válido. No es CIF\n";
    }

    //Tipo de persona
    /* if (document.formu.tipoPersona.value == '')
        errores += "Debes seleccionar 1 opcion en Tipo persona \n";
 */
    //Domicilio Social/Particular
    let direccion = document.formu.direccion.value.trim().toUpperCase();
    let res_direccion = validarDireccion(direccion);
    if (res_direccion !== ""){
        document.getElementById('direccion_error').value = "La Dirección no es válida.";
        errores += "La Dirección no es válida.\n";
    }

    let localidad = document.formu.localidad.value.trim().toUpperCase();
    let res_localidad = validarLocalidad(localidad);
    if (res_localidad !== ""){
        document.getElementById('localidad_error').value = "La Localidad no es válida.";
        errores += "La Localidad no es válida.\n";
    }

    let codigoPostal = document.formu.codigoPostal.value.trim();
    let res_codigoPostal = validarCodigoPostal(codigoPostal);
    if (res_codigoPostal !== ""){
        document.getElementById('codigoPostal_error').value = "El Código Postal no es válido. Debe estar entre 1000 y 52999.";
        errores += "El Código Postal no es válido. Debe estar entre 1000 y 52999.\n";
    }

    let telefono = document.formu.telefono.value.trim();
    let res_tel = validarNumTel(telefono);
    if (res_tel !== "")
    {
        document.getElementById('telefono_error').value = "El Teléfono no es válido. Debe tener 9 dígitos y comenzar con 9, 8, 6 o 7.";
        errores += "El Teléfono no es válido. Debe tener 9 dígitos y comenzar con 9, 8, 6 o 7.\n";
    }

    //Codigoscontrol
    let codigoBanco = document.formu.codigoBanco.value.trim();
    let numSucursal = document.formu.numSucursal.value.trim();
    let numCuenta = document.formu.numCuenta.value.trim();
    let codigoControl = codigosControl(codigoBanco, numSucursal, numCuenta);
    document.formu.codigoControl.value = codigoControl

/*
    //Calculo IBAN España
    let codigoCuenta = document.formu.codigoCuenta.value.trim();
    let res_iban = calculoIBANEspanya(codigoCuenta);
    document.formu.iban.value = res_iban;
*/

    //Comprobar IBAN
    let iban = document.formu.codigoIBAN.value.trim();
    let res = comprobarIBAN(iban);
    if (res === false){
        document.getElementById('iban_error').value = "El IBAN no es válido.";
        errores += "El IBAN no es válido.\n";
    }

    //Fecha de la Constitucion de la empresa
    let fechaConstitucionEmpresa = document.formu.fechaConstitucionEmpresa.value;
    let res_fecha = validarFecha(fechaConstitucionEmpresa);
    if (res_fecha !== ""){
        document.getElementById('fechaConstitucionEmpresa_error').value = "La Fecha no es válida.";
        errores += "La Fecha no es válida.\n";
    }

    //Numero de trabajadores de la empresa
    let numTrabEmpr = document.formu.numTrabajadoresEmpresa.value.trim();
    let numTrabEmprRegex =  /^(4[5-9]|[5-9][0-9]|[1-9][0-9]{2,5})$/;
    if (numTrabEmpr === '' || !numTrabEmprRegex.test(numTrabEmpr)){
        document.getElementById('numTrabajadoresEmpresa_error').value = "El Número de Trabajadores no es válido. Debe ser un número entre 45 y 999999.";
        errores += "El Número de Trabajadores no es válido. Debe ser un número entre 45 y 999999.\n";
    }

    //Numero de fabricas de la empresa
    let numFabEmp = document.formu.numFabricasEmpresa.value.trim();
    let numFabEmpRegex = /^(?:[2-9]|[1-9][0-9]{1,3}|[1-9][0-9]{0,3})$/;
    if (numFabEmp === '' || !numFabEmpRegex.test(numFabEmp)){
        document.getElementById('numFabricasEmpresa_error').value = "El Número de Fábricas no es válido. Debe ser un número entre 2 y 9999.";
        errores += "El Número de Fábricas no es válido. Debe ser un número entre 2 y 9999.\n";
    }

    //Comunidades (select multiple option)
    let comunidadesSeleccionadas = document.formu.comunidades;
    let res_com = validarComunidades(comunidadesSeleccionadas);
    if (res_com !== ""){
        errores += "Debe seleccionar al menos dos comunidades autónomas en las que hay fábricas.\n";
    }

    //Sector/es Economicos (checkbox)
    let sectoresEconomicos = document.formu.sectorEconomico;
    let res_sector = validarSector(sectoresEconomicos);
    if (res_sector !== "")
        errores += res_sector;

    //tipoEmpresa (radio button)
    let tipoEmpresa = document.formu.tipoEmpresa;
    let res_tipoEmpresa = validarTipoEmpresa(tipoEmpresa);
    if (res_tipoEmpresa !== "")
        errores += res_tipoEmpresa;

    // Mostrar mensajes de errores
    if (errores !== "")
    {
        window.alert(errores);
    }
    else
    {
        window.alert("Formulario enviado correctamente");
        correcto = true;
    }

    return correcto;
}