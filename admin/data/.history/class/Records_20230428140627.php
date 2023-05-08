<?php
class Records {	
   
	private $recordsTable = 'tblclient';
	public $id;
    public $devid;
    public $name;
    public $package;
	public $paymeth;
	public $autopay;
	public $amount;
	public $notes;
	public $tos;
	public $sla;
	public $pwned;
	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	    
	
	public function listRecords(){
		
		$sqlQuery = "SELECT * FROM ".$this->recordsTable." ";
		if(!empty($_POST["search"]["value"])){
			$sqlQuery .= 'where(id LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR devid LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR duedate LIKE "%'.$_POST["search"]["value"].'%" ';				
			$sqlQuery .= ' OR name LIKE "%'.$_POST["search"]["value"].'%" ';				
			$sqlQuery .= ' OR package LIKE "%'.$_POST["search"]["value"].'%" ';			
			$sqlQuery .= ' OR paymeth LIKE "%'.$_POST["search"]["value"].'%" ';			
			$sqlQuery .= ' OR autopay LIKE "%'.$_POST["search"]["value"].'%" ';			
			$sqlQuery .= ' OR amount LIKE "%'.$_POST["search"]["value"].'%" ';			
			$sqlQuery .= ' OR notes LIKE "%'.$_POST["search"]["value"].'%" ';			
			$sqlQuery .= ' OR tos LIKE "%'.$_POST["search"]["value"].'%" ';			
			$sqlQuery .= ' OR sla LIKE "%'.$_POST["search"]["value"].'%" ';			
			$sqlQuery .= ' OR pwned LIKE "%'.$_POST["search"]["value"].'%") ';			
		}
		
		if(!empty($_POST["order"])){
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY id DESC ';
		}
		
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}
		
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();	
		
		$stmtTotal = $this->conn->prepare("SELECT * FROM ".$this->recordsTable);
		$stmtTotal->execute();
		$allResult = $stmtTotal->get_result();
		$allRecords = $allResult->num_rows;
		
		$displayRecords = $result->num_rows;
		$records = array();		
		while ($record = $result->fetch_assoc()) { 				
			$rows = array();			
			$rows[] = $record['id'];
			$rows[] = $record['devid'];
			$rows[] = $record['duedate'];
			$rows[] = ucfirst($record['name']);
			$rows[] = $record['package'];		
			$rows[] = $record['paymeth'];	
			$rows[] = $record['autopay'];
			$rows[] = $record['empty'];					
			$rows[] = $record['notes'];					
			$rows[] = $record['tos'];					
			$rows[] = $record['sla'];					
			$rows[] = $record['pwned'];										
			$rows[] = '<button type="button" name="update" id="'.$record["id"].'" class="btn btn-warning btn-xs update">Update</button>';
			$rows[] = '<button type="button" name="delete" id="'.$record["id"].'" class="btn btn-danger btn-xs delete" >Delete</button>';
			$records[] = $rows;
		}
		
		$output = array(
			"draw"	=>	intval($_POST["draw"]),			
			"iTotalRecords"	=> 	$displayRecords,
			"iTotalDisplayRecords"	=>  $allRecords,
			"data"	=> 	$records
		);
		
		echo json_encode($output);
	}
	
	public function getRecord(){
		if($this->id) {
			$sqlQuery = "
				SELECT * FROM ".$this->recordsTable." 
				WHERE id = ?";			
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->bind_param("i", $this->id);	
			$stmt->execute();
			$result = $stmt->get_result();
			$record = $result->fetch_assoc();
			echo json_encode($record);
		}
	}
	public function updateRecord(){
		
		if($this->id) {			
			
			$stmt = $this->conn->prepare("
			UPDATE ".$this->recordsTable." 
			SET devid= ?, duedate = ?, name = ?, package = ?, paymeth = ?, autopay = ?, amount = ?, notes = ?, tos = ?, sla = ?, pwned = ?
			WHERE id = ?");
	 
			$this->id = htmlspecialchars(strip_tags($this->id));
			$this->devid = htmlspecialchars(strip_tags($this->devid));
			$this->duedate = htmlspecialchars(strip_tags($this->duedate));
			$this->name = htmlspecialchars(strip_tags($this->name));
			$this->package = htmlspecialchars(strip_tags($this->package));
			$this->paymeth = htmlspecialchars(strip_tags($this->paymeth));
			$this->autopay = htmlspecialchars(strip_tags($this->autopay));
			$this->amount = htmlspecialchars(strip_tags($this->amount));
			$this->notes = htmlspecialchars(strip_tags($this->notes));
			$this->tos = htmlspecialchars(strip_tags($this->tos));
			$this->sla = htmlspecialchars(strip_tags($this->sla));
			$this->pwned = htmlspecialchars(strip_tags($this->pwned));;
			
			
			$stmt->bind_param("sssssssssssi", $this->devid, $this->duedate, $this->name, $this->package, $this->paymeth, $this->autopay, $this->amount, $this->notes, $this->tos, $this->sla, $this->pwned, $this->id);
			
			if($stmt->execute()){
				return true;
			}
			
		}	
	}
	public function addRecord(){
		
		if($this->name) {

			$stmt = $this->conn->prepare("
			INSERT INTO ".$this->recordsTable."(`devid`, `duedate`, `name`, `package`, `paymeth`, `autopay`, `amount`, `notes`, `tos`, `sla`, `pwned`)
			VALUES(?,?,?,?,?,?,?,?,?,?,?)");
		
			$this->devid = htmlspecialchars(strip_tags($this->devid));
			$this->duedate = htmlspecialchars(strip_tags($this->duedate));
			$this->name = htmlspecialchars(strip_tags($this->name));
			$this->package = htmlspecialchars(strip_tags($this->package));
			$this->paymeth = htmlspecialchars(strip_tags($this->paymeth));
			$this->autopay = htmlspecialchars(strip_tags($this->autopay));
			$this->amount = htmlspecialchars(strip_tags($this->amount));
			$this->notes = htmlspecialchars(strip_tags($this->notes));
			$this->tos = htmlspecialchars(strip_tags($this->tos));
			$this->sla = htmlspecialchars(strip_tags($this->sla));
			$this->pwned = htmlspecialchars(strip_tags($this->pwned));
			
			
			$stmt->bind_param("sssssssssss", $this->devid, $this->duedate, $this->name, $this->package, $this->paymeth, $this->autopay, $this->amount, $this->notes, $this->tos, $this->sla, $this->pwned);
			
			if($stmt->execute()){
				return true;
			}		
		}
	}
	public function deleteRecord(){
		if($this->id) {			

			$stmt = $this->conn->prepare("
				DELETE FROM ".$this->recordsTable." 
				WHERE id = ?");

			$this->id = htmlspecialchars(strip_tags($this->id));

			$stmt->bind_param("i", $this->id);

			if($stmt->execute()){
				return true;
			}
		}
	}
}
?>