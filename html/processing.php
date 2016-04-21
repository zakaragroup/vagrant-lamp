<?php
error_reporting(-1);
ini_set('display_errors', 'On');

include 'simplexlsx.class.php';
include 'xlsxwriter.class.php';


  $xlsx = new SimpleXLSX('./upload/test.xlsx');

  $items = $xlsx->rows();

  $newDomain = "http://distribuidorelectronica.com";
  //fill array with wrong domains
  foreach ($items as $item) {

    $url = $item[0];

    if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
      $parse  = parse_url($url, PHP_URL_PATH);

      $path[] = array($url,$newDomain.$parse);

    }
  
  }

if (!is_array($path)) {
  error_log("Imposible crear el nuevo archivo excel");
  return false;
}

$filename = md5(date('Y-m-d H:i:s'));

$writer = new XLSXWriter();
$writer->writeSheet($path);
$writer->writeToFile('./upload/'.$filename.'.xlsx');

return true;



?>