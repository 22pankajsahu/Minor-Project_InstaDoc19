<?php
	// Database Connection code to connect to the database and establish secure connection.
	require_once "../databaseconnection/dbconnect.php";

	if(isset($_REQUEST['user_id'])){
		$user_id = $_REQUEST['user_id'];

		$deletecr = "delete from chatrequest where cr_from_id=$user_id";
		mysqli_query($conn, $deletecr);
		header('location:../index.php');
	}

?>