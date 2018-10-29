<?php
// include Database
require_once '../controllers/Users.php';
require_once '../helper/Session.php';


$user = new Users();
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['login']){
    $data = $user->login($_POST);
    // var_dump ($data);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <style type="text/css">
        body{ font: 14px sans-serif;}
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <h2>Login</h2>
                <p>Please fill up with your credentials</p>
                
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    
                    <div class="form-group <?php echo (!empty($data['username_err'])) ? 'is-invalid' : ''; ?>">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control">
                        <span class="invalid-feedback"><?php echo $data['username_err']; ?></span>
                    </div>
                    
                    <div class="form-group <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                        <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                    </div>
                    
                    <div class="row">
                       <div class="col">
                           <input type="submit" value="login" name="login" class="btn btn-success btn-block">
                       </div>
                       <div class="col">
                           <a href="register.php" class="btn btn-light btn-block">Don't have an account !! Register</a>
                       </div>
                    </div>

                    
                </form>
            </div>
        </div>
    </div>
</div>





























    .
    <!--
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>
-->
</body>
</html>
