<?php 
   // Headers
   header('Access-Control-Allow-Origin: *');
   header('Content-Type: application/json');
   header('Access-Control-Allow-Methods: PUT');
   header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
   
   include_once '../../includes/connection.php';
   include_once '../../models/uputnice.php';

 $database = new Database();
 $db = $database->connect();

 $oUputnica = new Uputnica($db);

 $data = json_decode(file_get_contents("php://input"));
 
 $oUputnica->id = $data->id;
 $oUputnica->oib = $data->oib;
 $oUputnica->specijalist = $data->specijalist;
 $oUputnica->opis = $data->opis;
 $oUputnica->status = $data->status;
 $oUputnica->doktor = $data->doktor;

 if($oUputnica->update()){
  echo json_encode(array('message' => 'Uputnica uspješno zatražena'));
 }else{
  echo json_encode(array('message' => 'Uputnica neuspješno zatražena'));
 }
?>