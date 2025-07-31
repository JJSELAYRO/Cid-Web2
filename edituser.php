<?php 
include('dbcon.php');

$id = $_GET['id'];

                class SelectUserData {
                    private $conn;
                    private $id;
                    public function __construct($conn,$id) {
                        $this->conn = $conn;
                        $this->userid=$id;

                        if ($this->conn->connect_error) {
                            die("Connection failed: " . $this->conn->connect_error);
                        }
                    }

                    public function getUser() {
                        $sql = "SELECT * FROM users where userid=$this->userid";
                        $result = $this->conn->query($sql);
                        $users = array();

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $users[] = $row;
                            }
                        }

                        return $users;
                    }
                }
                $userData = new SelectUserData($conn,$id);
                $users = $userData->getUser(); // Retrieve user data



?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<?php
		include('link-css.php');
		include('link-js.php');

	 ?>
</head>
<body>
 <form action="updateuser.php" method="POST">
 	<?php 
 	 $x = 1;
                foreach ($users as $user) {

                	?>
            <input type="hidden" name="userid" value="<?php echo $user['userid']; ?>" />
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" class="form-control" value="<?php echo $user['username']; ?>" required />
            </div>
            <div class="form-group">
                <label for="username">User	Password:</label>
                <input type="password" name="userpass" class="form-control" value="<?php echo $user['username']; ?>" required />
            </div>
            <div class="form-group">
                <label for="usertype">User Type:</label>
                <select name="usertype" class="form-control" required>
                    <option value="admin" <?php echo ($user['usertype'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                    <option value="user" <?php echo ($user['usertype'] == 'user') ? 'selected' : ''; ?>>User</option>
                </select>
            </div>
        <?php }?>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
</body>
</html>