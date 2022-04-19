<?php 
 include_once('osoba.php');
 class Pacijent extends Osoba{
  private $conn;
  private $table='pacijenti';

  public $id;
  public $imep;
  public $prezimep;
  public $oib;
  public $doktor;
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