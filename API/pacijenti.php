<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../includes/connection.php';
$oJson = array();

$sQuery = "SELECT * FROM pacijenti";
 $oData = $oConnection->query($sQuery);
 while($oRow = $oData->fetch(PDO::FETCH_BOTH)){
  $oPacijenti = new Pacijent(
   $oRow['id'],
   $oRow['imep'],
   $oRow['prezimep'],
   $oRow['doktor'],
   $oRow['uloga']
  );
  array_push($oJson,$oPacijenti);
 }
 echo json_encode($oJson,JSON_UNESCAPED_UNICODE);
?>