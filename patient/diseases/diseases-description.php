<?php
	if(isset($_REQUEST['ds_id'])){
		$ds_id=$_REQUEST['ds_id'];
	}else{
		header('location:../diseases.php');
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Disease Description - InstaDoc19</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body {
            font-family: poppins;
            margin: 0px;
            padding: 0px;
            font-family: poppins;
            background-color: #ffffff;
            font-size: 14px;
        }

        .card {
            margin-top: 10px;
            margin-right: 50px;
            margin-bottom: 10px;
            margin-left: 50px;
            box-shadow: 2px 2px 30px rgba(0, 0, 0, 0.05);
        }

        @media(max-width:968px) {
            .card-img img {
                width: 250px;
                height: 250px;
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
        }

        @media(min-width:968px) {
            .card-img img {
                width: 250px;
                height: 250px;
                border-radius: 20%;
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

            .card-text {
                max-width: 100%, auto;
            }
        }
    </style>
</head>

<body>
	<?php
	
		// Database Connection code to connect to the database and establish secure connection.
		require_once "../databaseconnection/dbconnect.php";
		
		$ds_select = "select ds_id,ds_name,ds_info,ds_image,ds_doctor from disease where ds_id=$ds_id";
		$ds_result = mysqli_query($conn, $ds_select);
		if(mysqli_num_rows($ds_result) <= 0)
			echo "<div class='p-3 bg-danger ml-4 text-center'>No Data.</div>";
		else{
			$ds_row = mysqli_fetch_assoc($ds_result);
	?>
    <h1 style="color:green;text-align:center"> <br>
        <?php echo $ds_row['ds_name'];?>
    </h1>
    <br>
    <div class="card text-center">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
            </ul>
        </div>

        <div class="card-body">
            <div class="card-img center">
                <img src="../<?php echo $ds_row['ds_image'];?>" alt="card"
                    style="box-shadow: 2px 2px 30px rgba(0, 0, 0, 0.05);">
            </div> <br>
            <h5 class="card-title">About Symptoms</h5>
            <p class="card-text">
				<?php echo $ds_row['ds_info'];?>
            </p>
            <a href="../doctor-description/doctor-description.php?doc_id=<?php echo $ds_row['ds_doctor'];?>" class="btn btn-primary">Find Doctors</a>
        </div>
    </div>
	<?php
		}
	?>
</body>

</html>