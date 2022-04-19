<?php 
  // Headers
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
  include_once '../../includes/connection.php';
  include_once '../../models/uputnice.php';

  $database = new Database();
  $db = $database->connect();

  $oUputnice = new Uputnica($db);

  try{
   $result = $oUputnice->read();
   $num = $result->rowCount();

   if($num > 0){
    $uputnice_arr = array();
    
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
     extract($row);

     $uputnice_item = array(
      'id'=> $id,
      'oib' => $oib,
      'imep' => html_entity_decode($imep),
      'prezimep' => html_entity_decode($prezimep),
      'specijalist' => $specijalist,
      'opis'=>$opis,
      'status' => $status,
      'doktor' => $doktor
     );

     array_push($uputnice_arr, $uputnice_item);
    }
    echo json_encode($uputnice_arr);
   }else{
    echo json_encode(array('message'=>'Uputnice nisu pronađene'));
   }
  }catch(Exception $e){
   echo json_encode(array('try_err'=> $e.getMessage()));
  };