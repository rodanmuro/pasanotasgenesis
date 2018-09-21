<?php

//borramos archivos antiguos
include './borraArchivos.php';

//tomamos los datos relativos a la IPS
//iniciamos la cadena con la ruta de los soportes
$directorioArchivos = "./archivos/";

$archivos = Array();
$json = Array();

$handle = opendir($directorioArchivos);
while ($archivo = readdir($handle)) {

    //echo $archivo."<br>";
    $json[] = (utf8_encode($archivo));
}
//            echo 'numero_estandar '.$numero_estandar."<br/>";
//            echo 'archivos '.$archivos[2]."<br/>";
//$json[] = Array(
//    'archivos' => $archivos
//);

closedir($handle);

echo json_encode($json);