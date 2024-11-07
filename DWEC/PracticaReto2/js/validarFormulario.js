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
        error += res_razonNombre;

    //Codigo empresa
    let codigoEmpresa = document.formu.codigoEmpresa.value.trim().toUpperCase();
    let res_codigoEmpresa = CodigoEmpresa(codigoEmpresa);
    if (res_codigoEmpresa !== "")
        error += res_codigoEmpresa;

/*
    //Nif
    let nif = document.formu.nif.value.trim().toUpperCase();
    let res_esNif = esNif(nif);
    if (res_esNif === 1) {
        error += "Se ha introducido un NIF correcto\n\n";
    } else if (res_esNif === 2) {
        error += "Se ha introducido un NIF erróneo. El carácter de control es erróneo\n\n";
    } else if (res_esNif === 3) {
        error += "Se ha introducido un DNI, se ha pasado un número de entre 6 y 8 dígitos con un valor mínimo de 100000\n\n";
    } else if (res_esNif === 0) {
        error += "Se ha introducido un dato no válido. No es NIF ni DNI\n\n";
    }

    //Cif
    let cif = document.formu.cif.value.trim().toUpperCase();
    let res_esCif = esCif(cif);
    if (res_esCif === 1) {
        error += "Se ha introducido un CIF correcto\n\n";
    } else if (res_esCif === 2) {
        error += "Se ha introducido un CIF erróneo. El carácter de control es erróneo\n\n";
    } else if (res_esCif === 0) {
        error += "Se ha introducido un dato no válido. No es CIF\n\n";
    }
*/

    //Nifcif
    let nifcif = document.formu.nifcif.value.trim().toUpperCase();
    let res_esNifCif = NIFCIF(nifcif);
    if (res_esNifCif === 'C1') {
        error += "";
    } else if (res_esNifCif === 'C2') {
        error += "Se ha introducido un CIF erróneo. El carácter de control es erróneo\n";
    } else if (res_esNifCif === 'N1') {
        error += "";
    } else if (res_esNifCif === 'N2') {
        error += "Se ha introducido un NIF erróneo. El carácter de control es erróneo\n";
    } else if (res_esNifCif === 'N3') {
        error += "Se ha introducido un DNI, se ha pasado un número de entre 6 y 8 dígitos con un valor mínimo de 100000\n";
    } else if (res_esNifCif === 0) {
        error += "Se ha introducido un dato no válido. No es CIF\n";
    }

    //Tipo de persona
    if (document.formu.tipoPersona.value == '')
        error += "Debes seleccionar 1 opcion en Tipo persona \n";

    //Domicilio Social/Particular
    let direccion = document.formu.direccion.value.trim().toUpperCase();
    let res_direccion = validarDireccion(direccion);
    if (res_direccion !== "")
        error += res_direccion;

    let localidad = document.formu.localidad.value.trim().toUpperCase();
    let res_localidad = validarLocalidad(localidad);
    if (res_localidad !== "")
        error += res_localidad;

    let codigoPostal = document.formu.codigoPostal.value.trim();
    let res_codigoPostal = validarCodigoPostal(codigoPostal);
    if (res_codigoPostal !== "")
        error += res_codigoPostal;

    let telefono = document.formu.telefono.value.trim();
    let res_tel = validarNumTel(telefono);
    if (res_tel !== "")
        error += res_tel;

    //Codigoscontrol
    let codigoBanco = document.formu.codigoBanco.value.trim();
    let numSucursal = document.formu.numSucursal.value.trim();
    let numCuenta = document.formu.numCuenta.value.trim();
    let codigoControl = codigosControl(codigoBanco, numSucursal, numCuenta);
    if(codigoControl !== "")
        error += codigoControl;

/*
    //Calculo IBAN España
    let codigoCuenta = document.formu.codigoCuenta.value.trim();
    let res_iban = calculoIBANEspanya(codigoCuenta);
    document.formu.iban.value = res_iban;
*/

    //Comprobar IBAN
    let iban = document.formu.codigoIBAN.value.trim();
    let res = comprobarIBAN(iban);
    if (res === false)
        error += "IBAN incorrecto. \n";

    //Fecha de la Constitucion de la empresa
    let fechaConstitucionEmpresa = document.formu.fechaConstitucionEmpresa.value;
    let res_fecha = validarFecha(fechaConstitucionEmpresa);
    if (res_fecha !== "")
        error += res_fecha;

    //Numero de trabajadores de la empresa
    let numTrabEmpr = document.formu.numTrabajadoresEmpresa.value.trim();
    if (numTrabEmpr === '' || isNaN(numTrabEmpr) || numTrabEmpr < 1)
        error += "El número de trabajadores debe ser un número válido mayor que 0.\n";

    //Numero de fabricas de la empresa
    let numFabEmp = document.formu.numFabricasEmpresa.value.trim();
    if (numFabEmp === '' || isNaN(numFabEmp) || numFabEmp < 1)
        error += "El número de fábricas debe ser un número válido mayor que 0.\n";

    //Comunidades (select multiple option)
    let comunidadesSeleccionadas = document.formu.comunidades;
    let res_com = validarComunidades(comunidadesSeleccionadas);
    if (res_com !== "");
        error += res_com;

    //Sector/es Economicos (checkbox)
    let sectoresEconomicos = document.formu.sectorEconomico;
    let res_sector = validarSector(sectoresEconomicos);
    if (res_sector !== "");
        error += res_sector;

    //tipoEmpresa (radio button)
    let tipoEmpresa = document.formu.tipoEmpresa;
    let res_tipoEmpresa = validarTipoEmpresa(tipoEmpresa);
    if (res_tipoEmpresa !== "");
        error += res_tipoEmpresa;

    // Mostrar mensajes de error
    if (error !== "")
    {
        window.alert(error);
    }
    else
    {
        window.alert("Formulario enviado correctamente");
        correcto = true;
    }

    return correcto;
}
