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

	$deletecr = "delete from chatrequest where cr_from_id=$user_id";
	mysqli_query($conn, $deletecr);
	
?>
<?php
	if(isset($_REQUEST['doc_id'])){
		$doc_id=$_REQUEST['doc_id'];
	}else{
		header('location:../doctors.php');
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, minimum-scale=1, width=device-width">
    <title>Doctor Profile - InstaDoc19</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/c8e4d183c2.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="../assets/img/prefil.png">
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

        a {
            text-decoration: none;
            color: black;
        }

        a:hover {
            text-decoration: none;
            color: black;
        }

        .main-content {
            padding-top: 100px;
            padding-bottom: 100px;
        }

        .place-card {
            background: #fff;
            margin-bottom: 25px;
            border-radius: 5px;
            overflow: hidden;
            display: flex;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .place-card__img {
            width: 30%;
        }

        .place-card__img-thumbnail {
            height: 100%;
            width: 100%;
            object-fit: cover;
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


        h1 {
            font-size: 16px;
            margin-left: 10px;
        }

        @keyframes fade {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .description-img {
            text-align: center;
        }

        .description-img img {
            width: 300px;
            height: auto;
        }

        .sub-head {
            color: #8c0766;
            font-weight: 600;
        }

        @media(max-width:1000px) {


            .description-img {
                margin-top: 50px;
            }
        }

        @media(max-width:700px) {
            .description-img {
                margin-top: 0px;
            }

            .description-img img {
                width: 100%;
                height: auto;
            }

            h1 {
                font-size: 16px;
                margin-left: 10px;
            }
        }

        .description-name {
            font-size: 16px;
            font-weight: 500;
        }

        .description-name {
            font-size: 14px;
        }

        .description-details {
            font-size: 14px;
        }

        .description-details {
            font-size: 13px;
        }

        .about_me {
            font-size: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
	<?php
				
		// Database Connection code to connect to the database and establish secure connection.
		require_once "../databaseconnection/dbconnect.php";
		
		$doc_select = "select doc_id,uid,firstname,lastname,gender,specialist,experience,qualification,language,bio,docimage from user inner join doctor on uid=user_id where doc_id=$doc_id";
		$doc_result = mysqli_query($conn, $doc_select);
		if(mysqli_num_rows($doc_result) <= 0)
			echo "<div class='p-3 bg-danger ml-4 text-center'>No doctors available</div>";
		else{
			$doc_row = mysqli_fetch_assoc($doc_result);
	?>
        <div class="row description pt-3">
            <div class="col-sm-6 description-img">
                <img class="img-thumbnail float-right" src="../<?php echo $doc_row['docimage'];?>" alt="Description Image">
            </div>
            <div class="p-5 pt-3 col-sm-6 description-desc">
                <div class=" text-secondary pt-2 pb-2 description-name">
                    <p class="h5 sub-head"><?php echo $doc_row['firstname'];?></p>
                    <b>
                    </b>
                </div>
                <div class="row text-danger about_me pt-2 pb-2">
                    <?php echo $doc_row['bio'];?>
                </div>
                <div class="pt-3 text-dark  pb-3 text-dark description-details">
                    <p class="h6 sub-head">Specialist : <?php echo $doc_row['specialist'];?> </p>
                    <p class="h6 sub-head">Experienxe : <?php echo $doc_row['experience'];?> </p>
                    <p class="h6 sub-head">Qualification : <?php echo $doc_row['qualification'];?></p>
                    <p class="h6 sub-head">Languages : <?php echo $doc_row['language'];?> </p>
                    </b>
                </div>
                <div class="pt-4 d-flex justify-content-start">
                    <div class="description-buy">
                        <a class="btn-success btn p-1 pl-3 pr-3 text-light" href="../connect/contact.php?cr_to_id=<?php echo $doc_row['uid'];?>">
                            <b id="notify">Connect</b>
                        </a>
                    </div>
                </div>
            </div>
        </div>
		<?php
		}
		?>
    </div>
	<!--
    <section class="main-content">
        <div class="container">
            <h1 class="text-center text-uppercase h6 sub-head">read reviews about doctor</h1>
            <br>
            <br>
            <div class="row">
                <div class="col-lg-6">
                    <div class="place-card">
                        <div class="place-card__img ">
                            <img src="../assets/img/doctor.png" class="place-card__img-thumbnail img-responsive"
                                alt="Thumbnail" style="box-shadow: 0px 0px 8px rgba(0,0,0,0.4);">
                        </div>
                        <div class="place-card__content">
                            <h4 class="place-card__content_header">
                                <a href="#!" class="text-dark place-title">JOHN DOE</a>
                            </h4>
                            <div class="rating-box">
                                <div class="rating-box__items">
                                    <div class="rating-stars">
                                        <img src="../assets/img/grey-star.svg" alt="">
                                        <div class="filled-star" style="width:90%"></div>
                                    </div>
                                    <span class="ml-1"><b>4.5</b></span>
                                </div>
                                <a href="#!" class="text-muted"></a>
                            </div>
                            <p class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsa
                                officiis, excepturi ipsam atque hic laborum fugiat maiores rem?</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="place-card">
                        <div class="place-card__img ">
                            <img src="../assets/img/doctor.png" class="place-card__img-thumbnail img-responsive"
                                alt="Thumbnail" style="box-shadow: 0px 0px 8px rgba(0,0,0,0.4);">
                        </div>
                        <div class="place-card__content">
                            <h4 class="place-card__content_header">
                                <a href="#!" class="text-dark place-title">JOHN DOE</a>
                            </h4>
                            <div class="rating-box">
                                <div class="rating-box__items">
                                    <div class="rating-stars">
                                        <img src="../assets/img/grey-star.svg" alt="">
                                        <div class="filled-star" style="width:90%"></div>
                                    </div>
                                    <span class="ml-1"><b>4</b></span>
                                </div>
                                <a href="#!" class="text-muted"></a>
                            </div>
                            <p class="text-muted mb-0 d-none d-sm-block">Lorem ipsum dolor sit amet consectetur,
                                repellendus sint saepe quo, excepturi ipsam atque hic laborum fugiat maiores rem?</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="place-card">
                        <div class="place-card__img ">
                            <img src="../assets/img/doctor.png" class="place-card__img-thumbnail img-responsive"
                                alt="Thumbnail" style="box-shadow: 0px 0px 8px rgba(0,0,0,0.4);">
                        </div>
                        <div class="place-card__content">
                            <h4 class="place-card__content_header">
                                <a href="#!" class="text-dark place-title">JOHN DOE</a>
                            </h4>
                            <div class="rating-box">
                                <div class="rating-box__items">
                                    <div class="rating-stars">
                                        <img src="../assets/img/grey-star.svg" alt="">
                                        <div class="filled-star" style="width:90%"></div>
                                    </div>
                                    <span class="ml-1"><b>4.5</b></span>
                                </div>
                                <a href="#!" class="text-muted"></a>
                            </div>
                            <p class="text-muted mb-0 d-none d-sm-block">Lorem ipsum dolor sit amet consectetur,
                                repellendus sint saepe quo, excepturi ipsam atque hic laborum fugiat maiores rem?</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</body>

</html>