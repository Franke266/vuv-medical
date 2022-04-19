<?php 
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 header('Access-Control-Allow-Methods: POST');
 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

 include_once '../../includes/connection.php';
   include_once '../../models/pregledi.php';

 $database = new Database();
 $db = $database->connect();

 $oPregledi = new Pregled($db);

 $data = json_decode(file_get_contents("php://input"));
 
 $oPregledi->oib = $data->oib;
 $oPregledi->razlog = $data->razlog;
 $oPregledi->opis = $data->opis;
 $oPregledi->termin = $data->termin;
 $oPregledi->status = $data->status;
 $oPregledi->doktor = $data->doktor;

 try{
  $oPregledi->create();
  echo json_encode(array('message' => 'Pregled uspješno naručen'));
 }catch(Exception $e){
  echo json_encode(array(
   'message' => 'Došlo je do pogreške kod naručivanja na pregled.',
   'error' => $e.getMessage()
 ));
 }
 
?>