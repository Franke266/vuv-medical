<?php
 class Pregled{
  //db stuff
  private $conn;
  private $table = 'pregledi';

  //props
  public $id;
  public $oib;
  public $razlog;
  public $opis;
  public $termin;
  public $status;
  public $doktor;
  public $imep;
  public $prezimep;

  public function __construct($db){
   $this->conn = $db;
  }

  public function read(){
   //query

   $query = 'SELECT pr.id, pr.oib, pa.imep, pa.prezimep, pr.razlog, pr.opis, pr.termin, pr.status, pr.doktor FROM pregledi pr LEFT JOIN pacijenti pa ON pr.oib = pa.oib';
   
   $stmt = $this->conn->prepare($query);
   $stmt->execute();

   return $stmt;
  }

  public function readSingle(){
    $query = 'SELECT pr.id, pr.oib, pa.imep, pa.prezimep, pr.razlog, pr.opis, pr.termin, pr.status, pr.doktor FROM '. $this->table . ' pr LEFT JOIN pacijenti pa ON pr.oib = pa.oib WHERE pr.id = ?
    LIMIT 0,1;';

    $stmt = $this->conn->prepare($query);

    $stmt->bindValue(1, $this->id, PDO::PARAM_INT);

    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->oib = $row['oib'];
    $this->ime = $row['imep']; 
    $this->prezime = $row['prezimep']; 
    $this->razlog = $row['razlog'];
    $this->opis = $row['opis'];
    $this->termin = $row['termin'];
    $this->status = $row['status'];
    $this->doktor = $row['doktor'];
    
  }

  public function update(){
    $query = 'UPDATE ' .$this->table.' SET  termin= :termin, status = :status WHERE id = :id';
    
    $stmt = $this->conn->prepare($query);

    $datum=$this->termin;
    $dan=substr($datum, 8, 2);
    $mjesec=substr($datum, 5, 2);
    $godina=substr($datum, 0, 4);
    $sati=substr($datum, 11, 2);
    $minute=substr($datum, 14, 2);

    $int = (int)$sati;
    $int2 = $int+2;
    $satiispravno=strval($int2);
    $datum2= $dan.'.'.$mjesec.'.'.$godina.', '.$satiispravno.':'.$minute;

      $datum2 = htmlspecialchars(strip_tags($datum2));
      $this->status = htmlspecialchars(strip_tags($this->status));
      $this->id = htmlspecialchars(strip_tags($this->id));
   
      $stmt->bindParam(':termin', $datum2);
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
    $query = 'INSERT INTO ' .$this->table.' SET oib = :oib, razlog = :razlog, opis = :opis, termin = :termin, status = :status, doktor = :doktor';
    
    $stmt = $this->conn->prepare($query);
 
    $this->oib = htmlspecialchars(strip_tags($this->oib));
    $this->razlog = htmlspecialchars(strip_tags($this->razlog));
    $this->opis = htmlspecialchars(strip_tags($this->opis));
    $this->termin = htmlspecialchars(strip_tags($this->termin));
    $this->status = htmlspecialchars(strip_tags($this->status));
    $this->doktor = htmlspecialchars(strip_tags($this->doktor));
 
    $stmt->bindParam(':oib', $this->oib);
    $stmt->bindParam(':razlog', $this->razlog);
    $stmt->bindParam(':opis', $this->opis);
    $stmt->bindParam(':termin', $this->termin);
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