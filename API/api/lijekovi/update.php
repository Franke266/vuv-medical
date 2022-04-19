<?php 
   // Headers
   header('Access-Control-Allow-Origin: *');
   header('Content-Type: application/json');
   header('Access-Control-Allow-Methods: PUT');
   header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
   
   include_once '../../includes/connection.php';
   include_once '../../models/lijekovi.php';

 $database = new Database();
 $db = $database->connect();

 $oLijek = new Lijek($db);

 $data = json_decode(file_get_contents("php://input"));
 
 $oLijek->id = $data->id;
 $oLijek->oib = $data->oib;
 $oLijek->vrsta = $data->vrsta;
 $oLijek->status = $data->status;
 $oLijek->doktor = $data->doktor;

 if($oLijek->update()){
  echo json_encode(array('message' => 'Narudzba za lijek uspješno ažurirana'));
 }else{
  echo json_encode(array('message' => 'Narudzba za lijek neuspješno ažurirana'));
 }
?>