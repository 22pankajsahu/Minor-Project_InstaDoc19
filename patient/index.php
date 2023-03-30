<?php
	session_start();
						
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>InstaDoc19</title>
    <!--=============== FONTAWESOME ===============-->
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/c8e4d183c2.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--=============== CSS ===============-->
	
    <link rel="stylesheet" href="assets/css/styles.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	
    <link rel="shortcut icon" href="assets/img/prefil.png">

    <title>InstaDoc19</title>
    <style>
        @import url("https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap");

        @media(max-width:968px) {

            .arrow,
            .scroll {
                display: none;
            }

            .main-login {
                width: 120px;
                height: 40px;
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: #5a76fd;
                color: #fff;
                box-shadow: 5px 10px 30px rgba(90, 118, 253, 0.5);
                text-transform: uppercase;
            }

            .main-login:hover {
                background-color: #5a62fd;
                transition: all ease 0.3s;
            }
        }

        @media screen and (min-width: 968px) {
            body {
                margin: 10px;
                padding: 0px;
                /* font-family: calibri;*/
                background: #f9f9f9; 
                /* background: #E8DFCE; */
                font-family: "Roboto", sans-serif;
            }

            */ * {
                box-sizing: border-box;
            }

            ul {
                list-style: none;
            }

            a {
                text-decoration: none;
            }

            .main {
                width: 100%;
                height: 100vh;
                /* background-image: url("assets/img/poduct_bg.png"); */
                background-size: cover;
                background-position: top left;
                position: relative;
            }

            .home-content {
                display: flex;
                justify-content: space-around;
                align-items: center;
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                width: 90%;

            }

            .home-img {
                width: 500px;
                height: 400px;
                margin: 20px;
            }

            .home-img img {
                width: 100%;
                height: 100%;
                object-fit: contain;
                object-position: center;
            }

            .home-text {
                width: 500px;
                margin: 20px;
            }

            .home-text h1 {
                font-size: 3.5rem;
                line-height: 55px;
                color: #22252e;
                letter-spacing: 1px;
                font-weight: 700;
                margin: 0px;
            }

            .home-text p {
                font-size: 1rem;
                color: #777474;
            }

            .main-login {
                width: 120px;
                height: 40px;
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: #5a76fd;
                color: #fff;
                box-shadow: 5px 10px 30px rgba(90, 118, 253, 0.5);
                text-transform: uppercase;
            }

            .main-login:hover {
                background-color: #5a62fd;
                transition: all ease 0.3s;
            }

            .arrow {
                align-self: end;
                width: 50%;
                border-right: 1px solid #5a76fd;
                height: 20%;
                margin-bottom: 4em;
                position: absolute;
                bottom: 5px;
                right: 70px;
                animation: arrow-animation ease 1.5s;

            }

            .arrow::after {
                content: '';
                position: absolute;
                width: 0;
                height: 0;
                border-style: solid;
                border-width: 11px 11px 0px 11px;
                border-color: #5a76fd transparent transparent transparent;
                right: -0.7em;
                bottom: -2px;
            }

            .scroll {
                position: absolute;
                bottom: 20px;
                right: 55px;
                font-weight: 600;
            }
        }

        @keyframes arrow-animation {
            0% {
                bottom: 70px;
                opacity: 0.2;
            }

            100% {
                bottom: 5px;
                opacity: 1;
            }
        }

        .services {
            /* background-image: url("assets/img/poduct_bg.png"); */
            background-size: 1000px;
            background-position: center;
        }

        .services-heading {
            margin-top: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            flex-direction: column;
        }

        .services-heading h2 {
            line-height: 55px;
            font-size: 2.2rem;
            color: #22252e;
            letter-spacing: 1px;
            font-weight: 700;
            margin: 0px;
        }

        .services-heading p {
            font-size: 1rem;
            color: #777474;
            width: 50%;
        }

        .box-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            margin: 20px 30px;
        }

        .box {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 500px;
            height: 400px;
            text-align: center;
            box-shadow: 2px 2px 20px rgba(90, 118, 253, 0.15);
            border-radius: 10px;
            background-color: #fff;
            margin: 20px;
            flex-grow: 1;
        }

        .box img {
            height: 150px;
            margin: 10px;
        }

        .box font {
            font-size: 1.5rem;
            color: #22252e;
            letter-spacing: 1px;
            font-weight: 700;
        }

        .box p {
            margin-top: 10px;
            margin-bottom: 10px;
            font-size: 1rem;
            color: #777474;
            display: block;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 500px;
        }

        .box a {
            width: 150px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px solid #5a76fd;
            text-transform: uppercase;
            margin: auto;
            border-radius: 5px;
            font-weight: 600;
            font-size: 0.9rem;
            color: #5a76fd;
            margin: 0px;
        }

        .box a:hover {
            background-color: #5a76fd;
            color: #fff;
            box-shadow: 5px 10px 30px rgba(90, 118, 253, 0.5);
            transition: all ease 0.3s;
        }

        footer {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0px 5%;
            border-top: 1px solid rgba(167, 167, 167, 0.2);
        }

        footer a,
        footer p {
            color: #5e5e5e;
        }

        @media(max-width:1100px) {
            .home-img {
                display: none;
            }

            .home-text {
                width: 100%;
                justify-content: center;
                align-items: center;
                display: flex;
                flex-direction: column;
                height: 45vh;
                background-color: rgba(33, 33, 33, 0.35);
                margin: 5px;
            }

            .home-content {
                width: 100%;
                margin: 5px;
                position: static;
                transform: translate(0px, 70px);
                background-image: url("assets/img/doctorbg2.jpg");
                background-repeat: no-repeat;
                background-size: cover;
                background-position: top right;
                box-shadow: 2px 2px 30px rgba(90, 118, 253, 0.15);
            }

            .home-text h1 {
                color: #fff;
                padding: 0px 20px;
                font-size: 2.5rem;
                border: 1px solid #fff;
            }

            .home-text p {
                color: rgba(255, 255, 255, 0.85);
                margin: 10px 0px 20px 0px;
                /* width: 50%; */
                justify-content: center;
                align-items: center;
            }

            .arrow {
                height: 70px;
            }

            .main {
                background-size: 500px;
                ;
            }
        }

        @media(max-width:768px) {
            .home-text p {
                width: 70%;
                text-align: center;
            }

            .arrow,
            .scroll {
                display: none;
            }

            .home-content h1 {
                font-size: 1.9rem;
                padding: 10px 10px;
                line-height: 30px;
            }

            .services-heading {
                margin: 20px;

            }

            .services-heading h2 {
                font-size: 1.7rem;
                line-height: 40px;
            }

            .services-heading p {
                width: 100%;
            }

            .box {
                width: 100%;
                margin: 20px 0px !important;
                padding: 0px 20px;
                flex-grow: 1;
            }

            .box img {
                height: 100px;
                width: 100%;
                object-fit: contain;
            }

            footer p,
            a {
                font-size: 0.9rem;
                text-align: center;
            }

            footer {
                padding: 0px 10px;
            }

            @media screen and (max-width: 320px) {

                .arrow,
                .scroll {
                    display: none;
                }

                .main-login {
                    width: 120px;
                    height: 40px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    background-color: #5a76fd;
                    color: #fff;
                    box-shadow: 5px 10px 30px rgba(90, 118, 253, 0.5);
                    text-transform: uppercase;
                }

                .main-login:hover {
                    background-color: #5a62fd;
                    transition: all ease 0.3s;
                }
            }

            @media screen and (min-width: 576px) {

                .arrow,
                .scroll {
                    display: none;
                }

                .main-login {
                    width: 120px;
                    height: 40px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    background-color: #5a76fd;
                    color: #fff;
                    box-shadow: 5px 10px 30px rgba(90, 118, 253, 0.5);
                    text-transform: uppercase;
                }

                .main-login:hover {
                    background-color: #5a62fd;
                    transition: all ease 0.3s;
                }
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
                        <a href="index.php" class="nav__link active-link">
                            <i class="fa fa-home nav__icon"></i>
                            <span class="nav__name">Home</span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="doctors.php" class="nav__link">
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

    <!-- <main> -->
    <!--=============== HOME ===============-->
    <section class="main">
        <div class="container">
            <div class="home-content">
                <!--text-->
                <div class="home-text">
                    <h2>Welcome To</h2> <br>
                    <h1>InstaDoc19</h1> <br>
                    <p>Connect to a doctor, <br>
                        With your interest.</p> <br>
                    <!--login-btn-->
					
						
						 <a href='signin/userlogin.php' class='main-login'>Take a Look</a>
						
					
                </div> <br>
                <!--img-->
                <div class="home-img">
                    <img src="assets/img/Medical prescription-bro.svg">
                </div>
            </div>
            <div class="arrow"></div>
            <span class="scroll">Scroll</span>
        </div>
    </section>
    <!--services----------------------->
    <section class="services">
        <!--heading----------->
        <div class="services-heading"> <br> <br> <br> <br>
            <h2>Read Health Related Articles</h2>
            <p></p>
        </div>
        <!--box-container----------------->
        <div class="box-container">
            <!--box-1-------->
			<?php
				
				// Database Connection code to connect to the database and establish secure connection.
				require_once "databaseconnection/dbconnect.php";
				
				$at_select = "select at_id, at_title,at_short_info,at_image from article";
				$at_result = mysqli_query($conn, $at_select);
				if(mysqli_num_rows($at_result) <= 0)
					echo "<div class='p-3 bg-danger ml-4 text-center'>No articles available</div>";
				else{
					while($at_row = mysqli_fetch_assoc($at_result)){
			?>
            <div class="box">
                <img src="<?php echo $at_row['at_image'];?>">
                <font><?php echo $at_row['at_title'];?></font>
                <p>
					<?php echo $at_row['at_short_info'];?>
                </p>
                <!--btn--------->
                <a href="article/articles.php?at_id=<?php echo $at_row['at_id'];?>"> Read </a>
            </div>
			<?php
					}
				}
			?>
            <!--box-2-------->
        </div>
    </section>
    <!--footer------------->
    <footer>
        <a href="#">InstaDoc19, Consultation Platform.</a>
        <p>Copyright (C) 2022 InstaDoc19.</p>
    </footer>

    <!--=============== MAIN JS ===============-->
    <!-- <script src="assets/js/main.js"></script> -->
</body>

</html>