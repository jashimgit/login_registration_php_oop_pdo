<?php
$filepath = realpath(dirname(dirname(__FILE__)));
include $filepath.'/helper/Session.php';


$loginMsg = Session::get('loginmsg');

if (isset($loginMsg)){
	echo $loginMsg;
}
if(isset($_GET['action']) && $_GET['action'] == 'logout'){
    Session::destroy();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/main.css">
	<!-- jquery link  -->
	<script src="bootstrap/js/jquery-3.2.0.min.js"></script>
	<!-- bootstrap core javascript link -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>
	

	<title>Admin Panel | Bootstrap V.3</title>
</head>
<body>
<nav class="navbar navbar-default">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">Brand</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li class="active"><a href="index.php">Dashboard <span class="sr-only">(current)</span></a></li>
				<li><a href="page.php">Pages</a></li>
				<li><a href="post.php">Posts</a></li>
				<li><a href="user.php">Users</a></li>
				</li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li> <a href="#"><strong>Welcome</strong><?php $name = Session::get('username');
                            if (isset($name)){
                                echo $name;
                            }
                        ?>
                    </a>

                </li>
				<li><a href="?action=logout">Log out</a></li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>


<header id="header">
	<div class="container">
		<div class="row">
			<div class="col-md-10">
				<h3> <span class="glyphicon glyphicon-cog"></span>   Dashboard <small>Manage your site</small></h3>
			</div>
			<div class="col-md-2">
				<div class="dropdown create">
					<button type="button" class="btn dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown">
						Create Content <span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
						<li><a type="button" data-toggle="modal" data-target="#addPage">Add Page</a></li>
						<li><a href="#">Add Post</a></li>
						<li><a href="#">Add User</a></li>


					</ul>
				</div>
			</div>
		</div>
	</div>
</header>