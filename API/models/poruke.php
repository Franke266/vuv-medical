<?php
 class Poruka{
  //db stuff
  private $conn;
  private $table = 'poruke';

  //props
  public $id;
  public $doktor;
  public $pacijent;
  public $tekst;
  public $ime;
  public $prezime;
  public $imep;
  public $prezimep;

  public function __construct($db){
   $this->conn = $db;
  }

  public function read(){
   //query

   $query = 'SELECT p.id, p.doktor, p.pacijent, d.ime, d.prezime, pa.imep, pa.prezimep, p.tekst FROM poruke p LEFT JOIN doktori d ON p.doktor = d.oib LEFT JOIN pacijenti pa ON p.pacijent = pa.oib';
   
   $stmt = $this->conn->prepare($query);
   $stmt->execute();

   return $stmt;
  }

  public function readSingle(){
    $query = 'SELECT p.id, p.doktor, d.ime, d.prezime, p.pacijent, pa.imep, pa.prezimep, p.tekst FROM '. $this->table . ' p LEFT JOIN doktori d ON p.doktor LEFT JOIN pacijenti pa ON p.pacijent = pa.oib WHERE p.id = ?
    LIMIT 0,1;';

    $stmt = $this->conn->prepare($query);

    $stmt->bindValue(1, $this->id, PDO::PARAM_INT);

    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->doktor = $row['doktor'];
    $this->pacijent = $row['pacijent'];
    $this->tekst = $row['tekst'];
    
  }

  public function create(){
    $query = 'INSERT INTO ' .$this->table.' SET doktor = :doktor, pacijent = :pacijent, tekst = :tekst';
    
    $stmt = $this->conn->prepare($query);
    
    $this->doktor = htmlspecialchars(strip_tags($this->doktor));
    $this->pacijent = htmlspecialchars(strip_tags($this->pacijent));
    $this->tekst = htmlspecialchars(strip_tags($this->tekst));
    
    $stmt->bindParam(':doktor', $this->doktor);
    $stmt->bindParam(':pacijent', $this->pacijent);
    $stmt->bindParam(':tekst', $this->tekst);
 
    if($stmt->execute()) {
      return true;
    }else{
     print_r($stmt->errorInfo()); 
     return false;
    }
   }

 }