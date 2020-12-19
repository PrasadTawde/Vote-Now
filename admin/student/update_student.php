<?php 
include_once ("../../config.php");

$report=array();

	if(isset($_POST["submit"])){
		$upload_ok=1;
		if(isset($_POST['id']) && !empty($_POST['id'])){
			$student_id = filter_var(htmlspecialchars(strtolower(trim($_POST['id']))),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_pr"]="Something went wrong.";
		}
		if(isset($_POST['prNumberUpdate']) && !empty($_POST['prNumberUpdate'])){
			$pr_number = filter_var(htmlspecialchars(trim($_POST['prNumberUpdate'])),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_pr"]="Enter PR number";
		}
		if(isset($_POST['firstNameUpdate']) && !empty($_POST['firstNameUpdate'])){
			$first_name = filter_var(htmlspecialchars(strtolower(trim($_POST['firstNameUpdate']))),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_fname"]="Enter first name";
		}
		if(isset($_POST['lastNameUpdate']) && !empty($_POST['lastNameUpdate'])){
			$last_name = filter_var(htmlspecialchars(strtolower(trim($_POST['lastNameUpdate']))),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_lname"]="Enter last name";
		}
		if(isset($_POST['emailUpdate']) && !empty($_POST['emailUpdate'])){
			$email = filter_var(htmlspecialchars(strtolower(trim($_POST['emailUpdate']))),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_email"]="Enter email address";
		}
		if(isset($_POST['contactUpdate']) && !empty($_POST['contactUpdate'])){
			$contact = filter_var(htmlspecialchars(strtolower(trim($_POST['contactUpdate']))),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_contact"]="Enter contact number";
		}
		if(isset($_POST['selectDeptUpdate']) && !empty($_POST['selectDeptUpdate'])){
			$dept_id = filter_var(htmlspecialchars(trim($_POST['selectDeptUpdate'])),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_dept"]="Select Department";
		}
		if(isset($_POST['selectCourseUpdate']) && !empty($_POST['selectCourseUpdate'])){
			$course_id = filter_var(htmlspecialchars(trim($_POST['selectCourseUpdate'])),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_course"]="Select Course";
		}
		if(isset($_POST['joinYearUpdate']) && !empty($_POST['joinYearUpdate'])){
			$join_year = filter_var(htmlspecialchars(strtolower(trim($_POST['joinYearUpdate']))),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_year"]="Select joining year";
		}
		if(isset($_POST['leaveYearUpdate']) && !empty($_POST['leaveYearUpdate'])){
			$leave_year = filter_var(htmlspecialchars(strtolower(trim($_POST['leaveYearUpdate']))),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_leave"]="Select leaving year";
		}

		if($upload_ok==1 && empty($report)){
			$query = "UPDATE STUDENTS SET STUDENT_PRN = :pr_number, STUDENT_FIRSTNAME = :first_name, STUDENT_LASTNAME = :last_name, STUDENT_EMAIL = :email, STUDENT_CONTACT = :contact, COURSE_ID = :course_id, STUDENT_ACADEMIC_YEAR_START = :join_year, STUDENT_ACADEMIC_YEAR_END = :leave_year WHERE STUDENT_ID = :student_id;";
			$stmt = $dbh->prepare($query);
			if($stmt->execute(array(':pr_number' => $pr_number,
									'first_name' => $first_name,
									'last_name' => $last_name,
									':email' => $email,
									':contact' => $contact,
									':course_id' => $course_id,
									'join_year' => $join_year,
									':leave_year' => $leave_year,
									':student_id' => $student_id))){
										 $report["success"]="Student record updated successfully!";
			}
			else{
				$report["error"]="failed to update student record.";
			}
		}

	}
	else{
		$report["error"]="No data submitted";
	}
	if(isset($report) && !empty($report)){
		echo json_encode($report);
	}
	unset($stmt);
?>