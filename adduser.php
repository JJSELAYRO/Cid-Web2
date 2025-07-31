
	<form method="post" action="adduserprocess.php">
								  <div class="mb-3">
								    <label for="exampleInputEmail1" class="form-label">Username</label>
								    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="uname" required>
								   </div>
								  <div class="mb-3">
								    <label for="exampleInputPassword1" class="form-label">User Password</label>
								    <input type="password" class="form-control" id="exampleInputPassword1" name="upass" required>
								  </div>
								  <div class="mb-3">
								    <label for="exampleInputPassword1" class="form-label">User Type</label>
								  	<select class="form-control" name="utype" required>
								  		<option></option>
								  		<option value="Admin">Admin</option>
								  		<option value="Staff">Staff</option>
								  	</select>
								  </div>

								 
								  <button type="submit" class="btn btn-danger">Submit</button>
</form>