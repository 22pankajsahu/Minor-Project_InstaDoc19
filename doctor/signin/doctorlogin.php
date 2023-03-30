<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
					// adding database connection code.
					require_once '../databaseconnection/dbconnect.php';
					
					if(isset($_POST["login"])){
						$un = mysqli_real_escape_string($conn, $_POST['email']);
						$un = trim($un);
						$pwdd = mysqli_real_escape_string($conn, $_POST['password']);
						$pwd = md5($pwdd);
						if(empty($un) || empty($pwdd)){
							echo "Email/Mobile Number And Password Is Empty !!";
						}
						else{
							$sql="SELECT email,mobilenumber,password,identity FROM user WHERE mobilenumber='$un' or email='$un'";
							$result = mysqli_query($conn, $sql);
							$resultCheck = mysqli_num_rows($result);
							if($resultCheck < 1){
								echo "Email/Mobile Number Not Exist !!";
							}
							else{
								$row = mysqli_fetch_assoc($result);
								if($pwd != $row["password"]){
										echo "Wrong Email/Mobile Number or Password !!";
								}
								else if($pwd == $row["password"]){
									session_start();
									$_SESSION["email"] = $row["email"];
									$_SESSION["password"] = $row["password"];
									$_SESSION["identity"] = $row["identity"];
									header("location: ../index.php");
								}
								else{
									echo "Wrong Email/Mobile Number or Password !!";
								}
							}
						}
					}else{
						echo "Login Now";
					}
				?>
                </div>
            </div>
			<div class="col-md-6 border-left">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Login</h4>
                    </div>
					<form class="form" action="" method="post">
						<div class="row mt-3">
							<div class="col-md-12"><label class="labels">Email</label><input name="email" type="text" class="form-control" placeholder="Enter email" required></div>
						</div>
						<div class="row mt-3">
							<div class="col-md-12"><label class="labels">Password</label><input name="password" type="password" class="form-control" placeholder="Enter password" required></div>
						</div>
						<div class="mt-5 text-center"><button type="submit" id="submit" name="login" class="btn btn-primary">Log In</button></div>
					</form>
					<div class="text-center p-3">
						or<br/>
						<a href="../registration/doctorregistration.php">Register as Doctor</a>
					</div>
				</div>
            </div>
        </div>
    </div>

    <script>
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"
    </script>
</body>
</html>