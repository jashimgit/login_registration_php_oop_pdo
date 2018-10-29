<?php
// Include config 
include '../inc/Database.php';

$db = new Database();



// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM tbl_user WHERE username = :username";

        if($stmt = $db->dbh->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        unset($stmt);
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 3){
        $password_err = "Password must have atleast 3 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO tbl_user (username, password) VALUES (:username, :password)";

        if($stmt = $db->dbh->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);

            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location:users/login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        unset($stmt);
    }

    // Close connection
    unset($db);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sign Up</title>
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	
	<style type="text/css">
		body{ font: 14px sans-serif; }
		.wrapper{ width: 350px; padding: 20px; }
		.wrapper form {
			margin: 0 auto;
		}
	</style>
</head>
<body>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <h2>Create An Account</h2>
                <p>Please fill out this form to register</p>
                <form action="" method="post">
                    <div class="form-group  <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control">
                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                        <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                    </div>
                    <div class="row">
                       <div class="col">
                           <input type="submit" value="Register" class="btn btn-success btn-block">
                       </div>
                       <div class="col">
                           <a href="login.php" class="btn btn-light btn-block">Have an account? Login</a>
                       </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    

<!--    
<div class="wrapper">
	<h2>Create an Account</h2>
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
			<input type="submit" class="btn btn-primary" value="register">
			<input type="reset" class="btn btn-default" value="Reset">
		</div>
		<p>Already have an account? <a href="login.php">Login here</a>.</p>
	</form>
</div>
-->
</body>
</html>