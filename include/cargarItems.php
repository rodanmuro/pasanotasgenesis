<?php
include './PHPExcel/PHPExcel.php';

//$_POST['archivo'] = "./archivos/15070 Calificaciones Todas.xlsx";



if($_POST['archivo'] == !0){
//    echo "hola";
$objReader = new PHPExcel_Reader_Excel2007();
$objPHPExcel = $objReader->load($_POST['archivo']);

$celda = $objPHPExcel->getSheet(0)->getCellByColumnAndRow(i, 1);

$valor = $celda->getValue();
$i=0;
$json = Array();



while ($objPHPExcel->getSheet(0)->getCellByColumnAndRow($i, 1)->getValue() != "") {
//     echo "entro".$i;
    $celda = $objPHPExcel->getSheet(0)->getCellByColumnAndRow($i, 1);
    $valor = $celda->getValue();
//    echo " id ".$valor;
    $json[] = $valor;
    
    $i++;
}

echo json_encode($json);
}




