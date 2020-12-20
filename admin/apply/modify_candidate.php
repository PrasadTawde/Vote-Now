<?php 
include_once ("../../config.php");

$report=array();

	if(isset($_POST["submit"])){
		$upload_ok=1;
		if(isset($_POST['electionId']) && !empty($_POST['electionId'])){
			$election_id = filter_var(htmlspecialchars(trim($_POST['electionId'])),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_msg"]="election.";
		}
		if(isset($_POST['studentId']) && !empty($_POST['studentId'])){
			$student_id = filter_var(htmlspecialchars(strtolower(trim($_POST['studentId']))),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_msg"]="student.";
		}
		if(isset($_POST['statusCheck']) && !empty($_POST['statusCheck'])){
			$status = filter_var(htmlspecialchars(trim($_POST['statusCheck'])),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_msg"]="Something went wrong, Try again.";
		}

		if($upload_ok==1 && empty($report)){
			$query = $dbh->prepare( "SELECT COUNT(*) FROM CANDIDATES WHERE STUDENT_ID = :student_id AND ELECTION_ID = :election_id;" );
			$query->execute(array(':student_id' => $student_id, ':election_id' => $election_id));
			$count = $query->fetchColumn();
			unset($query);

			if ($status == 1 && $count <= 0) {
				$query = "INSERT INTO CANDIDATES (ELECTION_ID, STUDENT_ID) VALUES (:election_id, :student_id);";
				$stmt = $dbh->prepare($query);
				if($stmt->execute(array(':election_id' => $election_id, ':student_id' => $student_id))){
											 $report["success"]="Successfully Applied.";
				}
				else{
					$report["error"]="failed to apply.";
				}
				unset($query);
				unset($stmt);
			}elseif ($status == 1 && $count > 0) {
				$query = "UPDATE CANDIDATES SET ELECTION_ID = :election_id, STUDENT_ID = :student_id WHERE ELECTION_ID = :election_id AND STUDENT_ID = :student_id;";
				$stmt = $dbh->prepare($query);
				if($stmt->execute(array(':election_id' => $election_id, ':student_id' => $student_id))){
											 $report["success"]="Successfully Applied.";
				}
				else{
					$report["error"]="failed to apply.";
				}
				unset($query);
				unset($stmt);
			}elseif ($status == 2 && $count > 0) {
				$query = "DELETE FROM CANDIDATES WHERE ELECTION_ID = :election_id AND STUDENT_ID = :student_id;";
				$stmt = $dbh->prepare($query);
				if($stmt->execute(array(':election_id' => $election_id, ':student_id' => $student_id))){
											 $report["error"]="Successfully Deleted.";
				}
				else{
					$report["error"]="failed to apply.";
				}
				unset($query);
				unset($stmt);
			}elseif ($status == 2 && $count <= 0) {
				$report["info"]="Successfully Applied.";
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