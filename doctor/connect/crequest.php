<?php

	// Database Connection code to connect to the database and establish secure connection.
	require_once "../databaseconnection/dbconnect.php";

	if(isset($_POST['cr_to_id'])){
		$user_id = $_POST['cr_to_id'];
	
		$crselect = "select cr_from_id,cr_to_id,cr_status from chatrequest inner join user on uid=cr_from_id where cr_to_id=$user_id";
		$crresult = mysqli_query($conn, $crselect);
		if(mysqli_num_rows($crresult)<=0){
			echo "<span class='p-4 border text-center'>No Requests</span>";
		}else{
			while($crrow = mysqli_fetch_assoc($crresult)){
				$uid=$crrow['cr_from_id'];
				$userselect = "select firstname,lastname,gender from user where uid=$uid";
				$userresult = mysqli_query($conn, $userselect);
				$userrow = mysqli_fetch_assoc($userresult);

				echo "<div class='p-4 border text-center'><a href='connect/contact.php?cr_from_id=".$uid."'>Connect to - ".$userrow['firstname']." ".$userrow['lastname']." (".$userrow['gender'].")</a></div>";
			}
		}
	}
?>