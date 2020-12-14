<?php 
include_once ("../../config.php");

$report=array();

	if(isset($_POST["submit"])){
		$upload_ok=1;
		if(isset($_POST['deptName']) && !empty($_POST['deptName'])){
			$dept_name = filter_var(htmlspecialchars(strtolower(trim($_POST['deptName']))),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["namedpt_error"]="Enter Department Name";
		}

		if($upload_ok==1 && empty($report)){
			$query = "INSERT INTO DEPARTMENTS (DEPARTMENT_NAME)
			VALUES (:department_name);";
			$stmt = $dbh->prepare($query);
			if($stmt->execute(array(':department_name' => $dept_name))){
										 $report["success"]="New department Added successfully";
			}
			else{
				$report["error"]="failed to create department";
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