<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../includes/connection.php';
$oJson = array();

$sQuery = "SELECT * FROM lijekovi";
 $oData = $oConnection->query($sQuery);
 while($oRow = $oData->fetch(PDO::FETCH_BOTH)){
  $oLijekovi = new Lijek(
   $oRow['id'],
   $oRow['ime'],
   $oRow['prezime'],
   $oRow['vrsta'],
   $oRow['status']
  );
  array_push($oJson,$oLijekovi);
 }
 echo json_encode($oJson,JSON_UNESCAPED_UNICODE);
?>