<?php
include 'dbcon.php';

	$id = $_GET['id'];

 class deleteUser{
 	private $id;
 	private $conn;

 	public function __construct($id,$conn){
 		$this->conn = $conn;
 		$this->uid = $id;


 	}

 	public function delUser(){
	$sql = "DELETE from users where userid=$this->uid";
	$result = $this->conn ->query($sql);		
	return $result;
 	}
 }
$userdel = new deleteUser($id,$conn);
$userdel->delUser();
	header('location:selectUser.php');	
 ?>