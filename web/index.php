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
		.header {
			height: 100px;
			padding: 20px;

		}
		.align-right {
			position: absolute;
			right: 0px;
		}
		.clean_link{
			color: inherit;
			text-decoration: inherit;
		}
	</style>
</head>
<body>
	
	
	<div class="container header">
		<span style="width:90%; font-size:21pt">
		<a href="index.php"><img src="logo1.png" style="height:200%" alt="Inicio"></a><!-- <a href="index.php" class="clean_link">UNISAPP</a> -->  |  <?=$user?></span>
		<span style="width:10%;" class="align-right"><a href="logout.php">Salir</a></span>
	</div>
	<div class="container">
		<div class="card" style="margin-top:20px">
			<ul> 
				<li>
					<a href="alta_usuario.php">Alta usuarios</a>
				</li>
				<li> 
					<a href="lista_usuarios.php">Lista usuarios</a>
				</li>
			</ul>
		</div>
	</div>
</body>
</html>