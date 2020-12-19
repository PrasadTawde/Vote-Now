<?php 
include_once ("../../config.php");

$report=array();

	if(isset($_POST["submit"])){
		$upload_ok=1;
		if(isset($_POST['idPosition']) && !empty($_POST['idPosition'])){
			$position_id = filter_var(htmlspecialchars(trim($_POST['idPosition'])),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_msg"]="";
		}
		if(isset($_POST['positionName']) && !empty($_POST['positionName'])){
			$position_name = filter_var(htmlspecialchars(strtolower(trim($_POST['positionName']))),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_msg"]="Enter valid position name.";
		}

		if($upload_ok==1 && empty($report)){
			$query = "UPDATE POSITIONS SET POSITION_NAME = :position_name WHERE POSITION_ID = :position_id;";
			$stmt = $dbh->prepare($query);
			if($stmt->execute(array(':position_name' => $position_name, 
									':position_id' => $position_id))){
										 $report["success"]="Program updated successfully!";
			}
			else{
				$report["error"]="failed to update Position details";
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