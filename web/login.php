<?php
if(isset($_SESSION['user']))
	header("index.php");

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
	<body>
	
	<div class="container-md">
		<form>
			<div class="mb-3">
				<label for="exampleInputEmail1" class="form-label">Email address</label>
				<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
				<div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
			</div>
			<div class="mb-3">
				<label for="exampleInputPassword1" class="form-label">Password</label>
				<input type="password" class="form-control" id="exampleInputPassword1">
			</div>
			<div class="mb-3 form-check">
				<input type="checkbox" class="form-check-input" id="exampleCheck1">
				<label class="form-check-label" for="exampleCheck1">Check me out</label>
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>

	</body>

</html>