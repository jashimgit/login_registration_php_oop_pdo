<?php

// Include config 
include 'inc/Database.php';
$db = new Database();

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Process form data when form is submitted 
if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	// Validate username 
	if(empty(trim($_POST['username']))){
		$username_err = "Please enter a username";
	} else {
		// Prepare a select statement 
		$sql = "SELECT id FROM tbl_user WHERE usename = :username";

		if($stmt = $db->dbh->prepare($sql)){

			// bind value with prepared statement as parameters
			$stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

			// Set Parameters 
			$param_username = trim($_POST['username']);

			// Attempt to execute the prepared statement
			if($stmt->execute()){
				if($stmt->rowCount() == 1 ){
					$username_err = "Username already exists";
				} else {
					$username = trim($_POST['username']);
				}
			} else {
				echo "Opps !! Something went wrong.";
			}
		}
		// Close statement 
		unset($stmt);
	}
	// validate Password 
	if(empty(trim($_POST['password']))){
		$password_err = "Please enter a password";
	} elseif(strlen(trim($_POST['password'])) < 3 ){
		$password_err = "Password must have atleast 3 chracters";
	} else{
		$password = trim($_POST['password']);
	}
	// Validate confirm password
	if(empty(trim($_POST['confirm_password']))){
		$password_err = "Please confirm password";
	} else {
		$confirm_password = trim($_POST['confirm_password']);
		if(empty($password_err) && ($password != $confirm_password)){
			$confirm_password_err = "Password did not matched";
		}
	}

	// Check input errors before inserting in database 
	if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
		// Prepare as inser statement 
		$sql = "INSERT INTO tbl_user (username, password) VALUES (:username, :password)";
		if($stmt = $db->dbh->prepare($sql)){
			//Bind values with prepared statement as parameters 
			$stmt->bindParam(':username', $param_username, PDO::PARAM_STR);
			$stmt->bindParam(':password', $param_password, PDO::PARAM_STR);

			// Set parameters 
			$param_username = $username;
			$param_password = password_hash($password, PASSWORD_DEFAULT); // CREATES A PASSWORD HASH
			// Attempt to execute the prepared statement 
			if($stmt->execute()){
				// Redirec to login page 
				header('location:login.php');
			} else {
				echo "Something went wrong !!";
			}

		}
		// Close statement 
		unset($stmt);
	}
	unset($dbh);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sign Up</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	
	<style type="text/css">
		body{ font: 14px sans-serif; }
		.wrapper{ width: 350px; padding: 20px; }
		.wrapper form {
			margin: 0 auto;
		}
	</style>
</head>
<body>
<div class="wrapper">
	<h2>Sign Up</h2>
	<p>Please fill this form to create an account.</p>
	<form action="" method="post">
		<div class="form-group  <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
			<label>Username</label>
			<input type="text" name="username" class="form-control">
			<span class="help-block"><?php echo $username_err; ?></span>
		</div>
		<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
			<label>Password</label>
			<input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
			<span class="help-block"><?php echo $password_err; ?></span>
		</div>
		<div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
			<label>Confirm Password</label>
			<input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
			<span class="help-block"><?php echo $confirm_password_err; ?></span>
		</div>
		<div class="form-group">
			<input type="submit" class="btn btn-primary" value="Submit">
			<input type="reset" class="btn btn-default" value="Reset">
		</div>
		<p>Already have an account? <a href="login.php">Login here</a>.</p>
	</form>
</div>
</body>
</html>