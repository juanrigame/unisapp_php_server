<?php  
	session_start();
	if(!(isset($_SESSION['user'])))
		header("Location: login.php");
	else 
		$user = $_SESSION['user'];
	
	$array_size = 0;
	$elements = []; 
	
	require("../ws/conn.php");
	$mysqli =  new mysqli(host.":".port,user,password,database);
	if ($mysqli -> connect_errno) {
		echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
		exit();
	}
	
	if ($result = $mysqli -> query("SELECT * FROM tb_usuario WHERE rol in (2,3)")) {
		//echo "Returned rows are: " . $result -> num_rows;
		// Free result set
		
		while($element = $result->fetch_row()){
			$elements[$array_size] = $element;
			$array_size++;
		}
		$result -> free_result();
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
		.enlace {
			cursor:hand
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
			<table class="table">
				<thead>
					<tr>
						<th scope="col">Matrícula</th>
						<th scope="col">Nombre</th>
						<th scope="col">Apellidos</th>
						<th scope="col">Correo</th>
						<th scope="col">Editar</th>
						<th scope="col">Borrar</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					//echo $array_size;
					if($array_size >0)
						for($i = 0; $i < $array_size; $i++){
							$matricula = $elements[$i][0];
							$nombre = $elements[$i][2];
							$apellido = $elements[$i][3];
							$email = $elements[$i][5];
							$borrar_mat = "?delete=t&matricula=".$matricula;
							$editar_mat = "alta_usuario.php?edit=T&matricula=".$matricula;
					?>
					<tr>
					<th scope="row"><?=$matricula?></th>
					<td><?=$nombre?></td>
					<td><?=$apellido?></td>
					<td><?=$email?></td>
					<td><a href="<?=$editar_mat?>" class="enlace"><img src="edit.png" alt="Editar" style="height:32px"></td></a>
					<td><a onclick="confirmar('<?=$borrar_mat?>')" class="enlace"><img src="delete.png" alt="Borrar" style="height:32px"></td></a>
					</tr>
					<?php  } ?>
					
				</tbody>
			</table>
		</div>
	</div>
	<script>
	function confirmar(href){
		var borrar = confirm("¿Desea borrar el registro?");
		if(borrar){
			
			window.location.href = window.location.href+href;
		}
		else {
			
		}
	}
	</script>
</body>

</html>