<?php 
include_once ("../../config.php");

$report=array();

	if(isset($_POST["submit"])){
		$upload_ok=1;
		if(isset($_POST['iddpt']) && !empty($_POST['iddpt'])){
			$dept_id = filter_var(htmlspecialchars(strtolower(trim($_POST['iddpt']))),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["namedpt_error"]="";
		}
		if(isset($_POST['namedpt']) && !empty($_POST['namedpt'])){
			$dept_name = filter_var(htmlspecialchars(strtolower(trim($_POST['namedpt']))),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["namedpt_error"]="Enter a valid Department name.";
		}

		if($upload_ok==1 && empty($report)){
			$query = "UPDATE DEPARTMENTS SET DEPARTMENT_NAME = :dept_name WHERE DEPARTMENT_ID = :dept_id;";
			$stmt = $dbh->prepare($query);
			if($stmt->execute(array(':dept_name' => $dept_name, ':dept_id' => $dept_id))){
										 $report["success"]="Department Updated successfully!";
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
	unset($stmt);
?>