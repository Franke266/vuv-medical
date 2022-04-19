<?php 
  // Headers
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
  include_once '../../includes/connection.php';
  include_once '../../models/pregledi.php';

  $database = new Database();
  $db = $database->connect();

  $oPregledi = new Pregled($db);

  try{
   $result = $oPregledi->read();
   $num = $result->rowCount();

   if($num > 0){
    $pregledi_arr = array();
    
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
     extract($row);

     $pregledi_item = array(
      'id'=> $id,
      'oib' => $oib,
      'imep' => html_entity_decode($imep),
      'prezimep' => html_entity_decode($prezimep),
      'razlog' => $razlog,
      'opis'=>$opis,
      'termin' => $termin,
      'status' => $status,
      'doktor' => $doktor
     );

     array_push($pregledi_arr, $pregledi_item);
    }
    echo json_encode($pregledi_arr);
   }else{
    echo json_encode(array('message'=>'Pregledi nisu pronađeni'));
   }
  }catch(Exception $e){
   echo json_encode(array('try_err'=> $e.getMessage()));
  };