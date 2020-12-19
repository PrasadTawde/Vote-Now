<?php 
	include_once ("../config.php");
	include_once ("functions.php");

	if (func::checkLoginState($dbh)){
		header("location:../index.php");
	}
	
	$report=array();

	if (isset($_POST['submit'])){
		$upload_ok=1;
		if(isset($_POST['user_type']) && !empty($_POST['user_type'])){
			$user_type = filter_var(htmlspecialchars(strtolower(trim($_POST['user_type']))),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_span"]="User type is required";
		}
		if(isset($_POST['useremail']) && !empty($_POST['useremail'])){
			$useremail = filter_var(htmlspecialchars(strtolower(trim($_POST['useremail']))),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_email"]="Enter Valid Email Address";
		}
		if(isset($_POST['password']) && !empty($_POST['password'])){
			$password = filter_var(htmlspecialchars(trim($_POST['password'])),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_password"]="Enter your Password";
		}

		if ($upload_ok==1 && empty($report))
		{
			if ($user_type=='admin') 
			{
				$query = "SELECT * FROM USERS WHERE USER_EMAIL = :useremail";

				$stmt = $dbh->prepare($query);
				$stmt->execute(array(':useremail' => $useremail));

				$row = $stmt->fetch(PDO::FETCH_ASSOC);

				if ($row['USER_ID'] > 0)
				{
					//if(password_verify($password, $row['USER_PASSWORD']))
					if($password== $row['USER_PASSWORD'])
					{
						func::createRecord($dbh, $row['USER_EMAIL'], $row['USER_ID'], 'admin');
						// header("location:../index.php");
						$report["success"]="You are Logged in successfully";
					}
					else
					{
						$report["error_password"]="Wrong Password for ".$useremail;
					}			
				}
				else
				{
					$report["error_span"]="User Does not exist";
				}
			}
			else if ($user_type == 'student') 
			{
				$query = "SELECT * FROM STUDENTS WHERE STUDENT_EMAIL = :useremail";

				$stmt = $dbh->prepare($query);
				$stmt->execute(array(':useremail' => $useremail));

				$row = $stmt->fetch(PDO::FETCH_ASSOC);

				if ($row['STUDENT_ID'] > 0)
				{
					//if(password_verify($password, $row['USER_PASSWORD']))
					if($password== $row['STUDENT_PASSWORD'])
					{
						func::createRecord($dbh, $row['STUDENT_EMAIL'], $row['STUDENT_ID'], 'student');
						// header("location:../index.php");
						$report["success"]="You are Logged in successfully";
					}
					else
					{
						$report["error_password"]="Wrong Password for ".$useremail;
					}			
				}
				else
				{
					$report["error_span"]="User Does not exist";
				}
			}
		} 
		else 
		{
			$report["error_span"]="Login Failed";
		}
	}
	else {
		// header("location:../index.php");
		$report["error"]="No data submitted";
	}

	if(isset($report) && !empty($report)){
		echo json_encode($report);
	}
?>