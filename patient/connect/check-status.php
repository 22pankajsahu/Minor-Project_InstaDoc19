<?php

	// session to keep the user logged in for a while.
	session_start();

	// Database Connection code to connect to the database and establish secure connection.
	require_once "../databaseconnection/dbconnect.php";

	/**
	* Taking mobile number and password from session.
	* Validating the user.
	*/
	$email = $_SESSION["email"];
	$password = $_SESSION["password"];
	$identity = $_SESSION["identity"];
	$query = "select uid,mobilenumber,email,password,identity from user where email='$email' and password='$password' and identity='$identity'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
	$user_id = $row["uid"];
	$identity = $row["identity"];
	if(empty($email) || empty($password)){
		header("location: ../signin/userlogin.php");
		exit();
	}
	else if($_SESSION["email"] != $row["email"]){
		header("location: ../signin/userlogin.php");
		exit();
	}
	else if($password != $row["password"]){
		header("location: ../signin/userlogin.php");
		exit();
	}
	else if($identity != "simple_user19"){
		header("location: ../signin/userlogin.php");
		exit();
	}

	$crselect = "select cr_status from chatrequest where cr_from_id=$user_id";
	$crresult = mysqli_query($conn, $crselect);
	$crrow = mysqli_fetch_assoc($crresult);
	if($crrow['cr_status']== $user_id){
		echo 1;
	}else{
		echo 0;
	}

?>