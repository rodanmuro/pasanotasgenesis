<?php
clearstatcache();

include './PHPExcel/PHPExcel.php';

$objReader = new PHPExcel_Reader_Excel2007();
$objPHPExcel = $objReader->load($_POST['archivo']);

$tipoExamen = $_POST['tipoExamen'];
//$tipoExamen = 'F';

$columnaNota = $_POST['columnaNotas'];
$columnaID = $_POST['columnaId'];



$celda = $objPHPExcel->getSheet(0)->getCellByColumnAndRow(2, 2);
$i = 0;
$texto = $_POST['texto'];
//también reemplazamos la ruta
$texto = str_replace('/pls/PROD/bwlkegrb.P_FacScorePost', 'http://wiwa.uniminuto.edu:8501/pls/PROD/bwlkegrb.P_FacScorePost', $texto);
//$texto = str_replace('/pls/PROD/twbksrch.P_ShowResults', 'http://wiwa.uniminuto.edu:8501/pls/PROD/twbksrch.P_ShowResults', $texto);
//for($i=0; $i<19; $i++){


while ($objPHPExcel->getSheet(0)->getCellByColumnAndRow($columnaID, 2 + $i)->getValue() != "") {

    echo "entro" . $i;
    $celda = $objPHPExcel->getSheet(0)->getCellByColumnAndRow($columnaID, 2 + $i);
    $valor = $celda->getValue();
    echo " id " . $valor;

    $inputValor = "<INPUT TYPE=\"text\" NAME=\"marks_tab\" SIZE=\"7\" MAXLENGTH=\"6\" VALUE=\"";

    $referencia = "<INPUT TYPE=\"hidden\" NAME=\"inclind_tab\" VALUE=\"$tipoExamen\">";
//$referencia = "<INPUT";

    $filename = "paginaGenesis.html";

    $posicionID = strpos($texto, $valor);

    if (!$posicionID === false) {
        $posicionInputValor = strpos($texto, $inputValor, $posicionID);
        $posicionReferencia = strpos($texto, $referencia, $posicionID);

        $subcadena1 = substr($texto, $posicionID, $posicionReferencia - $posicionID);

        $posicionInputSubcaden2 = strpos($subcadena1, "<INPUT");

        $subcadena2 = substr($subcadena1, 0, $posicionInputSubcaden2);
        $valorNota = $objPHPExcel->getSheet(0)->getCellByColumnAndRow($columnaNota, 2 + $i)->getValue() * 20;
        $nuevaNota = "<INPUT TYPE=\"text\" NAME=\"marks_tab\" SIZE=\"7\" MAXLENGTH=\"6\" VALUE=\"$valorNota\" ID=\"marks_id2\">";

        $subCadena3 = $subcadena2 . $nuevaNota;

//ahora debemos tomar la subcadena1 y reemplazarla por la 3 en texto
        $texto = str_replace($subcadena1, $subCadena3, $texto);

        echo " nota " . $valorNota;
    }


    $i++;
//}
}


$fh = fopen($filename, "w");

fwrite($fh, $texto);

fclose($fh);

echo $posicionID . "<br>";
echo $posicionReferencia . "<br>";
echo $posicionInputValor;
echo $subcadena1 . "\n";
echo $subcadena2 . "\n";
echo $subCadena3 . "\n";
echo $valorNota;

//$json = Array();
//echo json_encode($json);