<?php
class Database{
	
	private $host  = 'localhost';
  //  private $user  = 'root';
    private $user  = 'pcrtnmco_rtracker';
   // private $password   = "";
    private $password   = "sjnFb?fn;F(A";
   //private $database  = "test"; 
    private $database  = "pcrtnmco_pcrepairtracker_v9.6"; 
    
    public function getConnection(){		
		$conn = new mysqli($this->host, $this->user, $this->password, $this->database);
		if($conn->connect_error){
			die("Error failed to connect to MySQL: " . $conn->connect_error);
		} else {
			return $conn;
		}
    }
}
?>