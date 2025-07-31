
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Password</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                include('dbcon.php');

                class SelectUserData {
                    private $conn;
                    public function __construct($conn) {
                        $this->conn = $conn;

                        if ($this->conn->connect_error) {
                            die("Connection failed: " . $this->conn->connect_error);
                        }
                    }

                    public function getUser() {
                        $sql = "SELECT * FROM users";
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

                $userData = new SelectUserData($conn);
                $users = $userData->getUser(); // Retrieve user data

                $x = 1;
                foreach ($users as $user) {
            ?>
                <tr>
                    <td><?php echo $x++; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['userpass']; ?></td>
                    <td><?php echo $user['usertype']; ?></td>
                    <td><a href="deleteuser.php?id=<?php echo $user['userid'];?>" class="btn btn-danger">Delete</a>&nbsp;<a href="edituser.php?id=<?php echo $user['userid'];?>" class="btn btn-info">Update</a></td>
                </tr>
            <?php
                }
            ?>
        </tbody>
    </table>