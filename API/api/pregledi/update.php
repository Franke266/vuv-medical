<?php 
   // Headers
   header('Access-Control-Allow-Origin: *');
   header('Content-Type: application/json');
   header('Access-Control-Allow-Methods: PUT');
   header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
   
   include_once '../../includes/connection.php';
   include_once '../../models/pregledi.php';

 $database = new Database();
 $db = $database->connect();

 $oPregled = new Pregled($db);

 $data = json_decode(file_get_contents("php://input"));
 
 $oPregled->id = $data->id;
 $oPregled->oib = $data->oib;
 $oPregled->razlog = $data->razlog;
 $oPregled->opis = $data->opis;
 $oPregled->termin = $data->termin;
 $oPregled->status = $data->status;
 $oPregled->doktor = $data->doktor;

 if($oPregled->update()){
  echo json_encode(array('message' => 'Pregled uspješno ažuriran'));
 }else{
  echo json_encode(array('message' => 'Pregled neuspješno ažuriran'));
 }
?>