<?php 
include_once ("../../config.php");

$report=array();

	if(isset($_POST["submit"])){
		$upload_ok=1;
		if(isset($_POST['idcourse']) && !empty($_POST['idcourse'])){
			$course_id = filter_var(htmlspecialchars(strtolower(trim($_POST['idcourse']))),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["dept_error"]="";
		}
		if(isset($_POST['selectDept']) && !empty($_POST['selectDept'])){
			$dept_id = filter_var(htmlspecialchars(strtolower(trim($_POST['selectDept']))),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["dept_error"]="Select Department.";
		}
		if(isset($_POST['nameprogram']) && !empty($_POST['nameprogram'])){
			$program_name = filter_var(htmlspecialchars(strtolower(trim($_POST['nameprogram']))),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["course_error"]="Enter a valid Program name.";
		}

		if($upload_ok==1 && empty($report)){
			$query = "UPDATE COURSES SET DEPARTMENT_ID = :dept_id, COURSE_NAME = :program_name WHERE COURSE_ID = :course_id;";
			$stmt = $dbh->prepare($query);
			if($stmt->execute(array(':dept_id' => $dept_id, 
									':program_name' => $program_name, 
									':course_id' => $course_id))){
										 $report["success"]="Program updated successfully!";
			}
			else{
				$report["error"]="failed to update Program details";
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