<?php 
include_once ("../../config.php");

$report=array();

	if(isset($_POST["submit"])){
		$upload_ok=1;
		if(isset($_POST['selectDept']) && !empty($_POST['selectDept'])){
			$dept_id = filter_var(htmlspecialchars(trim($_POST['selectDept'])),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_msg2"]="Select Department.";
		}
		if(isset($_POST['courseName']) && !empty($_POST['courseName'])){
			$course_name = filter_var(htmlspecialchars(strtolower(trim($_POST['courseName']))),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_msg"]="Enter Program Name";
		}

		if($upload_ok==1 && empty($report)){
			$query = "INSERT INTO COURSES (DEPARTMENT_ID, COURSE_NAME) VALUES (:department_id, :course_name);";
			$stmt = $dbh->prepare($query);
			if($stmt->execute(array(':department_id' => $dept_id, ':course_name' => $course_name))){
										 $report["success"]="New Course Added successfully";
			}
			else{
				$report["error"]="failed to create course";
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