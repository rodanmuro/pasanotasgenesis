<?php

$directorioArchivos = "./archivos/";
$rutaArchivo = './archivos/7893 Calificaciones.xlsx';

$handle = opendir($directorioArchivos);
while ($archivo = readdir($handle)) {
    $json[] = (utf8_encode($archivo));

    $tiempo = time();
    //echo "actual" . $tiempo . "<br>";
    $modificacion = filemtime($directorioArchivos . $archivo);
    //echo "modificacion" . $modificacion . "<br>";
    $diferencia = ($tiempo - $modificacion) / 60;
    //echo "diferencia" . ($diferencia) . "<br>";

    if ($archivo != "." && $archivo != "..") {
        if ($diferencia > 60) {
            //echo $archivo . " hay que borrarlo<br>";
            unlink($directorioArchivos . $archivo);
        } else {
            //echo $archivo . " esta nuevo<br>";
        }
    }
}

closedir($handle);

