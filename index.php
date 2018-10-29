<?php
// Initialize the session

// session_start();

// // Check if the user is logged in, if not then redirect him to login page
// if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
// 	header("location: login.php");
// 	exit;
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<style type="text/css">
		body{ font: 14px sans-serif; text-align: center; }
	</style>
</head>
<body>
<div class="page-header">
	<div class="row">
		<div class="card card-body bg-dark mx-auto">
		<h1>Hi,</b>. Welcome to our site.</h1>
		</div>
	</div>
	
</div>

</body>
</html>