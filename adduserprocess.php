<?php

include('dbcon.php');

$uname = $_POST['uname'];
$upass = $_POST['upass'];
$utype = $_POST['utype'];


	class AddUser{
		private $uname;
		private $upass;
		private $utype;
		private $conn;

		public function __construct($uname,$upass,$utype,$conn){
			$this->uname =$uname;
			$this->upass =$upass;
			$this->utype =$utype;
			$this->conn =$conn;
		}

		public function adduser(){
			$sql = "INSERT into users(username,userpass,usertype) values('$this->uname','$this->upass','$this->utype')";
			return	$result = $this->conn ->query($sql);
		}
	}

$addUser = new AddUser($uname,$upass,$utype,$conn);
$addUser ->adduser();
header('location:selectuser.php');
?>