<?php 
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 header('Access-Control-Allow-Methods: POST');
 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

 include_once '../../includes/connection.php';
   include_once '../../models/poruke.php';

 $database = new Database();
 $db = $database->connect();

 $oPoruke = new Poruka($db);

 $data = json_decode(file_get_contents("php://input"));
 
 $oPoruke->doktor = $data->doktor;
 $oPoruke->pacijent = $data->pacijent;
 $oPoruke->tekst = $data->tekst;

 try{
  $oPoruke->create();
  echo json_encode(array('message' => 'Poruka uspješno poslana'));
 }catch(Exception $e){
  echo json_encode(array(
   'message' => 'Došlo je do pogreške kod slanja poruke.',
   'error' => $e.getMessage()
 ));
 }
 
?>