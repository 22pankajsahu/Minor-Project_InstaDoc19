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
	
	
	if(isset($_POST['cr_to_id'])){
		$cr_to_id = $_POST['cr_to_id'];
	}
	$chatselect = "select chat_msg,chat_from_uid,chat_to_uid,chat_seq_id from chat where chat_from_uid=$user_id and chat_to_uid=$cr_to_id";
	$chatresult = mysqli_query($conn, $chatselect);
	if(mysqli_num_rows($chatresult)<=0){
		echo "<div class='p-4 border justify-content-center'>No Chat</div>";
	}else{	
		while($chatrow = mysqli_fetch_assoc($chatresult)){
			if($chatrow['chat_seq_id']==$user_id){
				echo "
				<div class='d-flex justify-content-end mb-4'>
					<div class='msg_cotainer_send'>
						".$chatrow['chat_msg']."
					</div>
				</div>
				";
			}else{
				echo "
				<div class='d-flex justify-content-start mb-4'>
					<div class='msg_cotainer'>
						".$chatrow['chat_msg']."
					</div>
				</div>
				";
			}
		}
	}
?>