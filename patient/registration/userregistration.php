<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registration</title>
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

	// Database Connection code to connect to the database and establish secure connection.
	require_once "../databaseconnection/dbconnect.php";
	
	// on signup button clicked.
	if(isset($_POST["signup"])){
		$fn = $_POST['firstname'];
		$ln = $_POST['lastname'];
		
		$mn = $_POST['mobilenumber'];
		$em = $_POST['email'];
		
		$dob = $_POST['dob'];
		$gn = $_POST['gender'];
		
		$ct = $_POST['city'];
		$st = $_POST['state'];
		
		$pwd = $_POST['password'];
		$cpwd = $_POST['repass'];
		
		
		if(empty($fn) || empty($ln) || empty($mn) || empty($em) || empty($dob) || empty($gn) || empty($ct) || empty($st) || empty($pwd) || empty($cpwd)){
			echo "All fields are required.";
		}
		else{
			$query = "SELECT mobilenumber FROM user WHERE mobilenumber = '$mn'";
			$queryresult = mysqli_query($conn, $query);
			$existency = mysqli_num_rows($queryresult);
			if($existency >= 1){
				echo "Warning!, this mobile number is already exists.";
			}
			else{
				if($pwd != $cpwd){
					echo "Password not matching.";
				}else{
					$pwd = md5($pwd);
					
					// default timezone for entry.
					date_default_timezone_set('Asia/Calcutta');
					$date=date("d M Y, h:i A");
					
					$userentry = "insert into user (mobilenumber,email,password,identity,firstname,lastname,dob,gender,city,state,date) 
						values ('$mn','$em', '$pwd', 'simple_user19','$fn','$ln','$dob','$gn','$ct','$st','$date')";
					if(mysqli_query($conn, $userentry)){
						echo "Registered successfully. <a href='../signin/userlogin.php'><button class='btn btn-primary'>Login Now</button></a>";
					}else{
						echo "Please try again... not registered";
					}
				}
			}
		}
	}
	else{
		echo "Quickely Create a account, its totally safe and effective.";
	}
?>
                </div>
            </div>
			<div class="col-md-6 border-left">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Create Account</h4>
                    </div>
					<form class="form" action="" method="post">
						<div class="row mt-2">
							<div class="col-md-6"><label class="labels">Name</label><input name="firstname" type="text" class="form-control" placeholder="first name" required></div>
							<div class="col-md-6"><label class="labels">Last Name</label><input name="lastname" type="text" class="form-control" placeholder="last name" required></div>
						</div>
						<div class="row mt-3">
							<div class="col-md-6"><label class="labels">Mobile Nu.</label><input name="mobilenumber" type="text" class="form-control" placeholder="1234567890" required></div>
							<div class="col-md-6"><label class="labels">Email</label><input name="email" type="text" class="form-control" placeholder="email@email.com" required></div>
						</div>
						<div class="row mt-3">
							<div class="col-md-6"><label class="labels">Date of Birth</label><input name="dob" type="text" class="form-control" placeholder="1234567890" required></div>
							<div class="col-md-6"><label class="labels">Gender</label><input name="gender" type="text" class="form-control" placeholder="m/f" required></div>
						</div>
						<div class="row mt-3">
							<div class="col-md-6"><label class="labels">City/Village</label><input name="city" type="text" class="form-control" placeholder="city" required></div>
							<div class="col-md-6"><label class="labels">State/Region</label><input name="state" type="text" class="form-control" placeholder="state" required></div>
						</div>
						<div class="row mt-3">
							<div class="col-md-6"><label class="labels">Create a password</label><input name="password" type="text" class="form-control" placeholder="password" required></div>
							<div class="col-md-6"><label class="labels">Retype password</label><input name="repass" type="text" class="form-control" placeholder="repass" required></div>
						</div>
						<div class="mt-5 text-center"><button type="submit" id="submit" name="signup" class="btn btn-primary">Sign Up</button></div>
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

