<?php

$server = 'localhost';
$username ='root';
$password ='';
$dbname ='gabriel_db';
	class DBConn {
		private $server;
		private $username;
		private $password;
		private $dbname;
		public function __construct($server,$username,$password,$dbname){
			$this ->server = $server;
			$this ->username = $username;
			$this ->password = $password;
			$this ->dbname =$dbname;
		}
		public function conn(){
		$conn = new mysqli($this->server,$this ->username ,$this ->password,$this ->dbname);
		return $conn;

		}
	}
$connect = new DBConn($server,$username,$password,$dbname);
$conn = $connect->conn();

?>