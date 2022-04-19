<?php
   // Headers
   header("Access-Control-Allow-Origin: *");
   header("Access-Control-Allow-Headers: access");
   header("Content-Type: application/json; charset=UTF-8");
   header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
   
   include_once '../../includes/connection.php';
   include_once '../../models/lijekovi.php';

 $database = new Database();
 $db = $database->connect();

 $oLijek = new Lijek($db);

 $oLijek->id = isset($_GET['id']) ? $_GET['id'] : die();
 try{
  $oLijek->readSingle();
   $lijek_arr = array(
    'id'=>$oLijek->id,
    'oib'=>$oLijek->oib,
    'vrsta'=>$oLijek->vrsta,
    'status'=>$oLijek->status,
    'doktor'=>$oLijek->doktor,
    'imep'=>$oLijek->imep,
    'prezimep'=>$oLijek->prezimep,
   );
   echo json_encode($lijek_arr);
 }catch(Exception $e){
  echo json_encode(array(
   "message" => "Došlo je do pogreške kod učitavanja podataka o lijeku.",
   "error" => $e->getMessage()
  ));
 };