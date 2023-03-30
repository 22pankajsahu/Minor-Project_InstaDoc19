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
		header("location: signin/doctorlogin.php");
		exit();
	}
	else if($_SESSION["email"] != $row["email"]){
		header("location: signin/doctorlogin.php");
		exit();
	}
	else if($password != $row["password"]){
		header("location: signin/doctorlogin.php");
		exit();
	}
	else if($identity != "doc_on19"){
		header("location: signin/doctorlogin.php");
		exit();
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Disease - InstaDoc19</title>
    <!--=============== FONTAWESOME ===============-->
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/c8e4d183c2.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="assets/css/styles.css">


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="shortcut icon" href="assets/img/prefil.png">

    <style>
        body {
            margin-top: 70px;
            /* margin-left: 15px;
            margin-right: 15px; */
            margin-bottom: 70px; 
            /* padding: 0px;
            margin: 0px; */
            background: #f9f9f9;
            font-family: "Roboto", sans-serif;
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

        .title-title {
            padding: 10px;
            background: purple;
            color: white;
            font-size: 15px;
            font-weight: 500;
        }

        .title {
            padding: 10px;
        }

        .card {
            padding: 10px;
            box-shadow: 2px 2px 20px rgba(90, 118, 253, 0.13);
            border-radius: 10px;
            background: white;
            text-align: center;
        }

        .card-img img {
            width: 125px;
            height: 125px;
            border-radius: 50%;
        }

        .card-desc {
            text-align: center;
            margin-top: 15px;
            font-size: 12px;
            font-weight: 500;
        }

        .card:hover {
            box-shadow: 3px 3px 15px 2px lightblue;
        }

        .add-view {
            font-size: 12px;
            padding: 5px;
            font-weight: 600;
        }

        .find-doctors {
            font-size: 12px;
            padding: 5px;
            font-weight: 600;
            height: 27px;
        }

        @media(max-width:1000px) {
            .card-img img {
                width: 200px;
                height: 200px;
                border-radius: 50%;
            }
        }

        @media(max-width:768px) {
            .card-img img {
                width: 100px;
                height: 100px;
                border-radius: 50%;
            }
        }
        @media(max-width:414px) {
            /* .title-title {
            padding: 9px;
            background: purple;
            color: white;
            font-size: 9px;
            font-weight: 500;
        } */

        .title {
            padding: 8px;
        }

        .card {
            padding: 5px;
            box-shadow: 2px 2px 20px rgba(90, 118, 253, 0.13);
            border-radius: 10px;
            background: white;
            text-align: center;
        }

        .card-img img {
            width:62.5px;
            height:62.5px;
            border-radius: 50%;
        }

        .card-desc {
            text-align: center;
            margin-top: 15px;
            font-size: 12px;
            font-weight: 500;
        }

        .card:hover {
            box-shadow: 3px 3px 15px 2px lightblue;
        }

        .add-view {
            font-size: 9px;
            padding: 5px;
            font-weight: 600;
        }

        .find-doctors {
            font-size: 12px;
            padding: 5px;
            font-weight: 600;
            height: 27px;
        }
        }
        
        @media(max-width:375px) {
            /* .title-title {
            padding: 9px;
            background: purple;
            color: white;
            font-size: 9px;
            font-weight: 500;
        } */

        .title {
            padding: 8px;
        }

        .card {
            padding: 5px;
            box-shadow: 2px 2px 20px rgba(90, 118, 253, 0.13);
            border-radius: 10px;
            background: white;
            text-align: center;
        }

        .card-img img {
            width:62.5px;
            height:62.5px;
            border-radius: 50%;
        }

        .card-desc {
            text-align: center;
            margin-top: 15px;
            font-size: 12px;
            font-weight: 500;
        }

        .card:hover {
            box-shadow: 3px 3px 15px 2px lightblue;
        }

        .add-view {
            font-size: 8px;
            padding: 5px;
            font-weight: 600;
        }

        .find-doctors {
            font-size: 7px;
            padding: 5px;
            font-weight: 600;
            height: 19px;
        }
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
                        <a href="article/uploadarticles.php" class="nav__link">
                            <i class="fa fa-user-md nav__icon"></i>
                            <span class="nav__name">Articles</span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="diseases.php" class="nav__link active-link">
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

    <!-- <main> -->
        <!--=============== HOME ===============-->
        <!-- <section class="container section section__height" id="home">
            <h2 class="section__title">Home</h2>
        </section> -->

        <!--=============== DOCTORS ===============-->
        <!-- <section class="container section section__height" id="doctors">
            <h2 class="section__title">Doctors</h2>
        </section> -->

        <!--=============== DISEASES ===============-->
        <div class="container"> 
		    <div class="row text-center p-5">
				<h6 class="btn btn-success"><a href="diseases/uploaddiseases.php">Upload Disease</a></h6>
			</div>
        <div class="row title">
		<?php
			
			$ds_select = "select ds_id,ds_name,ds_image from disease where ds_doctor=$user_id";
			$ds_result = mysqli_query($conn, $ds_select);
			if(mysqli_num_rows($ds_result) <= 0)
				echo "<div class='p-3 bg-danger ml-4 text-center'>No Data.</div>";
			else{
				while($ds_row = mysqli_fetch_assoc($ds_result)){
		?>
            <div class="col mt-3">
                <div class="card">
                    <a href="card-desc.php">
                        <div class="card-img">
                            <img src="../patient/<?php echo $ds_row['ds_image'];?>" alt="card">
                        </div>
                    </a>
                    <div class="card-desc p-2 mt-3">
                        <a href="diseases/diseases-description.php?ds_id=<?php echo $ds_row['ds_id'];?>">
                            <p><span class="p-1 text-dark"><?php echo $ds_row['ds_name'];?></p>
                        </a>
                        
                        <a href="diseases/diseases-description.php?ds_id=<?php echo $ds_row['ds_id'];?>">    
							<button id="view" value="44" class="btn btn-warning text-dark pl-3 pr-3 rounded add-view"> 
								View
							</button>  
						</a>
						<a href="diseases/editdiseases.php?ds_id=<?php echo $ds_row['ds_id'];?>">    
							<button id="view" value="44" class="btn btn-warning text-dark pl-3 pr-3 rounded add-view"> 
								Edit
							</button>  
						</a>
                    </div>
                </div>
            </div>
			<?php
				}
			}
			?>
        </div>
    </div>

        <!--=============== CONTACT ===============-->
        <!-- <section class="container section section__height" id="contact">
            <h2 class="section__title">Contact</h2>
        </section> -->

        <!--=============== USER ===============-->
        <!-- <section class="container section section__height" id="user">
            <h2 class="section__title">User</h2>
        </section> -->
    <!-- </main> -->


    <!--=============== MAIN JS ===============-->
    <!-- <script src="assets/js/main.js"></script> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->
</body> 

</html>