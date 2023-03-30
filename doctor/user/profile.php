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
		header("location: ../signin/doctorlogin.php");
		exit();
	}
	else if($_SESSION["email"] != $row["email"]){
		header("location: ../signin/doctorlogin.php");
		exit();
	}
	else if($password != $row["password"]){
		header("location: ../signin/doctorlogin.php");
		exit();
	}
	else if($identity != "doc_on19"){
		header("location: ../signin/doctorlogin.php");
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
						
						$specialist = $_POST['specialist'];
						$experience = $_POST['experience'];
						
						$qualification = $_POST['qualification'];
						$language = $_POST['language'];
						
						$bio = $_POST['bio'];
						
						if(empty($fn) || empty($ln) || empty($dob) || empty($gn) || empty($ct) || empty($st) || empty($specialist) || empty($experience) || empty($qualification) || empty($language) || empty($bio)){
							echo "All fields are required.";
						}
						else{
							if(empty($_FILES["docimage"]["tmp_name"])){
								
								$userupdate = "update user set firstname='$fn',lastname='$ln',dob='$dob',gender='$gn',city='$ct',state='$st' where uid=$user_id";
								$docupdate = "update doctor set bio='$bio',specialist='$specialist',experience='$experience',qualification='$qualification',language='$language' where user_id=$user_id";
								if(mysqli_query($conn, $userupdate) && mysqli_query($conn, $docupdate)){
									echo "Updated successfully Without Changing Profile Photo";
								}else{
									echo "Please try again... not updated";
								}
							}else{
								$fileSize = $_FILES['docimage']['size'];
								if($fileSize < 200000){
									$image_select = "select docimage from doctor where user_id=$user_id";
									$image_result = mysqli_query($conn, $image_select);
									if(mysqli_num_rows($image_result)>=1){
										$image_row = mysqli_fetch_assoc($image_result);
										$delete = "../../patient/".$image_row['docimage'];
										unlink($delete);
									}
									$docimage = $_POST['docimage'];
									$target_directory = "../../patient/images/";
									$target_file = $target_directory.basename($_FILES["docimage"]["name"]); 
									$filetype = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
									$newfilename = uniqid('', true).".".$filetype;
									$path = "images/".$newfilename;
									if(move_uploaded_file($_FILES["docimage"]["tmp_name"],$target_directory.$newfilename)){
							
										$userupdate = "update user set firstname='$fn',lastname='$ln',dob='$dob',gender='$gn',city='$ct',state='$st' where uid=$user_id";
										$docupdate = "update doctor set bio='$bio',specialist='$specialist',experience='$experience',qualification='$qualification',language='$language',docimage='$path' where user_id=$user_id";
										if(mysqli_query($conn, $userupdate) && mysqli_query($conn, $docupdate)){
											echo "Updated successfully";
										}else{
											echo "Please try again... not updated";
										}
									}
								}
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
				$user_select = "select uid,firstname,lastname,dob,gender,city,state,bio,specialist,experience,qualification,language,docimage from user inner join doctor on uid=user_id where uid = '$user_id' and identity='doc_on19'";
				$user_result = mysqli_query($conn, $user_select);
				$user_row = mysqli_fetch_assoc($user_result);
			?>
			<div class="col-md-6 border-left">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">My Account Details</h4>
                    </div>
					<form class="form" action="" method="post" enctype="multipart/form-data">
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
						<div class="row mt-3">
							<div class="col-md-6"><label class="labels">Specialist</label><textarea name="specialist" rows="2" class="form-control" placeholder="Specialist" required><?php echo $user_row['specialist'];?></textarea></div>
							<div class="col-md-6"><label class="labels">Experience</label><textarea name="experience" rows="2" class="form-control" placeholder="Experience" required><?php echo $user_row['experience'];?></textarea></div>
						</div>
						<div class="row mt-3">
							<div class="col-md-6"><label class="labels">Qualification</label><textarea name="qualification" rows="2" class="form-control" placeholder="Qualification" required><?php echo $user_row['qualification'];?></textarea></div>
							<div class="col-md-6"><label class="labels">Language</label><textarea name="language" rows="2" class="form-control" placeholder="Language" required><?php echo $user_row['language'];?></textarea></div>
						</div>
						<div class="row mt-3">
							<div class="col-md-12"><label class="labels">Bio</label><textarea name="bio" rows="3" class="form-control" placeholder="Bio" required><?php echo $user_row['bio'];?></textarea></div>
						</div>
						<div class="row mt-3">
							<div class="col-md-12"><label class="labels">Profile Photo (Leave empty if dont want to change the image)</label><input name="docimage" type="file" class="form-control"></div>
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

