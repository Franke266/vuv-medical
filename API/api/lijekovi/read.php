<?php 
    // Headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../includes/connection.php';
    include_once '../../models/lijekovi.php';

  $database = new Database();
  $db = $database->connect();

  $oLijekovi = new Lijek($db);

  try{
   $result = $oLijekovi->read();
   $num = $result->rowCount();

   if($num > 0){
    $lijekovi_arr = array();
    
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
     extract($row);

     $lijekovi_item = array(
      'id'=> $id,
      'oib' => $oib,
      'imep' => $imep,
      'prezimep' => $prezimep,
      'vrsta' => $vrsta,
      'status' => $status,
      'doktor' => $doktor
     );

     array_push($lijekovi_arr, $lijekovi_item);
    }
    echo json_encode($lijekovi_arr);
   }else{
    echo json_encode(array('message'=>'Lijekovi nisu pronađeni'));
   }
  }catch(Exception $e){
   echo json_encode(array('try_err'=> $e.getMessage()));
  };