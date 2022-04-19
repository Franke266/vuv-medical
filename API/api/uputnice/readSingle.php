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

 $oUputnica = new Uputnica($db);

 $oUputnica->id = isset($_GET['id']) ? $_GET['id'] : die();
 try{
    $oUputnica->readSingle();
   $pregled_arr = array(
    'id'=>$oUputnica->id,
    'oib'=>$oUputnica->oib,
    'specijalist'=>$oUputnica->specijalist,
    'opis'=>$oUputnica->opis,
    'status'=>$oUputnica->status,
    'doktor'=>$oUputnica->doktor,
    'imep'=>$oUputnica->imep,
    'prezimep'=>$oUputnica->prezimep,
   );
   echo json_encode($pregled_arr);
 }catch(Exception $e){
  echo json_encode(array(
   "message" => "Došlo je do pogreške kod učitavanja podataka o uputnici.",
   "error" => $e->getMessage()
  ));
 };