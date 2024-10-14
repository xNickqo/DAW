window.onload = inicio;

function inicio()
{
    document.formu.onsubmit = validarFormulario;
}

function validarFormulario()
{
    let error = '';
    let correcto = false;

    //Nif
    let nif = document.formu.nif.value.trim().toUpperCase();
    let res_esNif = esNif(nif);
    if (res_esNif === 1) {
        error += "Se ha introducido un NIF correcto<br>";
    } else if (res_esNif === 2) {
        error += "Se ha introducido un NIF erróneo. El carácter de control es erróneo<br>";
    } else if (res_esNif === 3) {
        error += "Se ha introducido un DNI, se ha pasado un número de entre 6 y 8 dígitos con un valor mínimo de 100000<br>";
    } else if (res_esNif === 0) {
        error += "Se ha introducido un dato no válido. No es NIF ni DNI<br>";
    }

    //Cif
    let cif = document.formu.cif.value.trim().toUpperCase(); 
    let res_esCif = esCif(cif);
    if (res_esCif === 1) {
        error += "Se ha introducido un CIF correcto<br>";
    } else if (res_esCif === 2) {
        error += "Se ha introducido un CIF erróneo. El carácter de control es erróneo<br>";
    } else if (res_esCif === 0) {
        error += "Se ha introducido un dato no válido. No es CIF<br>";
    }

    //Nifcif
    let nifcif = document.formu.nifcif.value.trim().toUpperCase();
    let res_esNifCif = NIFCIF(nifcif);
    if (res_esNifCif === 'C1') {
        error += "Se ha introducido un CIF correcto<br>";
    } else if (res_esNifCif === 'C2') {
        error += "Se ha introducido un CIF erróneo. El carácter de control es erróneo<br>";
    } else if (res_esNifCif === 'N1') {
        error += "Se ha introducido un NIF correcto<br>";
    } else if (res_esNifCif === 'N2') {
        error += "Se ha introducido un NIF erróneo. El carácter de control es erróneo<br>";
    } else if (res_esNifCif === 'N3') {
        error += "Se ha introducido un DNI, se ha pasado un número de entre 6 y 8 dígitos con un valor mínimo de 100000<br>";
    } else if (res_esNifCif === 0) {
        error += "Se ha introducido un dato no válido. No es CIF<br>";
    }

    //Codigoscontrol
    let codigoBanco = document.formu.codigoBanco.value.trim();
    let numSucursal = document.formu.numSucursal.value.trim();
    let numCuenta = document.formu.numCuenta.value.trim();
    let codigoControl = codigosControl(codigoBanco, numSucursal, numCuenta);
    document.formu.codigoControl.value = codigoControl;

    //calculoIBANEspanya
    let codigoCuenta = document.formu.codigoCuenta.value.trim();
    let res_iban = calculoIBANEspanya(codigoCuenta);
    document.formu.iban.value = res_iban;
    
    //comprobarIBAN
    let iban = document.formu.codigoIBAN.value.trim();
    let res = comprobarIBAN(iban);
    console.log(res);
    if (res) {
        document.formu.codigoIBAN.style.backgroundColor="green";
    } else {
        document.formu.codigoIBAN.style.backgroundColor="red";
    }

    // Mostrar mensajes de error
    document.getElementById('mensajeErrores').innerHTML = error;

    return correcto;
}