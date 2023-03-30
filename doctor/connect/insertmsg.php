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
		header("location: ../signin/doctorlogin.php");
		exit();
	}
	else if($_SESSION["email"] != $row["email"]){
		header("location: ../signin/doctorlogin.php");
		exit();
	}
	else if($password != $row["password"]){
		header("location: ../signin/doctorlogin.php");
		exit();
	}
	else if($identity != "doc_on19"){
		header("location: ../signin/doctorlogin.php");
		exit();
	}
	
	// default timezone for entry.
	date_default_timezone_set('Asia/Calcutta');
	$date=date("d M Y, h:i A");
	
	if(isset($_POST['cr_from_id'])){
		$cr_from_id = $_POST['cr_from_id'];
		$msg = $_POST['msg'];
		
		if(!empty($msg)){
            $insertmsg = "insert into chat(chat_msg,chat_time,chat_from_uid,chat_to_uid,chat_seq_id)
                        values('$msg','$date','$cr_from_id','$user_id','$user_id')";
            mysqli_query($conn, $insertmsg);
    	}
    }
	
?>