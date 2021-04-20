<?php
	session_start();
	if(isset($_SESSION['user']))
		header("Location index.php");
	if(isset($_POST['mail'])){
		require("../ws/conn.php");
		$mysqli =  new mysqli(host.":".port,user,password,database);
		if ($mysqli -> connect_errno) {
			echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
			exit();
		}
		$user = NULL;
		$password = $_POST['password'];
		$mail = $_POST['mail'];
		if ($result = $mysqli -> query("SELECT * FROM tb_usuario WHERE password ='$password' and email='$mail' and rol=1")) {
			//echo "Returned rows are: " . $result -> num_rows;
			// Free result set
			$user = $result->fetch_row();
			$result -> free_result();
		}
		//Session keep
		//Response
		
		if($user){
			$_SESSION['user'] = $_POST['mail'];
			echo "what";
			header("Location: index.php");
		}
		else {
			$_SESSION["error"] = "Credenciales inválidas";
			echo "error";
		}
	}
	?>
<html> <DOCTYPE html>
	<head>
		<title>Unisapp | LOGIN</title>
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
	<body>
	
	<div class="container-md vertical-200">
		<div class="card w-50 mx-auto">
			<div class="card-body">
			<h5 class="card-title">Acceder a UNISAPP</h5>
			<form method="POST">
			<div class="mb-3">
				<label for="exampleInputEmail1" class="form-label">Correo</label>
				<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="mail" required="required">
				<!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
			</div>
			<div class="mb-3">
				<label for="exampleInputPassword1" class="form-label">Contraseña</label>
				<input type="password" class="form-control" id="exampleInputPassword1" name="password" required="required">
			</div>
			<?php
			 if(isset($_SESSION["error"])){
			?>
			<div id="emailHelp" class="form-text error">Credenciales inválidas</div><br/> 
			<?php 
				session_destroy();
			 }
			?>
			<button type="submit" class="btn btn-primary">Entrar</button>
		</form>
			</div>
		</div>
		
	</div>

	</body>

</html>