<?php 
	include_once ("../../config.php");

	if (isset($_POST['submit']))
	{	
		$upload_ok=1;
		if(isset($_POST['userid1']) && !empty($_POST['userid1'])){
			$user_id = filter_var(htmlspecialchars(trim($_POST['userid1'])),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_span"]="Something went wrong";
		}
		if(isset($_POST['fname']) && !empty($_POST['fname'])){
			$fname = filter_var(htmlspecialchars(strtolower(trim($_POST['fname']))),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["firstName_error"]="Enter your First Name";
		}
		if(isset($_POST['lname']) && !empty($_POST['lname'])){
			$lname = filter_var(htmlspecialchars(strtolower(trim($_POST['lname']))),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["lastName_error"]="Enter your Last Name";
		}
		if(isset($_POST['email']) && !empty($_POST['email'])){
			$email = filter_var(htmlspecialchars(strtolower(trim($_POST['email']))),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_email"]="Enter Valid Email Address";
		}
		if(isset($_POST['contact']) && !empty($_POST['contact'])){
			$contact = filter_var(htmlspecialchars(strtolower(trim($_POST['contact']))),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["contact_error"]="Enter your contact number";
		}
		if (isset($_FILES["uploadImg"]["tmp_name"]) && !empty($_FILES["uploadImg"]["tmp_name"])) {
			$file = addslashes(file_get_contents($_FILES["uploadImg"]["tmp_name"]));
		}else{
			$file = addslashes(file_get_contents("../../assets/img/profile.jpg"));
		}
		

		if($upload_ok==1 && empty($report)){
			$query = "UPDATE USERS SET USER_FIRSTNAME = :user_firstname, USER_LASTNAME = :user_lastname, USER_EMAIL = :user_email, USER_CONTACT = :user_contact, USER_PROFILE = '$file' WHERE USER_ID = :user_id";
			$stmt = $dbh->prepare($query);
			if($stmt->execute(array(':user_firstname' => $fname,':user_lastname' => $lname,':user_email' => $email,':user_contact' => $contact,':user_id' => $user_id))){
					$report["success"]="Profile Updated successfully";
			}
			else{
				$report["error"]="failed to update profile";
			}
		}
	}
	else
	{
		$report["error"]="No data submitted";
	}

	if(isset($report) && !empty($report)){
		echo json_encode($report);
	}

 ?>