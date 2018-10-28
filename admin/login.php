<?php
// include Database
require_once 'inc/Database.php';
$db = new Database();
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
        if($sth = $db->dbh->prepare($sql)){
            // bind value 
            $sth->bindParam(":username", $param_username, PDO::PARAM_STR);
            // Set parameters 
            $param_username = trim($_POST['username']);

            // Attempt to execute the prepared statement
            if($sth->execute()){
                // check if username exists , if yes then verify password
                if($sth->rowCount() == 1 ){
                    if($row = $sth->fetch()){
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
                            header('location:index.php');
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
    <title>Login</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
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
</body>
</html>