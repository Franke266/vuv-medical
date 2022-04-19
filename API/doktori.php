<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require __DIR__ . '/includes/connection.php';
//include 'connection.php';
//include_once 'core.php';
$oJson = array();

$sQuery = "SELECT * FROM doktori";
 $oData = $oConnection->query($sQuery);
 while($oRow = $oData->fetch(PDO::FETCH_BOTH)){
  $oDoktori = new Doktor(
   $oRow['id'],
   $oRow['ime'],
   $oRow['prezime'],
   $oRow['oib'],
   $oRow['uloga']
  );
  array_push($oJson,$oDoktori);
 }
 echo json_encode($oJson,JSON_UNESCAPED_UNICODE);
?>