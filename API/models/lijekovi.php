<?php
 class Lijek{
  //db stuff
  private $conn;
  private $table = 'lijekovi';

  //props
  public $id;
  public $oib;
  public $vrsta;
  public $status;
  public $doktor;
  public $imep;
  public $prezimep;

  public function __construct($db){
   $this->conn = $db;
  }

  public function read(){
   //query

   $query = 'SELECT l.id, l.oib, pa.imep, pa.prezimep, l.vrsta, l.status, l.doktor FROM lijekovi l LEFT JOIN pacijenti pa ON l.oib = pa.oib';
   
   $stmt = $this->conn->prepare($query);
   $stmt->execute();

   return $stmt;
  }

  public function readSingle(){
    $query = 'SELECT l.id, l.oib, pa.imep, pa.prezimep, l.vrsta, l.status, l.doktor FROM '. $this->table . ' l LEFT JOIN pacijenti pa ON l.oib = pa.oib WHERE l.id = ?
    LIMIT 0,1;';

    $stmt = $this->conn->prepare($query);

    $stmt->bindValue(1, $this->id, PDO::PARAM_INT);

    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->oib = $row['oib'];
    $this->imep = $row['imep']; 
    $this->prezimep = $row['prezimep']; 
    $this->vrsta = $row['vrsta'];
    $this->status = $row['status'];
    $this->doktor = $row['doktor'];
    
  }

  public function update(){
    $query = 'UPDATE ' .$this->table.' SET status = :status WHERE id = :id';
    
    $stmt = $this->conn->prepare($query);
 
    $this->status = htmlspecialchars(strip_tags($this->status));
    $this->id = htmlspecialchars(strip_tags($this->id));
 
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
    $query = 'INSERT INTO ' .$this->table.' SET oib = :oib, vrsta = :vrsta, status = :status, doktor = :doktor';
    
    $stmt = $this->conn->prepare($query);
 
    $this->oib = htmlspecialchars(strip_tags($this->oib));
    $this->vrsta = htmlspecialchars(strip_tags($this->vrsta));
    $this->status = htmlspecialchars(strip_tags($this->status));
    $this->doktor = htmlspecialchars(strip_tags($this->doktor));
 
    $stmt->bindParam(':oib', $this->oib);
    $stmt->bindParam(':vrsta', $this->vrsta);
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