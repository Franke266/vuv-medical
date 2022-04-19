<?php 
 include_once('osoba.php');
 class Doktor extends Osoba{
  private $conn;
  private $table='doktori';

  public $id;
  public $ime;
  public $prezime;
  public $oib;
  public $uloga;

  public function __construct($db){
   $this->conn = $db;
  }

  public function read(){
   $query = 'SELECT * FROM '.$this->table;
   $stmt = $this->conn->prepare($query);
   $stmt->execute();
   return $stmt;
  }
  
 }
?>