<?php 
  // Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//require __DIR__ . '/includes/connection.php';
include_once '../../includes/connection.php';
include_once '../../models/doktori.php';


  $database = new Database();
  $db = $database->connect();

  $oDoktori = new Doktor($db);

  try{
   $result = $oDoktori->read();
   $num = $result->rowCount();

   if($num >0){
    $doktor_arr = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
     extract($row);
     $doktor_item = array(
      'id'=> $id,
      'ime' => $ime,
      'prezime' => $prezime,
      'oib' => $oib,
      'uloga' => $uloga
     );
     array_push($doktor_arr, $doktor_item);
    }
    echo json_encode($doktor_arr);
   }else{
    echo json_encode(array(
     'message' => 'Doktori nisu pronađeni'
    ));
   }
  }catch(Exception $e){
   echo json_encode(array('try_err'=> $e.getMessage()));
  };
  