<?php 

	DEFINE("SERVER","localhost");
	DEFINE("USERNAME","root");
	DEFINE("PASSWORD","");
	DEFINE("DATABASE","eloc_search");

	$conn = mysqli_connect(SERVER, USERNAME, PASSWORD, DATABASE);
	// var_dump($conn);

	if(mysqli_connect_errno()){
		die("Connection to the database failed ". mysqli_error($conn));
	}

 ?>