<?php 
  // Headers
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
  include_once '../../includes/connection.php';
  include_once '../../models/poruke.php';

  $database = new Database();
  $db = $database->connect();

  $oPoruke = new Poruka($db);

  try{
   $result = $oPoruke->read();
   $num = $result->rowCount();

   if($num >0){
    $poruka_arr = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
     extract($row);
     $poruka_item = array(
      'id'=> $id,
      'doktor'=> $doktor,
      'pacijent'=> $pacijent,
      'ime' => $ime,
      'prezime' => $prezime,
      'imep' => $imep,
      'prezimep' => $prezimep,
      'tekst' => $tekst
     );
     array_push($poruka_arr, $poruka_item);
    }
    echo json_encode($poruka_arr);
   }else{
    echo json_encode(array(
     'message' => 'Poruke nisu pronađene'
    ));
   }
  }catch(Exception $e){
   echo json_encode(array('try_err'=> $e.getMessage()));
  };
  