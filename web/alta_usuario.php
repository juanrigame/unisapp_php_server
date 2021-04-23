<?php  
	session_start();
	if(!(isset($_SESSION['user'])))
		header("Location: login.php");
	else {
		$user = $_SESSION['user'];
	}
	$matricula = "";
	$nombre = "";
	$apellido = "";
	$mail = "";
	$rol = "";
	$password = "";
	if(isset($_POST['submit'])){
		//try to save the record
		$matricula = $_POST['matricula'];
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$mail = $_POST['mail'];
		$rol = $_POST['rol'];
		$password = $_POST['password'];
		$source = $_POST['source'];
	/* 	echo "<br>$matricula";
		echo "<br>$nombre";
		echo "<br>$apellido";
		echo "<br>$mail";
		echo "<br>$rol";
		echo "<br>$password"; */
		require("../ws/conn.php");
		$mysqli =  new mysqli(host.":".port,user,password,database);
		if ($mysqli -> connect_errno) {
			echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
			exit();
		}
		$sql = "";
		if($source == "new") 
			$sql = "INSERT INTO `tb_usuario` (`matricula`, `password`, `nombre`, `apellido`, `rol`, `email`) VALUES ('$matricula', '$password', '$nombre', '$apellido', $rol, '$mail')";
		else 
			$sql = "UPDATE `tb_usuario` SET `password`='$password', `nombre`='$nombre', `apellido`='$apellido', `rol`= $rol, `email`='$mail' where matricula='$matricula'";
		if (mysqli_query($mysqli,$sql)) {
			$success = "TRUE";
			$matricula = "";
			$nombre = "";
			$apellido = "";
			$mail = "";
			$rol = "";
			$password = "";
		}
		else {
			$error = mysqli_error($mysqli);
		}
		
	}
	else {
		$registro = NULL;
		if(isset($_GET['edit'])){
			if(isset($_GET['matricula']) && $_GET['matricula'] != ""){
				require("../ws/conn.php");
				$mysqli =  new mysqli(host.":".port,user,password,database);
				if ($mysqli -> connect_errno) {
					echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
					exit();
				}
				$matricula = $_GET['matricula'];
				if ($result = $mysqli -> query("SELECT * FROM tb_usuario WHERE matricula = '$matricula'")) {
					if($element = $result->fetch_row()){
						$mail = $element[5];
						$nombre = $element[2];
						$apellido = $element[3];
						$password = $element[1];
						$rol = $element[4];
					}
					$result -> free_result();
				}
				else {
					$alert = mysqli_error($mysqli);
				}
			}
		}
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
	<style>
		.vertical-50{
			margin-top: 50px
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
		. success {
			color: rgb(100,255,100)
		}
	</style>
</head>
<body>
	
	
	<div class="container header">
		<span style="width:90%; font-size:21pt">
		<a href="index.php"><img src="logo1.png" style="height:200%" alt="Inicio"></a><!-- <a href="index.php" class="clean_link">UNISAPP</a> -->  |  <?=$user?></span>
		<span style="width:10%;" class="align-right"><a href="logout.php">Salir</a></span>
	</div>
	<div class="container-md vertical-50">
		<div class="card w-50 mx-auto">
			<div class="card-body">
				<form method="POST">
					<?php
						if(isset($success)){
						?>
						<div id="emailHelp" class="form-text success">Registro guardado correctamente</div><br/> 
						<?php 
							
						}
					?>
					<div class="mb-3">
						<label for="matricula" class="form-label">Matrícula</label>
						<input type="text" maxlenght="9" class="form-control" id="matricula" name="matricula" required="required" value="<?=$matricula?>">
						<!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
					</div>
					<div class="mb-3">
						<label for="nombre" class="form-label">Nombre</label>
						<input type="text" maxlenght="30" class="form-control" id="nombre" name="nombre" required="required" value="<?=$nombre?>">
						<!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
					</div>
					<div class="mb-3">
						<label for="apellido" class="form-label">Apellido</label>
						<input type="text" maxlenght="30" class="form-control" id="apellido" name="apellido" value="<?=$apellido?>" required="required">
						<!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
					</div>
					<div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Correo</label>
						<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="mail" value="<?=$mail?>" required="required">
						<!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
					</div>
					<div class="mb-3">
						<label for="rol" class="form-label">Rol</label>
						<select class="form-control" id="rol" name="rol" required="required">
							<option value="" <?php if($rol==""){ echo "selected=\"selected\""; }?>>----SELECCIONA UNA OPCIÓN</option>
							<option value="2" <?php if($rol==2){ echo "selected=\"selected\""; }?>>Maestro</option>
							<option value="3" <?php if($rol==3){ echo "selected=\"selected\""; }?>>Alumno</option>
						</select>
						
						<!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
					</div>
					<div class="mb-3">
						<label for="exampleInputPassword1" class="form-label">Contraseña</label>
						<input type="password" class="form-control" id="exampleInputPassword1" name="password" value="<?=$password?>" required="required">
					</div>
					<?php
					if(isset($error)){
					?>
					<div id="emailHelp" class="form-text error"><?=$error?></div><br/> 
					<?php 
						
					}
					?>
					<input type="hidden" name="source" value="<?php if(isset($_GET['edit'])){ echo "edit"; } else { echo "new"; } ?>"/>
					<input type="submit" name="submit" class="btn btn-primary" value="Guardar">
				</form>
			</div>
		</div>
	</div>
</body>
</html>
