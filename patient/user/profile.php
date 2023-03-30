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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
	<link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>

        body {
    background: rgb(99, 39, 120)
}

.form-control:focus {
    box-shadow: none;
    border-color: #BA68C8
}

.profile-button {
    background: rgb(99, 39, 120);
    box-shadow: none;
    border: none
}

.profile-button:hover {
    background: #682773
}

.profile-button:focus {
    background: #682773;
    box-shadow: none
}

.profile-button:active {
    background: #682773;
    box-shadow: none
}

.back:hover {
    color: #682773;
    cursor: pointer
}

.labels {
    font-size: 11px
}

.add-experience:hover {
    background: #BA68C8;
    color: #fff;
    cursor: pointer;
    border: solid 1px #BA68C8
}

    </style>
</head>
<body>

    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-5">
                <div class="p-3 py-5">
				<?php
					
					// on signup button clicked.
					if(isset($_POST["update"])){
						$fn = $_POST['firstname'];
						$ln = $_POST['lastname'];
						
						$dob = $_POST['dob'];
						$gn = $_POST['gender'];
						
						$ct = $_POST['city'];
						$st = $_POST['state'];
						
						
						if(empty($fn) || empty($ln) || empty($dob) || empty($gn) || empty($ct) || empty($st)){
							echo "All fields are required.";
						}
						else{
							// default timezone for entry.
							date_default_timezone_set('Asia/Calcutta');
							$date=date("d M Y, h:i A");
							
							$userupdate = "update user set firstname='$fn',lastname='$ln',dob='$dob',gender='$gn',city='$ct',state='$st' where uid=$user_id";
							if(mysqli_query($conn, $userupdate)){
								echo "Updated successfully";
							}else{
								echo "Please try again... not updated";
							}
						}
					}
					else{
						echo "Make changes to your personal info.";
					}
				?>
				<div class="mt-5"><a href="../signin/logout.php"><button class="btn btn-primary">Logout</button></a></div>
                </div>
            </div>
			<?php
				$user_select = "select uid,firstname,lastname,mobilenumber,email,dob,gender,city,state from user where email = '$email' and identity='simple_user19'";
				$user_result = mysqli_query($conn, $user_select);
				$user_row = mysqli_fetch_assoc($user_result);
			?>
			<div class="col-md-6 border-left">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">My Account Details</h4>
                    </div>
					<form class="form" action="" method="post">
						<div class="row mt-2">
							<div class="col-md-6"><label class="labels">Name</label><input name="firstname" value="<?php echo $user_row['firstname'];?>" type="text" class="form-control" placeholder="first name" required></div>
							<div class="col-md-6"><label class="labels">Last Name</label><input name="lastname" value="<?php echo $user_row['lastname'];?>" type="text" class="form-control" placeholder="last name" required></div>
						</div>
						<div class="row mt-3">
							<div class="col-md-6"><label class="labels">Date of Birth</label><input name="dob" value="<?php echo $user_row['dob'];?>" type="text" class="form-control" placeholder="1234567890" required></div>
							<div class="col-md-6"><label class="labels">Gender</label><input name="gender" value="<?php echo $user_row['gender'];?>" type="text" class="form-control" placeholder="m/f" required></div>
						</div>
						<div class="row mt-3">
							<div class="col-md-6"><label class="labels">City/Village</label><input name="city" value="<?php echo $user_row['city'];?>" type="text" class="form-control" placeholder="city" required></div>
							<div class="col-md-6"><label class="labels">State/Region</label><input name="state" value="<?php echo $user_row['state'];?>" type="text" class="form-control" placeholder="state" required></div>
						</div>
						<div class="mt-5 text-center"><button type="submit" id="submit" name="update" class="btn btn-primary">Update</button></div>
					</form>
				</div>
            </div>
        </div>
    </div>

    <script>
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"
    </script>
</body>
</html>

