<?php

//Esta función carga los archivos de las evidencias
//crea una carpeta para el estándar en el cual se cargan evidencias
//y en esa carpeta guarda el archivo
$filename = $_FILES['file'];

//directorio 
$directorioIps = "./archivos/";

//creamos la carpeta de evidencias para la respectiva ips
if (!file_exists($directorioIps)) {
    mkdir($directorioIps);
}

//Debemos determinar si ya existe un archivo con dicho nombre en las carpetas del servidor
$new_file_name = utf8_encode($filename['name']);
$i = 1;
while (file_exists($directorioIps . $new_file_name)) {
    //si existe, entonces cambiamos el nombre
    $new_file_name = "(" . $i . ")" . utf8_encode($filename['name']);
    $i++;
}

//subimos un nivel
$uploaddir_absoluto = $directorioIps; //"../soportes_fortalezas/archivos_soportes_estandar_".$numero_estandar."/";
//$new_file_name = date("His").'_'.$filename['name'];
//para devolver a la pagina
//$uploaddir_relativo = substr($directorioIps, 3); //"soportes_fortalezas/archivos_soportes_estandar_".$numero_estandar."/";
$uploaddir_relativo = $directorioIps;

$arreglo = array();
if (move_uploaded_file($filename['tmp_name'], $uploaddir_absoluto . $new_file_name)) {
    $arreglo = array(
        'status' => 'ok',
        'nombre_archivo' => ($new_file_name),
        'ruta_archivo' => $uploaddir_relativo . ($new_file_name),
    );
} else {
    //en caso de error en la transferencia
    $arreglo = array(
        'status' => 'error'
    );
}

echo json_encode($arreglo);
?>
