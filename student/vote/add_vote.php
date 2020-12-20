<?php 
include_once ("../../config.php");

$report=array();

	if(isset($_POST["submit"])){
		$upload_ok=1;
		if(isset($_POST['studenId']) && !empty($_POST['studenId'])){
			$student_id = filter_var(htmlspecialchars(trim($_POST['studenId'])),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_msg"]="Something went wrong, refreash page..";
		}
		if(isset($_POST['electionId']) && !empty($_POST['electionId'])){
			$election_id = filter_var(htmlspecialchars(trim($_POST['electionId'])),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_msg"]="Something went wrong, refreash page..";
		}
		if(isset($_POST['vote_check']) && !empty($_POST['vote_check'])){
			$candidate_id = filter_var(htmlspecialchars(strtolower(trim($_POST['vote_check']))),FILTER_SANITIZE_STRING);
		}
		else{
			$upload_ok=0;
			$report["error_msg"]="Select Candidate";
		}

		if($upload_ok==1 && empty($report)){
			$query = "INSERT INTO VOTES (ELECTION_ID, CANDIDATE_ID, STUDENT_ID, NO_OF_VOTES) VALUES (:election_id, :candidate_id, :student_id, 1);";
			$stmt = $dbh->prepare($query);
			if($stmt->execute(array(':election_id' => $election_id, ':candidate_id' => $candidate_id, ':student_id' => $student_id))){
										 $report["success"]="Your vote has been casted!";
			}
			else{
				$report["error"]="failed to vote";
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