<?php  
	session_start();
	if(!(isset($_SESSION['user'])))
		header("Location: login.php");
	else {
		$user = $_SESSION['user'];
	}
?>
<html> <DOCTYPE html>
	<head>
		<title>Unisapp | ADMIN</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="bootstrap-5.0.0-beta3-dist/css/bootstrap-theme.min.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="bootstrap-5.0.0-beta3-dist/js/bootstrap.min.js" ></script>
	</head>
	<style>
		.vertical-200{
			margin-top: 200px
		}
		.size_half {
			width: 50%
		}
		.center {
			margin-right:auto;
			margin-left: auto;
			align: center;

		}
		.error {
			color:red;
		}
	</style>
</head>
<body>
	<h1>Hello <?=$user?></h1>
	<a href="logout.php">Salir</a>
</body>
</html>




