<?php
    class Database  
				{
					private $host = 'localhost:3306';
					private $dbname = 'vuv_medical';
					private $username = 'root';
					private $password = '';
					private $conn;
					
					public function connect(){
					$this->conn = null;

						try{
							$this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname.';charset=utf8', $this->username, $this->password);
						}catch(PDOException $e){
							echo 'Connection Error:' . $e->getMessage();
						}
						return $this->conn;
				 }
			 }
?>