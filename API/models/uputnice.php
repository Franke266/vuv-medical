<?php
 class Uputnica{
  //db stuff
  private $conn;
  private $table = 'uputnice';

  //props
  public $id;
  public $oib;
  public $specijalist;
  public $opis;
  public $status;
  public $doktor;
  public $imep;
  public $prezimep;

  public function __construct($db){
   $this->conn = $db;
  }

  public function read(){
   //query

   $query = 'SELECT u.id, u.oib, pa.imep, pa.prezimep, u.specijalist, u.opis, u.status, u.doktor FROM uputnice u LEFT JOIN pacijenti pa ON u.oib = pa.oib';
   
   $stmt = $this->conn->prepare($query);
   $stmt->execute();

   return $stmt;
  }

  public function readSingle(){
    $query = 'SELECT u.id, u.oib, pa.imep, pa.prezimep, u.specijalist, u.opis, u.status, u.doktor FROM '. $this->table . ' u LEFT JOIN pacijenti pa ON u.oib = pa.oib WHERE u.id = ?
    LIMIT 0,1;';

    $stmt = $this->conn->prepare($query);

    $stmt->bindValue(1, $this->id, PDO::PARAM_INT);

    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->oib = $row['oib'];
    $this->ime = $row['imep']; 
    $this->prezime = $row['prezimep']; 
    $this->specijalist = $row['specijalist'];
    $this->opis = $row['opis'];
    $this->status = $row['status'];
    $this->doktor = $row['doktor'];
    
  }

  public function update(){
    $query = 'UPDATE ' .$this->table.' SET  specijalist= :specijalist, status = :status WHERE id = :id';
    
    $stmt = $this->conn->prepare($query);

      $this->specijalist = htmlspecialchars(strip_tags($this->specijalist));
      $this->status = htmlspecialchars(strip_tags($this->status));
      $this->id = htmlspecialchars(strip_tags($this->id));
   
      $stmt->bindParam(':specijalist', $this->specijalist);
      $stmt->bindParam(':status', $this->status);
      $stmt->bindParam(':id', $this->id);
      if($stmt->execute()) {
        return true;
      }else{
       echo "Error code: " .$stmt->errorCode();
       return false;
      }

    
   }

   public function create(){
    $query = 'INSERT INTO ' .$this->table.' SET oib = :oib, specijalist = :specijalist, opis = :opis, status = :status, doktor = :doktor';
    
    $stmt = $this->conn->prepare($query);
 
    $this->oib = htmlspecialchars(strip_tags($this->oib));
    $this->specijalist = htmlspecialchars(strip_tags($this->specijalist));
    $this->opis = htmlspecialchars(strip_tags($this->opis));
    $this->status = htmlspecialchars(strip_tags($this->status));
    $this->doktor = htmlspecialchars(strip_tags($this->doktor));
 
    $stmt->bindParam(':oib', $this->oib);
    $stmt->bindParam(':specijalist', $this->specijalist);
    $stmt->bindParam(':opis', $this->opis);
    $stmt->bindParam(':status', $this->status);
    $stmt->bindParam(':doktor', $this->doktor);
 
    if($stmt->execute()) {
      return true;
    }else{
     print_r($stmt->errorInfo()); 
     return false;
    }
   }

 }