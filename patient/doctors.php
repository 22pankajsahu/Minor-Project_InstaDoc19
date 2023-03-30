<?php

	// session to keep the user logged in for a while.
	session_start();

	// Database Connection code to connect to the database and establish secure connection.
	require_once "databaseconnection/dbconnect.php";

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
		header("location: signin/userlogin.php");
		exit();
	}
	else if($_SESSION["email"] != $row["email"]){
		header("location: signin/userlogin.php");
		exit();
	}
	else if($password != $row["password"]){
		header("location: signin/userlogin.php");
		exit();
	}
	else if($identity != "simple_user19"){
		header("location: signin/userlogin.php");
		exit();
	}

	$deletecr = "delete from chatrequest where cr_from_id=$user_id";
	mysqli_query($conn, $deletecr);
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Doctors - InstaDoc19</title>
    <!--=============== FONTAWESOME ===============-->
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/c8e4d183c2.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--=============== CSS ===============-->
	
    <link rel="stylesheet" href="assets/css/styles.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  	
    <link rel="shortcut icon" href="assets/img/prefil.png">

    <style>
        @import url("https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap");

        body {
            background: #f9f9f9;
            font-family: "Roboto", sans-serif;

        }

        .sub-head {
            color: #8c0766;
            font-weight: 600;
            font-size: 14px;
        }

        .main-content {
            padding-top: 100px;
            padding-bottom: 100px;
        }

        .place-card {
            background: #fff;
            margin-bottom: 25px;
            border-radius: 10px;
            overflow: hidden;
            display: flex;
            /* box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); */
            box-shadow: 2px 2px 20px rgba(90, 118, 253, 0.13);
            height: 250px;
        }

        .place-card__img {
            width: 30%;
        }

        .place-card__img-thumbnail {
            height: 70%;
            width: 100%;
            object-fit: cover;
            margin: 10px;
            /* border-radius: 100px; */
        }

        .place-card__content {
            padding: 25px;
            width: 70%;
        }

        .place-card__content_header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .place-card__content_header .place-title {
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }

        .rating-box {
            margin-bottom: 15px;
        }

        .rating-box__items {
            display: flex;
            align-items: center;
        }

        .rating-stars {
            display: inline-block;
            position: relative;
            width: 100px;
        }

        .rating-stars:before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: #eee;
        }

        .rating-stars .filled-star {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: #ffc107;
        }

        .rating-stars img {
            height: 100%;
            width: 100%;
            display: block;
            position: relative;
            z-index: 1;
        }

        .place-card--small .place-card__content_header {
            margin-bottom: 4px;
        }

        .place-card--small .place-card__content {
            padding: 15px;
        }

        .place-card--small .rating-box {
            margin-bottom: 0;
        }

        .place-card--small .rating-stars {
            width: 80px;
        }
    </style>
</head>

<body>
    <!--=============== HEADER ===============-->
    <header class="header" id="header">
        <nav class="nav container">
            <img src="assets/img/prefil.png" alt="logo" class="nav__LOGO">

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="index.php" class="nav__link">
                            <i class="fa fa-home nav__icon"></i>
                            <span class="nav__name">Home</span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="doctors.php" class="nav__link active-link">
                            <i class="fa fa-user-md nav__icon"></i>
                            <span class="nav__name">Doctors</span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="diseases.php" class="nav__link">
                            <i class="fa fa-plus-square nav__icon"></i>
                            <span class="nav__name">Diseases</span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="user/profile.php" class="nav__link">
                            <i class="fa fa-user-circle-o nav__icon"></i>
                            <span class="nav__name">User</span>
                        </a>
                    </li>

                </ul>
            </div>

            <img src="assets/img/My doctor.png" alt="" class="nav__img">
        </nav>
    </header>

    <main>
        <!--=============== HOME ===============-->
        <!-- <section class="container section section__height" id="home">
            <h2 class="section__title">Home</h2>
        </section> -->

        <!--=============== DOCTORS ===============-->
        <section class="main-content">
            <div class="container">
                <div class="row">
				
				<?php
				
					// Database Connection code to connect to the database and establish secure connection.
					require_once "databaseconnection/dbconnect.php";
					
					$doc_select = "select doc_id,uid,firstname,lastname,gender,specialist,experience,qualification,docimage from user inner join doctor on uid=user_id ";
					$doc_result = mysqli_query($conn, $doc_select);
					if(mysqli_num_rows($doc_result) <= 0)
						echo "<div class='p-3 bg-danger ml-4 text-center'>No doctors available</div>";
					else{
						while($doc_row = mysqli_fetch_assoc($doc_result)){
				?>
				
                    <div class="col-lg-6">
                        <div class="place-card">
                            <div class="place-card__img ">
                                <img src="<?php echo $doc_row['docimage'];?>"
                                    class="place-card__img-thumbnail img-responsive img-thumbnail rounded-circle"
                                    alt="Thumbnail" style="box-shadow: 0px 0px 8px rgba(0,0,0,0.4);">
                            </div>
                            <div class="place-card__content">
                                <h4 class="place-card__content_header">
                                    <a href="doctor-description/doctor-description.php?doc_id=<?php echo $doc_row['doc_id'];?>" class="text-dark place-title"><?php echo $doc_row['firstname'];?></a>
                                </h4>
                                <!--<div class="rating-box">
                                    <div class="rating-box__items">
                                        <div class="rating-stars">
                                            <img src="assets/img/grey-star.svg" alt="">
                                            <div class="filled-star" style="width:90%"></div>
                                        </div>
                                        <span class="ml-1"><b>4.5</b></span>
                                    </div>
                                    <a href="#!" class="text-muted"></a>
                                </div>-->
                                <!-- <a href="#" class="btn btn-sm btn-primary">Viw Profile</a> <a href="#"
                                    class="btn btn-sm btn-success">Connect</a> -->

                                <div class="pt-3 text-dark  pb-3 text-dark description-details">
                                    <p class="h6 sub-head">Specialist : <?php echo $doc_row['specialist'];?> </p>
                                    <p class="h6 sub-head">Experience : <?php echo $doc_row['experience'];?> </p>
                                    <p class="h6 sub-head">Qualification : <?php echo $doc_row['qualification'];?></p>
                                    </b>
                                </div>
                                <!-- <p class="text-muted mb-0 d-sm-block">Experts : Web Dev <br> Qualification : B-Tech <br> -->
                                </p>
                                <a href="doctor-description/doctor-description.php?doc_id=<?php echo $doc_row['doc_id'];?>" class="btn btn-sm btn-primary">Viw
                                    Profile</a> <a href="connect/contact.php?cr_to_id=<?php echo $doc_row['uid'];?>" class="btn btn-sm btn-success">Connect</a>
                            </div>
                        </div>
                    </div>
					<?php
						}
					}
					?>
                    
                </div>
            </div>
        </section>

        <!--=============== DISEASES ===============-->
        <!-- <section class="container section section__height" id="diseases">
            <h2 class="section__title">Diseases</h2>
        </section> -->

        <!--=============== CONTACT ===============-->
        <!-- <section class="container section section__height" id="contact">
            <h2 class="section__title">Contact</h2>
        </section> -->

        <!--=============== USER ===============-->
        <!-- <section class="container section section__height" id="user">
            <h2 class="section__title">User</h2>
        </section> -->
    </main>


    <!--=============== MAIN JS ===============-->
    <!-- <script src="assets/js/main.js"></script> -->
</body>

</html>