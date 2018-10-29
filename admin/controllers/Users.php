<?php

/**
 *  users Class 
 *  Validate data for login and register system
 */

include '../inc/Database.php';

class  Users
{
	public $db; 

	public function __construct(){
		$this->db = new Database();
	}


	public function register(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			// Sanitize data 
		 $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			// Init data 
			$data = [
				'username' => trim($_POST['username']),
				'password' => trim($_POST['password']), 
				'confirm_password' => trim($_POST['confirm_password']),
				'username_err' => '',
				'password_err' => '',
				'confirm_password_err' => ''
			];
			// Validate username  
			if(empty(trim($_POST['username']))){
			    $data['username_err'] = "Please enter a username.";
			    } else{
			        // Prepare a select statement
			        $sql = "SELECT id FROM tbl_user WHERE username = :username";

			        if($sth = $this->db->dbh->prepare($sql)){
			            // Bind variables to the prepared statement as parameters
			            $sth->bindParam(":username", $param_username, PDO::PARAM_STR);

			            // Set parameters
			            $param_username = trim($_POST['username']);

			            // Attempt to execute the prepared statement
			            if($sth->execute()){
			                if($sth->rowCount() == 1){
			                     $data['username_err'] = "This username is already taken.";
			                } else{
			                    $data['username'] = trim($_POST['username']);
			                }
			            } else{
			                echo "Oops! Something went wrong. Please try again later.";
			            }
			        }
			        // Close statement
			        unset($sth);
			    }
			

			// Validate password 
			if(empty(trim($_POST['password']))){
		        $password_err = "Please enter a password.";
		    	} elseif(strlen(trim($_POST['password'])) < 3){
		    		$data['password_err'] = "Password must have at least 3 characters.";
		    	} else {
		        	$data['password'] = trim($_POST['password']);
		    	}

			// check if errors are empty 

			if (empty($data['username_err']) && empty($data['password_err']) &&  empty($data['confirm_password_err'])) {
				// prepare a select statement 
			 	$sql = "INSERT INTO tbl_user (username, password) VALUES (:username, :password)";

				if ($sth = $this->db->dbh->prepare($sql)) {

					// Bind values with params
					$sth->bindParam(":username", $param_username, PDO::PARAM_STR);
					$sth->bindParam(":password", $param_password, PDO::PARAM_STR);

					// Set parameters
					$param_username = trim($data['username']);
					$param_password = password_hash($data['password'], PASSWORD_DEFAULT);

					// Attempt to execute the prepared statement 
					if ($sth->execute()) {
						// Redirect to login page
						header('location:login.php');
					} else {

						echo "something went wrong ";
					}
				}
				// Close statement
				unset($sth);
			}
			

		} else {
			// Init data 
			$data = [
				'username' => '',
				'password' => '', 
				'confirm_password' => '',
				'username_err' => '',
				'password_err' => '',
				'confirm_password_err' => ''
			];

			// load register page
			header('location:register.php');
		}
	} // end of register method


	public function  login() {
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			// Sanitize data 
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			// Init data 
			$data = [
				'username' => trim($_POST['username']),
				'password' => trim($_POST['password']),
				'username_err' => '',
				'password_err' => ''
			];
			// Validate username 
				if(empty(trim($_POST['username']))){
					$data['username_err'] = "Please enter your username";
				}else{
					$data['username'] = trim($_POST['username']);
				} // end of username validation 
			// Validate password 
				if(empty(trim($_POST['password']))){
					$data['password_err'] = "Please enter your password";
				} else {
					$data['password'] = trim($_POST['password']);
				} // end of password validation

			// Validate credentials 
			if(empty($data['username']) && empty($data['password'])){
				// prepare a select statement 
				$sql = "SELECT id, username, password FROM tbl_user WHERE username = :username";
				if($sth = $this->db->dbh->prepare($sql)){
					// Bind values with params 
					$sth->bindParam(":username", $param_username, PDO::PARAM_STR);$sth->bindParam(":password", $param_password, PDO::PARAM_STR);

					// Set parameters 
					$param_username = trim($data['username']);
					$param_password = trim($data['password']);
					// Attempt to execute prepared statement
					if($sth->execute()){
						// check if the username exists, if yes then verify password 
						if($sth->rowCount() < 0 ){
							if($row = $sth->fetch()){
								$id = $row['id'];
								$username = $row['username'];
								$hashpassword = $row['password'];
								if(password_verify($password, $hashed_password)){
									// password is correct , so start a new session 
									Session::init();
									// Set data in Session 
									Session::set('login', true);
									Session::set('id', $id);
									Session::set('username', $username);
									Session::set('loginmsg', "<div class='alert alert-success'> Login successfull </div>");

									// Redirect user to welcome page
									header('location:../index.php');
								} else {
									$data['password_err'] = "Password did not match";
								}
							}
						}
					}
				} else{
					echo "Data not found";
				}

			}
		} else {
			// Init data 
			$data = [
				'username' => '',
				'password' => '',
				'username_err' => '',
				'password_err' => ''
			];
			
			// Load login page
			header('location:login.php');

		} // end of server request checking 

	} // end of ligin method 
}