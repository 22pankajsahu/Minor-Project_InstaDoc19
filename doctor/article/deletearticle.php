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
	
	if(isset($_REQUEST['at_id'])){
		$at_id = $_REQUEST['at_id'];
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, minimum-scale=1, width=device-width">
    <title>Delete Articles</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/c8e4d183c2.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="assets/img/prefil.png">
    <style>
        @import url("https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap");

        body {
            background: #f9f9f9;
            font-family: "Roboto", sans-serif;
            margin: 0px;
            padding: 0px;
        }

        * {
            box-sizing: border-box;
        }

    </style>
</head>

<body>
<?php
	$image_select = "select at_image from article where user_id=$user_id";
	$image_result = mysqli_query($conn, $image_select);
	if(mysqli_num_rows($image_result)>=1){
		$image_row = mysqli_fetch_assoc($image_result);
		$delete = "../../patient/".$image_row['at_image'];
		unlink($delete);
	}
	$at_delete = "delete from article where at_id=$at_id and user_id=$user_id";
	if(mysqli_query($conn, $at_delete)){
		
?>
    <div class="container">
        <div class="text-center text-dark h5 pt-3">
		Successfully deleted.
        </div>
    </div>
	<?php
	}
	?>
</body>

</html>