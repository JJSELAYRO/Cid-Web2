<?php
include 'dbcon.php';
$uid = $_POST['userid'];
$uname = $_POST['username'];
$upass = $_POST['userpass'];
$utype =$_POST['usertype'];


class updateUser{

		private $conn;
		private $uid;
		private $uname;
		private $utype;


		public function __construct($conn,$uid,$uname,$upass,$utype){
			$this->conn = $conn;
			$this->uname =$uname;
			$this->upass = $upass;
			$this->utype = $utype;
			$this->uid = $uid;
		}

		public function updateUserInfo(){
			$sql = "UPDATE users set username ='$this->uname', userpass = '$this->upass', usertype = '$this->utype' where userid = '$this->uid'";
			$result = $this->conn->query($sql);
			return $result;
		}
}

$updateInfo = new updateUser($conn,$uid,$uname,$upass,$utype);
$updateInfo->updateUserInfo();
header('location:selectuser.php');
?>