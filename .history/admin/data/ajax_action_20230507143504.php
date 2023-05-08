<?php
include_once '.php';
// include_once 'config/Database.php';
include_once 'class/Records.php';

$database = new Database();
$db = $database->getConnection();

$record = new Records($db); 

if(!empty($_POST['action']) && $_POST['action'] == 'listRecords') {
	$record->listRecords();
}
if(!empty($_POST['action']) && $_POST['action'] == 'addRecord') {	
	$record->devid = $_POST["devid"];
    $record->duedate = $_POST["duedate"];
    $record->name = $_POST["name"];
	$record->package = $_POST["package"];
	$record->paymeth = $_POST["paymeth"];
	$record->autopay = $_POST["autopay"];
	//$record->amount = $_POST["amount"];
	$record->notes = $_POST["notes"];
	$record->tos = $_POST["tos"];
	$record->sla = $_POST["sla"];
	$record->pwned = $_POST["pwned"];
	$record->addRecord();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getRecord') {
	$record->id = $_POST["id"];
	$record->getRecord();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updateRecord') {
	$record->id = $_POST["id"];
	$record->devid = $_POST["devid"];
    $record->duedate = $_POST["duedate"];
    $record->name = $_POST["name"];
	$record->package = $_POST["package"];
	$record->paymeth = $_POST["paymeth"];
	$record->autopay = $_POST["autopay"];
	$record->amount = $_POST["amount"];
	$record->notes = $_POST["notes"];
	$record->tos = $_POST["tos"];
	$record->sla = $_POST["sla"];
	$record->pwned = $_POST["pwned"];
	$record->updateRecord();
}
if(!empty($_POST['action']) && $_POST['action'] == 'deleteRecord') {
	$record->id = $_POST["id"];
	$record->deleteRecord();
}
?>