<?php 
include_once ("../../config.php");

$report=array();

	if(isset($_POST["submit"])){
		$upload_ok=1;
		if(isset($_POST['positionSelect']) && !empty($_POST['positionSelect'])){
			$position_id = filter_var(htmlspecialchars(trim($_POST['positionSelect'])),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_position"]="Select position.";
		}
		if(isset($_POST['deptSelect']) && !empty($_POST['deptSelect'])){
			$dept_id = filter_var(htmlspecialchars(strtolower(trim($_POST['deptSelect']))),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_dept"]="Select Department.";
		}
		if(isset($_POST['courseSelect']) && !empty($_POST['courseSelect'])){
			$course_id = filter_var(htmlspecialchars(strtolower(trim($_POST['courseSelect']))),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_course"]="Select Course.";
		}
		if(isset($_POST['dateSelect']) && !empty($_POST['dateSelect'])){
			$date_select = filter_var(htmlspecialchars(strtolower(trim($_POST['dateSelect']))),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_date"]="Select valid date.";
		}
		if(isset($_POST['timeFrom']) && !empty($_POST['timeFrom'])){
			$timeFrom = filter_var(htmlspecialchars(strtolower(trim($_POST['timeFrom']))),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_time_from"]="Select valid time.";
		}
		if(isset($_POST['timeTo']) && !empty($_POST['timeTo'])){
			$timeTo = filter_var(htmlspecialchars(strtolower(trim($_POST['timeTo']))),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_time_to"]="Select a valid time.";
		}
		if($upload_ok==1 && empty($report)){
			if ($course_id == 'all') {
				$course_id = NULL;
			}
			$query = "INSERT INTO ELECTIONS (POSITION_ID, COURSE_ID, ELECTION_DATE, ELECTION_START_TIME, ELECTION_END_TIME)
			VALUES (:position_id, :course_id, :date_select, :timeFrom, :timeTo);";
			$stmt = $dbh->prepare($query);
			if($stmt->execute(array(':position_id' => $position_id,
									':course_id' => $course_id,
									':date_select' => $date_select,
									':timeFrom' => $timeFrom,
									':timeTo' => $timeTo))){
										 $report["success"]="New election scheduled successfully";
			}
			else{
				$report["error"]="failed to schedule election.";
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