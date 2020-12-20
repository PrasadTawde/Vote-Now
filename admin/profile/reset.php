<?php 
	include_once ("../../config.php");

	if (isset($_POST['submit']))
	{	
		$upload_ok=1;
		if(isset($_POST['oldPassword']) && !empty($_POST['oldPassword'])){
			$oldPassword = filter_var(htmlspecialchars(trim($_POST['oldPassword'])),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["old_error"]="Enter Your Current Password";
		}
		if(isset($_POST['newPassword']) && !empty($_POST['newPassword'])){
			$newPassword = filter_var(htmlspecialchars(trim($_POST['newPassword'])),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["new_error"]="Enter new password";
		}
		if(isset($_POST['confirmPassword']) && !empty($_POST['confirmPassword'])){
			$confirmPassword = filter_var(htmlspecialchars(trim($_POST['confirmPassword'])),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["confirm_error"]="Confirm your password";
		}
		if(isset($_POST['userid']) && !empty($_POST['userid'])){
			$userid = filter_var(htmlspecialchars(trim($_POST['userid'])),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_span"]="Something went wrong !";
		}

		$options = array("cost"=>10);
		
		if($upload_ok==1 && empty($report))
		{
			$result = $dbh->prepare("SELECT * FROM USERS WHERE USER_ID = :userid");
			$result->bindParam(':userid',$userid);
			$result->execute();
			$row = $result->fetch(PDO::FETCH_ASSOC);
			if (password_verify($oldPassword, $row['USER_PASSWORD'])) {
				if ($newPassword == $confirmPassword) {

					$hashPassword = password_hash($newPassword,PASSWORD_BCRYPT,$options);

					$query = "UPDATE USERS SET USER_PASSWORD = :newPassword WHERE USER_ID = :user_id";
					$stmt = $dbh->prepare($query);
					if($stmt->execute(array(':newPassword' => $hashPassword,':user_id' => $userid))){
							$report["success"]="Password changed successfully";
					}
					else{
						$report["error"]="failed to change password";
					}
				} else {
					$report["confirm_error"]="Password do not match";
				}
			} else {
				$report["old_error"]="Current Password do not match!";
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