<?php 
	$host = 'unicode-hackathon.cekprmnnkuut.us-west-1.rds.amazonaws.com';
	$user = 'admin';
	$pass = 'Aylmao111';
	$db_name = 'unicode-hackathon';

	// connect to db
	//$conn = new mysqli($host, $user, $pass, $db_name);
	$conn = mysqli_connect($host, $user, $pass, $db_name);

	// check if connection is valid
	if(!$conn) {
		echo 'Connection error ' . mysqli_connect_error();
	}
?>