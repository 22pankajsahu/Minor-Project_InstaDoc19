<?php

	// session to keep the user logged in for a while.
	session_start();

	// Database Connection code to connect to the database and establish secure connection.
	require_once "../../databaseconnection/dbconnect.php";

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
		header("location: ../../signin/doctorlogin.php");
		exit();
	}
	else if($_SESSION["email"] != $row["email"]){
		header("location: ../../signin/doctorlogin.php");
		exit();
	}
	else if($password != $row["password"]){
		header("location: ../../signin/doctorlogin.php");
		exit();
	}
	else if($identity != "doc_on19"){
		header("location: ../../signin/doctorlogin.php");
		exit();
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== FONTAWESOME ===============-->
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/c8e4d183c2.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="shortcut icon" href="../../assets/img/prefil.png">



    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>

    <title>InstaDoc19</title>

    <style>
        body,
        html {
            margin-top: 100px;
            height: 100%;
            margin: 0;
            background: #7F7FD5;
            /* background: -webkit-linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5); */
            background: linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);
            background: #f9f9f9;
        }

        .chat {
            margin-top: auto;
            margin-bottom: auto;
        }

        .card {
            height: 500px;
            border-radius: 15px !important;
            background-color: rgba(0, 0, 0, 0.4) !important;

            /* box-shadow: 2px 2px 20px rgba(90, 118, 253, 0.13);
            border-radius: 10px;
            background: white; */

            /* background: #f9f9f9 */
        }

        .contacts_body {
            padding: 0.75rem 0 !important;
            overflow-y: auto;
            white-space: nowrap;
        }

        .msg_card_body {
            overflow-y: auto;
        }

        .card-header {
            border-radius: 15px 15px 0 0 !important;
            border-bottom: 0 !important;
        }

        .card-footer {
            border-radius: 0 0 15px 15px !important;
            border-top: 0 !important;
        }

        .container {
            align-content: center;
        }

        .search {
            border-radius: 15px 0 0 15px !important;
            background-color: rgba(0, 0, 0, 0.3) !important;
            border: 0 !important;
            color: white !important;
        }

        .search:focus {
            box-shadow: none !important;
            outline: 0px !important;
        }

        .type_msg {
            background-color: rgba(0, 0, 0, 0.3) !important;
            border: 0 !important;
            color: white !important;
            height: 60px !important;
            overflow-y: auto;
        }

        .type_msg:focus {
            box-shadow: none !important;
            outline: 0px !important;
        }

        .attach_btn {
            border-radius: 15px 0 0 15px !important;
            background-color: rgba(0, 0, 0, 0.3) !important;
            border: 0 !important;
            color: white !important;
            cursor: pointer;
        }

        .send_btn {
            border-radius: 0 15px 15px 0 !important;
            background-color: rgba(0, 0, 0, 0.3) !important;
            border: 0 !important;
            color: white !important;
            cursor: pointer;
        }

        .search_btn {
            border-radius: 0 15px 15px 0 !important;
            background-color: rgba(0, 0, 0, 0.3) !important;
            border: 0 !important;
            color: white !important;
            cursor: pointer;
        }

        .contacts {
            list-style: none;
            padding: 0;
        }

        .contacts li {
            width: 100% !important;
            padding: 5px 10px;
            margin-bottom: 15px !important;
        }

        .active {
            background-color: rgba(0, 0, 0, 0.3);
        }

        .user_img {
            height: 70px;
            width: 70px;
            border: 1.5px solid #f5f6fa;

        }

        .user_img_msg {
            height: 40px;
            width: 40px;
            border: 1.5px solid #f5f6fa;

        }

        .img_cont {
            position: relative;
            height: 70px;
            width: 70px;
        }

        .img_cont_msg {
            height: 40px;
            width: 40px;
        }

        .online_icon {
            position: absolute;
            height: 15px;
            width: 15px;
            background-color: #4cd137;
            border-radius: 50%;
            bottom: 0.2em;
            right: 0.4em;
            border: 1.5px solid white;
        }

        .offline {
            background-color: #c23616 !important;
        }

        .user_info {
            margin-top: auto;
            margin-bottom: auto;
            margin-left: 15px;
        }

        .user_info span {
            font-size: 20px;
            color: white;
        }

        .user_info p {
            font-size: 10px;
            color: rgba(255, 255, 255, 0.6);
        }

        .video_cam {
            margin-left: 50px;
            margin-top: 5px;
        }

        .video_cam span {
            color: white;
            font-size: 20px;
            cursor: pointer;
            margin-right: 20px;
        }

        .msg_cotainer {
            margin-top: auto;
            margin-bottom: auto;
            margin-left: 10px;
            border-radius: 25px;
            background-color: #82ccdd;
            padding: 10px;
            position: relative;
        }

        .msg_cotainer_send {
            margin-top: auto;
            margin-bottom: auto;
            margin-right: 10px;
            border-radius: 25px;
            background-color: #78e08f;
            padding: 10px;
            position: relative;
        }

        .msg_time {
            position: absolute;
            left: 0;
            bottom: -15px;
            color: rgba(255, 255, 255, 0.5);
            font-size: 10px;
        }

        .msg_time_send {
            position: absolute;
            right: 0;
            bottom: -15px;
            color: rgba(255, 255, 255, 0.5);
            font-size: 10px;
        }

        .msg_head {
            position: relative;
        }

        #action_menu_btn {
            position: absolute;
            right: 10px;
            top: 10px;
            color: white;
            cursor: pointer;
            font-size: 20px;
        }

        .action_menu {
            z-index: 1;
            position: absolute;
            padding: 15px 0;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border-radius: 15px;
            top: 30px;
            right: 15px;
            display: none;
        }

        .action_menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .action_menu ul li {
            width: 100%;
            padding: 10px 15px;
            margin-bottom: 5px;
        }

        .action_menu ul li i {
            padding-right: 10px;

        }

        .action_menu ul li:hover {
            cursor: pointer;
            background-color: rgba(0, 0, 0, 0.2);
        }

        @media(max-width: 576px) {
            .contacts_card {
                margin-bottom: 100px !important;
            }

            .container-fluid {
                margin-top: 100px;
                margin-bottom: 100px;
            }

            .card {
                margin-bottom: 100px;
            }
        }
    </style>
</head>

<body>
    <!--=============== HEADER ===============-->
    <header class="header" id="header">
        <nav class="nav container">
            <img src="../../assets/img/prefil.png" alt="logo" class="nav__LOGO">

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="../vanish.php?user_id=<?php echo $user_id;?>" class="nav__link">
                            <i class="fa fa-home nav__icon"></i>
                            <span class="nav__name">Home</span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="#" class="nav__link active-link">
                            <i class="fa fa-commenting-o nav__icon"></i>
                            <span class="nav__name">Contact</span>
                        </a>
                    </li>
					
					<li class="nav__item">
                        <a href="../vanish.php?user_id=<?php echo $user_id;?>" class="nav__link">
                            <i class="fa fa-commenting-o nav__icon"></i>
                            <span class="nav__name text-danger">End Chat</span>
                        </a>
                    </li>

                </ul>
            </div>

            <img src="../../assets/img/My doctor.png" alt="" class="nav__img">
        </nav>
    </header>
<?php
	if(isset($_REQUEST['cr_from_id'])){
		$cr_from_id = $_REQUEST['cr_from_id'];
	}

	include('config.php');
	include('api.php');
	$arr['topic']='Instadoc19';
	$arr['start_date']=date('2022-01-05 00:02:30');
	$arr['duration']=30;
	$arr['password']='instant22';
	$arr['type']='2';
	$result=createMeeting($arr);
	if(isset($result->id)){
		$link = $result->join_url;
        $pass = $result->password;
	}else{
		echo '<pre>';
		print_r($result);
	}
	
	$crupdate = "update chatrequest set cr_video_link='$link', cr_passcode='$pass' where cr_from_id=$cr_from_id";
	mysqli_query($conn, $crupdate);

?>
    <div class="container-fluid h-100">
        <div class="row justify-content-center h-100">
            <div class="col-md-8 col-xl-6 chat">
                <div class="card">
                    <div class="card-body text-center msg_card_body" id="mychatbox">
						<div class="bg-info mt-2 p-2 mb-2"><a class="text-dark" href="<?php echo $result->join_url;?>">Start a video call &nbsp; <i class="fa fa-video-camera"></i></a></div>
                        <div class="bg-success p-2">Password : <?php echo $result->password;?></div>
                    </div>
                </div>
            </div>
        </div>
		<div class="row pb-5 justify-content-center">
			<a href="../vanish.php?user_id=<?php echo $user_id;?>"><button class="btn btn-danger">End Chat</button></a>
		</div>
		<div class="row pb-5"></div>
    </div>



</body>

</html>