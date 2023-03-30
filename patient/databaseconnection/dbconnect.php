<?php

	// Database Connection code to connect to the database and establish secure connection.
	
	$conn = mysqli_connect("localhost", "root", "", "instadoc19");
	$mysqli = new mysqli("localhost", "root", "", "instadoc19");

	if(!$conn){
		die("Errors while connecting...".mysqli_connect_error());
	}
?>