var eventoCargarSoporteArchivo = function () {


    $("#cargarArchivos").filedrop({
        url: 'include/cargaArchivos.php',
        paramname: 'file',
        maxfilesize: 10,
        uploadStarted: function (i, file, len) {

            //alert("Se inicia la descarga");
//            $("#contenedorPrincipalProgresoArchivo").find("#nombreArchivo").text(file.name);
//            $("#contenedorPrincipalProgresoArchivo").show();
        },
        progressUpdated: function (i, file, progress) {
//            $("#contenedorPrincipalProgresoArchivo").find("#progreso").text(progress);
//            $("#contenedorPrincipalProgresoArchivo").find("#barraProgreso").width(progress + "%");
        },
        error: function (err, file) {
            switch (err) {
                case 'FileTooLarge':
                    alert("El archivo tiene un tamaño demasiado grande. Sólo se permiten archivos menores o iguales a 5 megas.");
                    break;
            }
        },
        data: {
            
        },
        uploadFinished: function (i, file, response) {
            if (response.status == 'ok') {
//                $("#mensajeCargaExitosa").text("Archivo cargado exitosamente!!!");
//                $("#ventanaProgresoArchivos").find("#salirDescarga").show();
                //alert("Archivo cargado exitosamente " + response.ruta_archivo);



                //$("#contenedor_estandar_"+numero_estandar).find("#estandar_soportes > #area_archivos_soportes > select").append("<option value='hola'>Hola</option>");
                var nombre_archivo = response.nombre_archivo;
                if (false/*response.nombre_archivo.length > 10*/)
                    nombre_archivo = response.nombre_archivo.substring(0, 15) + "...";
                $("#listadoArchivos").append("<option value='" + response.ruta_archivo + "' title='" + response.nombre_archivo + "'>" + nombre_archivo + "</option>");
            } else {
//                $("#mensajeCargaExitosa").text("Ocurrió un error durante la carga del archivo!!!");
//                $("#ventanaProgresoArchivos").find("#salirDescarga").show();
            }
        }
    }
    );
}