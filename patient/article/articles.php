<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, minimum-scale=1, width=device-width">
    <title>Articles</title>
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

        a {
            text-decoration: none;
            color: black;
        }

        a:hover {
            text-decoration: none;
            color: black;
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
        }

        .description-name {
            font-size: 16px;
            font-weight: 500;
            font-size: 14px;
        }
        .about_me {
            font-size: 15px;
        }
    </style>
</head>

<body>
<?php
	if(isset($_REQUEST['at_id'])){
		$at_id=$_REQUEST['at_id'];
	}else{
		header('location:../index.php');
	}
	// Database Connection code to connect to the database and establish secure connection.
	require_once "../databaseconnection/dbconnect.php";
	
	$at_select = "select at_id,at_title,at_info,at_image from article where at_id=$at_id";
	$at_result = mysqli_query($conn, $at_select);
	if(mysqli_num_rows($at_result) <= 0)
		echo "<div class='p-3 bg-danger ml-4 text-center'>No articles available</div>";
	else{
		$at_row = mysqli_fetch_assoc($at_result);
?>
    <div class="container">
        <div class="description pt-3">
            <div class="description-img">
                <img class="img-thumbnail float-right" src="../<?php echo $at_row['at_image'];?>" alt="Description Image">
            </div>
        </div>
        <div class="p-5 pt-3 col-sm-6 description-desc">

            <div class=" text-secondary pt-2 pb-2 description-name">
                <p class="h5 sub-head text-uppercase text-center">
					<?php echo $at_row['at_title'];?>
				</p>
                <b>
                </b>
            </div>
            <div class="row text-danger about_me pt-2 pb-2">
                <?php echo $at_row['at_info'];?>
            </div>
        </div>
    </div>
	<?php
	}
	?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</body>

</html>