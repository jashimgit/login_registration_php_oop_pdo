<?php
// Include config 

include '../controllers/Users.php';
// var_dump($_POST);
$user = new Users();
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['register']){
    $data = $user->register($_POST);
    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sign Up</title>
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	
	<style type="text/css">
		body{ font: 14px Sans-Sherif; }
		
	</style>
</head>
<body>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <h2>Create An Account</h2>
                <p>Please fill out this form to register</p>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                
                    <div class="form-group  <?php echo (!empty($data['username_err'])) ? 'is-invalid' : ''; ?>">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control">
                        <span class="invalid-feedback"><?php echo $data['username_err']; ?></span>
                    </div>
                
                    <div class="form-group <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                        <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                    </div>
                
                    <div class="form-group <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control">
                        <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
                    </div>
                
                    <div class="row">
                       <div class="col">
                           <input type="submit" value="Register" name="register" class="btn btn-success btn-block">
                       </div>
                       <div class="col">
                           <a href="login.php" class="btn btn-light btn-block">Have an account? Login</a>
                       </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    

</body>
</html>