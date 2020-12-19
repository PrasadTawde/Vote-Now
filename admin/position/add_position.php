<?php 
include_once ("../../config.php");

$report=array();

	if(isset($_POST["submit"])){
		$upload_ok=1;
		if(isset($_POST['positionName']) && !empty($_POST['positionName'])){
			$position_name = filter_var(htmlspecialchars(strtolower(trim($_POST['positionName']))),FILTER_SANITIZE_STRING);
			$count = $dbh->prepare( "SELECT COUNT(*) FROM POSITIONS WHERE POSITION_NAME = :position_name" );
				$count->bindParam(':position_name', $position_name);
				$count->execute();
				if ($count->fetchColumn() > 0) {
					$upload_ok=0;
					$report["error_msg"]="Position name already exits.";
				}
		}
		else{
			$upload_ok=0;
			$report["error_msg"]="Enter Valid Position Name.";
		}

		if($upload_ok==1 && empty($report)){
			$query = "INSERT INTO POSITIONS (POSITION_NAME) VALUES (:position_name);";
			$stmt = $dbh->prepare($query);
			if($stmt->execute(array(':position_name' => $position_name))){
										 $report["success"]="New Position Added successfully";
			}
			else{
				$report["error"]="failed to add new position.";
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