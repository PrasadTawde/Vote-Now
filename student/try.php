<?php 
include_once("../config.php");
include_once("../login/functions.php");
if (!func::checkLoginState($dbh))
	{
		header("location:../login/login.php");
	}
	
	else if ($_SESSION['userType'] != "student") {
		header("Location:../../");	
	}
	$result = $dbh->prepare( "SELECT * FROM STUDENTS WHERE STUDENT_ID = :user_id" );
		$result->bindParam(':user_id', $_SESSION['userid']);

		$result->setFetchMode(PDO::FETCH_ASSOC);
		$result->execute();
		while ($result2=$result->fetch()) {
			$first_name = ucfirst($result2['STUDENT_FIRSTNAME']);
			$last_name = ucfirst($result2['STUDENT_LASTNAME']);
			$email = $result2['STUDENT_EMAIL'];
			$contact = $result2['STUDENT_CONTACT'];
			$profile  = $result2['STUDENT_PROFILE'];
		}
	$result =null;

	date_default_timezone_set("Asia/Kolkata");
	$current_date = date("d/m/yy");
	$current_time = date("h:i a");
	$session_user_id = $_SESSION['userid'];


	$stmt = $dbh->prepare( "SELECT ELECTION_ID, ELECTIONS.POSITION_ID, ELECTION_DATE, ELECTION_START_TIME, ELECTION_END_TIME, POSITION_NAME, DEPARTMENTS.DEPARTMENT_NAME, COURSES.COURSE_NAME FROM ELECTIONS
													INNER JOIN POSITIONS ON ELECTIONS.POSITION_ID = POSITIONS.POSITION_ID
													INNER JOIN COURSES ON ELECTIONS.COURSE_ID = COURSES.COURSE_ID
													INNER JOIN DEPARTMENTS ON COURSES.DEPARTMENT_ID = DEPARTMENTS.DEPARTMENT_ID WHERE ELECTIONS.COURSE_ID = :course_id OR COURSES.COURSE_NAME = 'all'" );
												$stmt->bindParam(':course_id', $course);
												$stmt->setFetchMode(PDO::FETCH_ASSOC);
												$stmt->execute();
												$srno = 0;
												while ($result=$stmt->fetch()) {

													$srno++;
													$id = $result['ELECTION_ID'];


$count = $dbh->prepare( "SELECT COUNT(*) FROM VOTES INNER JOIN ELECTIONS ON VOTES.ELECTION_ID = VOTES.ELECTION_ID WHERE VOTES.STUDENT_ID = :student_id AND VOTES.ELECTION_ID = :election_id" );
				$count->bindParam(':student_id', $session_user_id);
														$count->bindParam(':election_id', $id);
				$count->execute();
				if ($count->fetchColumn() == 0) {
					
					echo $id."string<br>";
				}

												}
?>