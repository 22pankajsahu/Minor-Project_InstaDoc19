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

	$selectvid = "select cr_video_link,cr_passcode from chatrequest where cr_from_id=$user_id";
	$resultvid = mysqli_query($conn, $selectvid);
	$vidrow = mysqli_fetch_assoc($resultvid);
	if($vidrow['cr_video_link']=="none"){
		echo 0;
	}else{
		echo "<span><a href='".$vidrow['cr_video_link']."'>Join video call &nbsp; <i class='fa fa-video-camera'></i></a></span> <span> Passcode : ".$vidrow['cr_passcode'];
	}

?>