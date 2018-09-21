<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <script src="js/jquery-2.0.3.min.js"></script>
        <script src="js/jquery.filedrop.js"></script>
        <script src="js/cargaArchivos.js"></script>

        <script>
            $(document).ready(function () {

                function abrirPagina() {

                    $.ajax({
                        url: "./include/crearPaginaGenesis.php",
                        data: {
                            columnaId: $("#columnaIds").val(),
                            columnaNotas: $("#columnaNotas").val(),
                            tipoExamen: $("#tipoExamen").val(),
                            archivo: $("#listadoArchivos").val(),
                            texto: $("#textoGenesis").val()
                        },
                        dataType: "text",
                        async: false,
                        type: "POST",
                        success: function (data) {
                            window.open('./include/paginaGenesis.html', '_blank');
                            console.log("columnaIds: " + $("#columnaIds").val() + " columnanotas:" + $("#columnaNotas").val());
                        }
                    }).fail(function () {
                        alert("Error al abrir la pagina");
                    });
                }

                function cargarListadoArchivos() {
                    $.ajax({
                        url: "./include/cargarListadoArchivos.php",
                        data: {},
                        dataType: "json",
                        async: true,
                        type: "POST",
                        success: function (data) {

                            $.each(data, function (index, response) {
//                                if (index > 1) {

                                var nombre_archivo = response;
                                if (response != "." && response != "..") {
//                                if (response.length > 10)
//                                    nombre_archivo = response.substring(0, 15) + "...";
                                    $("#listadoArchivos").append("<option value='./archivos/" + response + "' title='" + response + "'>" + response + "</option>");
                                }
                            })
                        }
                    }).fail(function () {
                        alert("Ocurrió un error al cargar los archivos");
                    });
                }

                function cargarItems() {
                    $.ajax({
                        url: "./include/cargarItems.php",
                        data: {
                            archivo: $("#listadoArchivos").val(),
                        },
                        dataType: "json",
                        async: false,
                        type: "POST",
                        success: function (data) {
                            
                            var letras = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','W','X','Y','Z']
                            
                            $.each(data, function (index, value) {
                                var option = $("#columnaNotas option:eq(" + index + ")")
                                var texto = option.text("")
                                option.text(letras[index] + " " + value);
                            });
                        }
                    }).fail(function () {});
                }


                eventoCargarSoporteArchivo();
                cargarListadoArchivos();

                $("#listadoArchivos").change(function () {
                    cargarItems();
                })
                

                $("#irPaginaGenesis").click(function () {
                    abrirPagina();
                });

            }
            );
        </script>
    </head>
    <body>
        <h2 style="text-align: center">Pasa notas a Génesis, elaborado   por Rodolfo Muriel. Email: rodanmuro@gmail.com</h2>
		<h3 style="text-align: center">Importante: Recuerde que el archivo de Excel con las notas definitivas debe estar a un solo decimal</h3>
        <div id='cargarArchivos' style="background-color: #81BEF7">1. Arrastre el archivo de Excel (Importante: debe ser de extensión .xlsx), que descargó de Moodle sobre esta franja azul (El archivo dura una hora en el servidor)

            <br>
            <br>
            2. Si el archivo se cargó correctamente, aparecerá en el siguiente listado.
            <select id="listadoArchivos"><option id="id" value="0">Listado de archivos</option></select>
            <br>
            <br>
        </div>

        3. Observe su archivo de Excel y llene adecuadamente estos datos
        <div>Columna en Excel del ID del estudiante
            <select id="columnaIds">
                <option value="0">A</option>
                <option value="1">B</option>
                <option value="2" selected>C</option>
                <option value="3">D</option>
                <option value="4">E</option>
                <option value="5">F</option>
                <option value="6">G</option>
                <option value="7">H</option>
                <option value="8">I</option>
                <option value="9">J</option>
                <option value="10">K</option>
                <option value="11">L</option>
                <option value="12">M</option>
                <option value="13">N</option>
                <option value="14">O</option>
                <option value="15">P</option>
            </select>
        </div>
        <div>Columna en Excel de las notas a pasar
            <select id="columnaNotas">
                <option value="0">A</option>
                <option value="1">B</option>
                <option value="2">C</option>
                <option value="3">D</option>
                <option value="4">E</option>
                <option value="5">F</option>
                <option value="6">G</option>
                <option value="7">H</option>
                <option value="8">I</option>
                <option value="9">J</option>
                <option value="10">K</option>
                <option value="11">L</option>
                <option value="12">M</option>
                <option value="13">N</option>
                <option value="14">O</option>
                <option value="15">P</option>
                <option value="16">Q</option>
                <option value="17">R</option>
                <option value="18">S</option>
                <option value="19">T</option>
                <option value="20">U</option>
                <option value="21">V</option>
                <option value="22">W</option>
                <option value="23">X</option>
                <option value="24">Y</option>
                <option value="25">Z</option>

            </select>
        </div>
        <div>Tipo de Examen
            <select id="tipoExamen">
                <option value="M">Cortes 1 ó 2</option>
                <option value="F">Corte final</option>
            </select>
        </div>
        <br>
        4. Abra su cuenta de génesis, y dirígase hasta la página del grupo sobre el cual va a pasar las notas (Debe seleccionar el corte, y luego abrir  la página con el listado en blanco de las notas a digitar)
        <br>
        <br>
        5. Con la página de su listado de notas en Génesiss ya abierta (Paso 4), vamos a copiar su código fuente, para ello observemos el paso siguiente
        <br>
        <br>
        6. En la respectiva página de Génesis en cualquier lugar al interior de la página (Preferiblemente en un espacio en blanco que no sea imagen ni video), haga click derecho, y escoja la opción "Ver código fuente de la página", o simplemente presione Ctrl U, y con este comando también se le abrirá el código fuente
        <br>
        <br>
        7. Luego, en la página que se abre encontrará un montón de textos, esos son códigos html (un poco miedosos si nunca se ha trabajado con ellos, pero no se preocupen, por el momento no nos interesa entenderlos), presione Ctrl A, para seleccionar todo el texto rápidamente, y luego Ctrl C, para copiar.
        <br>
        <br>
        8. Volvamos a nuestro pasa nota Génesis. Haga click en el siguiente área de texto (Aunque se recomienda hacer Ctrl A, por si  hay código pegado previamente, pero si está seguro que no hay mas texto no es necesario)
        <br>
        <br>
        9. Presione Ctrl V, para pegar en la mencionada área de texto. Se tomará un poco de tiempo, pues la cantidad
        de texto es bastante grande. El código fuente quedará pegado allí, en ese cuadro de texto, y es completamente necesario pegarlo, porque el programa leera allí los ID de los estudiantes para copiarles la nota adecuada
        <br>
        Importante: el cuadro de texto a continuación siempre debe estar en blanco (con excepción del aviso por defecto)
        <br>
        <textarea id='textoGenesis' rows="10" cols="50" placeholder="Copie y pegue el código fuente acá, siguiendo las instrucciones explicadas en el paso 5. Asegúrese que este cuadro de texto, no tenga algo pegado previamente"></textarea>
        <br>
        <br>
        9. Finalmente haga click acá debajo en "Click acá", para que se genere una página con las notas pasadas
        <div>
            <a id="irPaginaGenesis" href="javascript:void(0);">Click acá</a>
        </div>
        <br>
        <br>
        <div style="text-align: center">
            <h2>Tutorial en video del pasanotas</h2>
            <iframe width="420" height="315" src="https://www.youtube.com/embed/9SA7ddp86qQ" frameborder="0" allowfullscreen></iframe>
        </div>
        
    </body>
</html>
