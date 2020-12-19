<?php 
include_once ("../../config.php");

$report=array();

	if(isset($_POST["submit"])){
		$upload_ok=1;
		if(isset($_POST['prNumber']) && !empty($_POST['prNumber'])){
			$pr_number = filter_var(htmlspecialchars(trim($_POST['prNumber'])),FILTER_SANITIZE_STRING);
				$count = $dbh->prepare( "SELECT COUNT(*) FROM STUDENTS WHERE STUDENT_PRN = :student_pr" );
				$count->bindParam(':student_pr', $pr_number);
				$count->execute();
				if ($count->fetchColumn() > 0) {
					$upload_ok=0;
					$report["error_pr"]="Student already exits. check PR number again.";
				}
		}
		else{
			$upload_ok=0;
			$report["error_pr"]="Enter PR number";
		}
		if(isset($_POST['firstName']) && !empty($_POST['firstName'])){
			$first_name = filter_var(htmlspecialchars(strtolower(trim($_POST['firstName']))),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_fname"]="Enter first name";
		}
		if(isset($_POST['lastName']) && !empty($_POST['lastName'])){
			$last_name = filter_var(htmlspecialchars(strtolower(trim($_POST['lastName']))),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_lname"]="Enter last name";
		}
		if(isset($_POST['email']) && !empty($_POST['email'])){
			$email = filter_var(htmlspecialchars(strtolower(trim($_POST['email']))),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_email"]="Enter email address";
		}
		if(isset($_POST['contact']) && !empty($_POST['contact'])){
			$contact = filter_var(htmlspecialchars(strtolower(trim($_POST['contact']))),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_contact"]="Enter contact number";
		}
		if(isset($_POST['selectDept']) && !empty($_POST['selectDept'])){
			$dept_id = filter_var(htmlspecialchars(trim($_POST['selectDept'])),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_dept"]="Select Department";
		}
		if(isset($_POST['selectCourse']) && !empty($_POST['selectCourse'])){
			$course_id = filter_var(htmlspecialchars(trim($_POST['selectCourse'])),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_course"]="Select Course";
		}
		if(isset($_POST['joinYear']) && !empty($_POST['joinYear'])){
			$join_year = filter_var(htmlspecialchars(strtolower(trim($_POST['joinYear']))),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_year"]="Select joining year";
		}
		if(isset($_POST['leaveYear']) && !empty($_POST['leaveYear'])){
			$leave_year = filter_var(htmlspecialchars(strtolower(trim($_POST['leaveYear']))),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_leave"]="Select leaving year";
		}
		$profile = addslashes(file_get_contents("../../assets/img/profile.jpg"));

		if($upload_ok==1 && empty($report)){
			$query = "INSERT INTO STUDENTS (STUDENT_PRN, STUDENT_FIRSTNAME, STUDENT_LASTNAME, STUDENT_EMAIL, STUDENT_CONTACT, STUDENT_PROFILE, COURSE_ID, STUDENT_ACADEMIC_YEAR_START, STUDENT_ACADEMIC_YEAR_END)
			VALUES (:pr_number, :first_name, :last_name, :email, :contact, :profile, :course_id, :join_year, :leave_year);";
			$stmt = $dbh->prepare($query);
			if($stmt->execute(array(':pr_number' => $pr_number,
									':first_name' => $first_name,
									':last_name' => $last_name,
									':email' => $email,
									':contact' => $contact,
									':profile' => $profile,
									':course_id' => $course_id,
									':join_year' => $join_year,
									':leave_year' => $leave_year))){
										 $report["success"]="New student added successfully";
			}
			else{
				$report["error"]="failed to add student";
			}
		}
	}
	else{
		$report["error"]="No data submitted";
	}
	if(isset($report) && !empty($report)){
		echo json_encode($report);
	}

?>