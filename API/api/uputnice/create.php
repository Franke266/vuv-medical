<?php 
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 header('Access-Control-Allow-Methods: POST');
 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

 include_once '../../includes/connection.php';
   include_once '../../models/uputnice.php';

 $database = new Database();
 $db = $database->connect();

 $oUputnice = new Uputnica($db);

 $data = json_decode(file_get_contents("php://input"));
 
 $oUputnice->oib = $data->oib;
 $oUputnice->specijalist = $data->specijalist;
 $oUputnice->opis = $data->opis;
 $oUputnice->status = $data->status;
 $oUputnice->doktor = $data->doktor;

 try{
    $oUputnice->create();
  echo json_encode(array('message' => 'Uputnica uspješno zatrazena'));
 }catch(Exception $e){
  echo json_encode(array(
   'message' => 'Došlo je do pogreške kod zatrazivanja uputnice.',
   'error' => $e.getMessage()
 ));
 }
 
?>