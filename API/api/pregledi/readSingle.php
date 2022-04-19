<?php
   // Headers
   header("Access-Control-Allow-Origin: *");
   header("Access-Control-Allow-Headers: access");
   header("Content-Type: application/json; charset=UTF-8");
   header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
   
   include_once '../../includes/connection.php';
   include_once '../../models/pregledi.php';

 $database = new Database();
 $db = $database->connect();

 $oPregled = new Pregled($db);

 $oPregled->id = isset($_GET['id']) ? $_GET['id'] : die();
 try{
    $oPregled->readSingle();
   $pregled_arr = array(
    'id'=>$oPregled->id,
    'oib'=>$oPregled->oib,
    'razlog'=>$oPregled->razlog,
    'opis'=>$oPregled->opis,
    'termin'=>$oPregled->termin,
    'status'=>$oPregled->status,
    'doktor'=>$oPregled->doktor,
    'imep'=>$oPregled->imep,
    'prezimep'=>$oPregled->prezimep,
   );
   echo json_encode($pregled_arr);
 }catch(Exception $e){
  echo json_encode(array(
   "message" => "Došlo je do pogreške kod učitavanja podataka o pregledu.",
   "error" => $e->getMessage()
  ));
 };