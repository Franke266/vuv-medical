<?php 
  // Headers
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
  include_once '../../includes/connection.php';
  include_once '../../models/pacijenti.php';

  $database = new Database();
  $db = $database->connect();

  $oPacijenti = new Pacijent($db);

  try{
   $result = $oPacijenti->read();
   $num = $result->rowCount();

   if($num >0){
    $pacijent_arr = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
     extract($row);
     $pacijent_item = array(
      'id'=> $id,
      'imep' => $imep,
      'prezimep' => $prezimep,
      'doktor' => $doktor,
      'uloga' => $uloga
     );
     array_push($pacijent_arr, $pacijent_item);
    }
    echo json_encode($pacijent_arr);
   }else{
    echo json_encode(array(
     'message' => 'Pacijenti nisu pronađeni'
    ));
   }
  }catch(Exception $e){
   echo json_encode(array('try_err'=> $e.getMessage()));
  };
  