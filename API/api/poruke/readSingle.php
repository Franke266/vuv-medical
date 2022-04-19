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

 $oPoruka = new Poruka($db);

 $oPoruka->id = isset($_GET['id']) ? $_GET['id'] : die();
 try{
    $oPoruka->readSingle();
   $poruka_arr = array(
    'id'=>$oPoruka->id,
    'doktor'=>$oPoruka->doktor,
    'pacijent'=>$oPoruka->pacijent,
    'tekst'=>$oPoruka->tekst,
   );
   echo json_encode($poruka_arr);
 }catch(Exception $e){
  echo json_encode(array(
   "message" => "Došlo je do pogreške kod učitavanja poruke.",
   "error" => $e->getMessage()
  ));
 };