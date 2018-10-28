<?php
// include Database
require_once 'inc/Database.php';

// Define variables and initialize with empty values

$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    // Check if username is empty
    if (empty(trim($_POST['username']))){
        $username_err = "Please enter username";
    } else {
        $username = trim($_POST['username']);
    }
    // Check for password if it is empty

    if (empty(trim($_POST['password']))){
        $password_err = "Please enter your password";
    } else {
        $password = trim($_POST['password']);
    }


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap/css/main.css">
    <link rel="stylesheet" href="bootstrap/css/font-awesome.min.css">
    <title>Login</title>

</head>
<body>

<div class="form">
    <form action="login.php" method="post" enctype="multipart/form-data">
        <h2>Sign In</h2>


        <div class="input-box">
            <i class="fa fa-user" aria-hidden="true"></i>
            <input type="text" name="username" placeholder="Username">
        </div>
        <div class="input-box">
                <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                <input type="text" name="password" placeholder="Password">
        </div>
        <div class="input-box">
                
                <input type="submit" value="Login">
        </div>
    <a href="#">Forget password !!</a>
    </form>
</div>

    
</body>
</html>