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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Upload Article</title>
    <!--=============== CSS ===============-->
    <!-- <link rel="stylesheet" href="../assets/css/styles.css"> -->

    <!--=============== FONTAWESOME ===============-->
    <link rel="stylesheet" href="../assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!--=============== CSS ===============-->
    <!-- <link rel="stylesheet" href="assets/css/styles.css"> -->


    <style>
        /*=============== GOOGLE FONTS ===============*/
        @import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap");

        /*=============== VARIABLES CSS ===============*/
        :root {
            --header-height: 3rem;

            /*========== Colors ==========*/
            --hue: 174;
            --sat: 63%;
            --first-color: hsl(var(--hue), var(--sat), 40%);
            --first-color-alt: hsl(var(--hue), var(--sat), 36%);
            --title-color: hsl(var(--hue), 12%, 15%);
            --text-color: hsl(var(--hue), 8%, 35%);
            --body-color: hsl(var(--hue), 100%, 99%);
            --container-color: #FFF;

            /*========== Font and typography ==========*/
            --body-font: 'Open Sans', sans-serif;
            --h1-font-size: 1.5rem;
            --normal-font-size: .938rem;
            --tiny-font-size: .625rem;

            /*========== z index ==========*/
            --z-tooltip: 10;
            --z-fixed: 100;
        }

        @media screen and (min-width: 968px) {
            :root {
                --h1-font-size: 2.25rem;
                --normal-font-size: 1rem;
            }
        }

        /*=============== BASE ===============*/
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 20px;
            padding: 20px;
            font-family: var(--body-font);
            font-size: var(--normal-font-size);
            background: #f9f9f9;
            color: var(--text-color);

        }

        /*=============== LAYOUT ===============*/
        .container {
            max-width: 968px;
            margin-left: 1rem;
            margin-right: 1rem;
        }

        /*=============== HEADER ===============*/
        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: var(--container-color);
            z-index: var(--z-fixed);
            transition: .4s;
            background-color: var(--container-color);
            box-shadow: 0 -1px 12px hsla(var(--hue), var(--sat), 15%, 0.15);
        }

        /*=============== NAV ===============*/
        .nav {
            height: var(--header-height);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav__LOGO {
            width: 100px;
        }

        .nav__img {
            width: 32px;
            border-radius: 50%;
        }

        .form-registration {
            max-width: 400px;
            padding: 15px;
            margin: 0 auto;
        }


        .form-registration .form-control {
            position: relative;
            font-size: 16px;
            height: auto;
            padding: 10px;
            box-sizing: border-box;
        }

        .form-registration .form-control:focus {
            z-index: 2;
        }

        .form-registration input[type="text"],
        [type="file"] {
            margin-bottom: 10px;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }

        .btn {
            font-size: medium;
            text-align: right;
            align-items: flex-end;
        }

        .account-wall {
            margin-top: 30px;
            margin-bottom: 100px;
            padding: 40px 0px 20px 0px;
            background-color: #f7f7f7;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        }

        .registration-title {
            margin-top: 30px;
            color: #555;
            font-size: 18px;
            font-weight: 400;
            display: block;
        }

        .profile-img {
            width: 96px;
            height: 96px;
            margin: 0 auto 10px;
            display: block;
            border-radius: 50%;
        }

        @media screen and (min-width: 1024px) {
            .container {
                margin-left: auto;
                margin-right: auto;
            }
        }
    </style>

</head>

<body>
    <!--=============== HEADER ===============-->
    <header class="header" id="header">
        <nav class="nav container">
            <img src="../assets/img/prefil.png" alt="logo" class="nav__LOGO">
            <div class="nav__menu" id="nav-menu"> </div>
            <img src="../assets/img/My doctor.png" alt="" class="nav__img">
        </nav>
    </header>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <h1 class="text-center registration-title"> Upload Articles </h1>
				<h2 class="text-center registration-title">
					<?php
						// on signup button clicked.
						if(isset($_POST["upload"])){
							$at_title = $_POST['at_title'];
							$at_short_info = $_POST['at_short_info'];
							$at_info = $_POST['at_info'];
							
							if(empty($at_title) || empty($at_short_info) || empty($at_info) || empty($_FILES["at_image"]["tmp_name"])){
								echo "All fields are required.";
							}
							else{	
								$fileSize = $_FILES['at_image']['size'];
								if($fileSize < 300000){
								
									$at_image = $_POST['at_image'];
									$target_directory = "../../patient/images/";
									$target_file = $target_directory.basename($_FILES["at_image"]["name"]); 
									$filetype = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
									$newfilename = uniqid('', true).".".$filetype;
									$path = "images/".$newfilename;
									if(move_uploaded_file($_FILES["at_image"]["tmp_name"],$target_directory.$newfilename)){
										
										$articleentry = "insert into article (at_title,at_short_info,at_info,at_image,user_id) 
											values ('$at_title','$at_short_info', '$at_info', '$path','$user_id')";
										if(mysqli_query($conn, $articleentry)){
											echo "uploaded successfully";
										}else{
											echo "Please try again... not uploaded";
										}
									}else{
										echo "Unable to upload photo";
									}
								}else{
									echo "Photo should be less than 300kb";
								}
							}
						}
					?>
				
				</h2>
				<br/>
                <div class="account-wall">
                    <form class="form form-registration" action="" method="post" enctype="multipart/form-data">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="at_title" name="at_title" placeholder="Title" required>
						
						<label for="label">Short Content(2-3 lines only)</label>
                        <input type="text" class="form-control" id="at_short_info" name="at_short_info" placeholder="Short content" required>

                        <label for="content">Content</label>
                        <textarea rows="3" class="form-control" id="at_info" name="at_info" placeholder="Content" required></textarea>

                        <label for="image">Upload Image</label>
                        <input type="file" class="form-control" id="at_image" name="at_image" required>

                    	<div class="mt-5 text-center"><button type="submit" id="submit" name="upload" class="btn btn-primary">Upload</button></div>
					</form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>