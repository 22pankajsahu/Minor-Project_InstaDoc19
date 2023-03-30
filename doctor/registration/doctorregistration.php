<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Registration</title>
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
		
		$sp = $_POST['specialist'];
		$ep = $_POST['experience'];
		
		$qf = $_POST['qualification'];
		$lg = $_POST['language'];
		
		$bio = $_POST['bio'];
		
		if(empty($fn) || empty($ln) || empty($mn) || empty($em) || empty($dob) || empty($gn) || empty($ct) || empty($st) || empty($pwd) || empty($cpwd) || empty($sp) || empty($ep) || empty($qf) || empty($lg) || empty($bio) || empty($_FILES["docimage"]["tmp_name"])){
			echo "All fields are required.";
		}
		else{
			$query = "SELECT mobilenumber,email FROM user WHERE mobilenumber = '$mn' or email='$em'";
			$queryresult = mysqli_query($conn, $query);
			$existency = mysqli_num_rows($queryresult);
			if($existency >= 1){
				echo "Warning!, this mobile number or email is already exists.";
			}
			else{
				if($pwd != $cpwd){
					echo "Password not matching.";
				}else{
					$pwd = md5($pwd);
					
					// default timezone for entry.
					date_default_timezone_set('Asia/Calcutta');
					$date=date("d M Y, h:i A");
					
					$fileSize = $_FILES['docimage']['size'];
					if($fileSize < 200000){
					
						$docimage = $_POST['docimage'];
						$target_directory = "../../patient/images/";
						$target_file = $target_directory.basename($_FILES["docimage"]["name"]); 
						$filetype = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
						$newfilename = uniqid('', true).".".$filetype;
						$path = "images/".$newfilename;
						if(move_uploaded_file($_FILES["docimage"]["tmp_name"],$target_directory.$newfilename)){
							
							$userentry = "insert into user (mobilenumber,email,password,identity,firstname,lastname,dob,gender,city,state,date) 
								values ('$mn','$em', '$pwd', 'doc_on19','$fn','$ln','$dob','$gn','$ct','$st','$date')";
							if(mysqli_query($conn, $userentry)){
								
								$user_select = "select uid from user where mobilenumber = '$mn' or email='$em'";
								$user_result = mysqli_query($conn, $user_select);
								$user_row = mysqli_fetch_assoc($user_result);
								$user_id = $user_row['uid'];
								
								
								$docentry = "insert into doctor (bio,specialist,experience,qualification,language,docimage,user_id) 
											values ('$bio','$sp', '$ep', '$qf','$lg','$path','$user_id')";
								if(mysqli_query($conn, $docentry)){
									echo "Registered successfully. <a href='../signin/doctorlogin.php'><button class='btn btn-primary'>Login Now</button></a>";
								}else{
									echo "Please try again... not registered as doctor";
								}
							}else{
								echo "Please try again... not registered";
							}
						}else{
							echo "Unable to upload photo";
						}
					}else{
						echo "Photo should be less than 200kb";
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
                        <h4 class="text-right">Create Doctor Account</h4>
                    </div>
					<form class="form" action="" method="post" enctype="multipart/form-data">
						<div class="row mt-2">
							<div class="col-md-6"><label class="labels">Name</label><input name="firstname" type="text" class="form-control" placeholder="first name" required></div>
							<div class="col-md-6"><label class="labels">Last Name</label><input name="lastname" type="text" class="form-control" placeholder="last name" required></div>
						</div>
						<div class="row mt-3">
							<div class="col-md-12"><label class="labels">Bio</label><textarea name="bio" rows="3" class="form-control" placeholder="I am..." required></textarea></div>
						</div>
						<div class="row mt-3">
							<div class="col-md-6"><label class="labels">Specialist</label><input name="specialist" type="text" class="form-control" placeholder="Nervous system" required></div>
							<div class="col-md-6"><label class="labels">Experience</label><input name="experience" type="text" class="form-control" placeholder="2 years" required></div>
						</div>
						<div class="row mt-3">
							<div class="col-md-6"><label class="labels">Qualification</label><input name="qualification" type="text" class="form-control" placeholder="MBBS" required></div>
							<div class="col-md-6"><label class="labels">Languages</label><input name="language" type="text" class="form-control" placeholder="Hindi, English" required></div>
						</div>
						
						<div class="row mt-3">
							<div class="col-md-6"><label class="labels">Mobile Nu.</label><input name="mobilenumber" type="text" class="form-control" placeholder="1234567890" required></div>
							<div class="col-md-6"><label class="labels">Email</label><input name="email" type="text" class="form-control" placeholder="email@email.com" required></div>
						</div>
						<div class="row mt-3">
							<div class="col-md-6"><label class="labels">Create a password</label><input name="password" type="text" class="form-control" placeholder="password" required></div>
							<div class="col-md-6"><label class="labels">Retype password</label><input name="repass" type="text" class="form-control" placeholder="repass" required></div>
						</div>
						<div class="row mt-3">
							<div class="col-md-6"><label class="labels">Date of Birth</label><input name="dob" type="text" class="form-control" placeholder="00/00/0000" required></div>
							<div class="col-md-6"><label class="labels">Gender</label><input name="gender" type="text" class="form-control" placeholder="m/f" required></div>
						</div>
						<div class="row mt-3">
							<div class="col-md-6"><label class="labels">City/Village</label><input name="city" type="text" class="form-control" placeholder="city" required></div>
							<div class="col-md-6"><label class="labels">State/Region</label><input name="state" type="text" class="form-control" placeholder="state" required></div>
						</div>
						<div class="row mt-3">
							<div class="col-md-12"><label class="labels">Profile Photo (Less than 200kb in square size)</label><input name="docimage" type="file" class="form-control" required></div>
						</div>
						<div class="mt-5 text-center"><button type="submit" id="submit" name="signup" class="btn btn-primary">Create Account</button></div>
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