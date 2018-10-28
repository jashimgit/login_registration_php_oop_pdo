<?php
// include Database
require_once 'inc/Database.php';

// Define variables and initialize with empty values

$username = $password = "";
$username_err = $password_err = "";

// Process form data when form is submitted 
if($_SERVER['REQUEST_METHOD'] == "POST"){
    // Check if username is empty
    if(empty(trim($_POST['username']))){
        $username_err = "Please enter username";
    } else{
        $username = trim($_POST['username']);
    }

    // Check if password is empty 
    if(empty(trim($_POST['password']))){
        $password_err = "Please enter your password";
    } else {
        $password = trim($_POST['password']);
    }

    // Validate credentials 

    if(empty($username_err) && empty($password_err)){
        // prepare a select statement
        $sql = "SELECT id, username, password FROM tbl_user WHERE username = :username";
        if($stmt = $dbh->prepare($sql)){
            // bind value 
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            // Set parameters 
            $param_username = trim($_POST['username']);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // check if username exists , if yes then verify password
                if($stmt->rowCount() == 1 ){
                    if($row = $stmt->fetch()){
                        $id = $row['id'];
                        $username = $row['username'];
                        $hashed_password = $row['password'];
                        if(password_verify($password, $hashed_password)){
                            // password is correct , so start a new session
                            session_start();

                            // Store data in session
                            $_SESSION['loggedin'] = true;
                            $_SESSION['id'] = $id;
                            $_SESSION['username'] = $username;
                            // Redirect user to welcome page 
                            header('location: welcome.php');
                        } else {
                            $password_err = 'Password did not matched';
                        }
                    }
                }
            }else{

            }
        }else{
            echo "Data did not matched";
        }

    } else {
        echo "Data not found";
    }
} // end of form process 
    


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