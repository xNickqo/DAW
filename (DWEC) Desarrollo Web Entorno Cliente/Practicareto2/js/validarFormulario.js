window.onload = inicio;

function inicio()
{
    document.formu.onsubmit = validarFormulario;
}

function validarFormulario()
{
    let error = '';
    let correcto = false;

    //Razon_nombre
    let razon_nombre = document.formu.razon_nombre.value.trim().toUpperCase();
    let res_razonNombre = razonNombre(razon_nombre);
    if (res_razonNombre !== "")
        error += res_razonNombre + "<br>";

    //Codigo empresa
    let codigoEmpresa = document.formu.codigoEmpresa.value.trim().toUpperCase();
    let res_codigoEmpresa = CodigoEmpresa(codigoEmpresa);
    if (res_codigoEmpresa !== "")
        error += res_codigoEmpresa + "<br>";

    /* //Nif
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
    } */

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

    //Tipo de persona
    let direccion = document.formu.direccion.value.trim().toUpperCase();
    let res_direccion = f_direccion(direccion);
    if (res_direccion !== "")
        error += res_direccion + "<br>";

    let localidad = document.formu.localidad.value.trim().toUpperCase();
    let res_localidad = f_localidad(localidad);
    if (res_localidad !== "")
        error += res_localidad + "<br>";


    let codigoPostal = document.formu.codigoPostal.value.trim();
    let res_codigoPostal = comprobarCodigoPostal(codigoPostal);
    if (res_codigoPostal !== "")
        error += res_codigoPostal + "<br>";

    let provincia = document.formu.provincia.value;


    //Codigoscontrol
    let codigoBanco = document.formu.codigoBanco.value.trim();
    let numSucursal = document.formu.numSucursal.value.trim();
    let numCuenta = document.formu.numCuenta.value.trim();
    let codigoControl = codigosControl(codigoBanco, numSucursal, numCuenta);
    document.formu.codigoControl.value = codigoControl;

    /* //Calculo IBAN España
    let codigoCuenta = document.formu.codigoCuenta.value.trim();
    let res_iban = calculoIBANEspanya(codigoCuenta);
    document.formu.iban.value = res_iban; */
    
    //Comprobar IBAN
    let iban = document.formu.codigoIBAN.value.trim();
    let res = comprobarIBAN(iban);
    if (res === TRUE)
        document.formu.codigoIBAN.style.backgroundColor="green";
    else
    {
        error += "IBAN incorrecto. <br>";
        document.formu.codigoIBAN.style.backgroundColor="red";
    }

    /* //Fecha de la Constitucion de la empresa 
    let fechaConstitucionEmpresa = document.formu.fechaConstitucionEmpresa.value;

    //Numero de trabajadores de la empresa 
    let numeroTrabajadoresEmpresa = document.formu.numeroTrabajadoresEmpresa.value;
    
    //Numero de fabricas de la empresa 
    let numeroFabricasEmpresa = document.formu.numeroFabricasEmpresa.value;
    
    //Comunidades (select multiple option)
    let comunidades = document.formu.comunidades.value;

    //Sector/es Economicos (checkbox)
    let sector = document.formu.sectorEconomico.value;

    //Sector/es Economicos (checkbox)
    let tipoEmpresa = document.formu.tipoEmpresa.value; */


    // Mostrar mensajes de error
    document.getElementById('mensajeErrores').innerHTML = error;

    return correcto;
}