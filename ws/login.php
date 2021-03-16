<?php
	//Connection file
	require("conn.php");
	//Connection query
	//echo host.":".port."<br/>";
	$mysqli =  new mysqli(host.":".port,user,password,database);

	// Check connection
	if ($mysqli -> connect_errno) {
		echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
		exit();
	}
	//Params validation
	$matricula_found = FALSE;
	$password_found = FALSE;
	if( isset($_POST["matricula"])){
		$matricula = $_POST["matricula"];
		$matricula_found = TRUE;
	}
	if( isset($_POST["password"])){
		$password = $_POST["password"];
		$password_found = TRUE;
	}
	// Perform query
	if(!$password_found || !$matricula_found){
		echo "{\"result\":\"INVALID_CREDENTIALS\"}";
		exit;
	}
	$user = NULL;
	if ($result = $mysqli -> query("SELECT * FROM tb_usuario WHERE password ='$password' and matricula='$matricula'")) {
		//echo "Returned rows are: " . $result -> num_rows;
		// Free result set
		$user = $result->fetch_row();
		$result -> free_result();
	}
	//Session keep
	//Response
	if($user){
		echo "{\"result\":\"USER_NOT_FOUND\"}";
	}
	else {
		echo "{\"result\":\"OK\"}";
		//Agregar campos del usuario
		//Rol, nombre, MAtricula, aunque la matricula ya se sabe, tal vez apellido
	}
	
	/* 
	echo $matricula;
	echo $password; 
	*/
	//Connection closing
	$mysqli -> close();
?>