<?php 
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 header('Access-Control-Allow-Methods: POST');
 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Access-Control-Max-Age, Authorization, X-Requested-With');

 include_once '../../includes/connection.php';
   include_once '../../models/lijekovi.php';

 $database = new Database();
 $db = $database->connect();

 $oLijekovi = new Lijek($db);

 $data = json_decode(file_get_contents("php://input"));
 
 $oLijekovi->oib = $data->oib;
 $oLijekovi->vrsta = $data->vrsta;
 $oLijekovi->status = $data->status;
 $oLijekovi->doktor = $data->doktor;

 try{
  $oLijekovi->create();
  echo json_encode(array('message' => 'Lijekovi uspješno naručeni'));
 }catch(Exception $e){
  echo json_encode(array(
   'message' => 'Došlo je do pogreške kod naručivanja lijekova.',
   'error' => $e.getMessage()
 ));
 }
 
?>