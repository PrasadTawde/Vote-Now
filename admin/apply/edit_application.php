<?php 
	include_once ("../../config.php");
	include_once("../../login/functions.php");
	if (!func::checkLoginState($dbh))
	{
		header("location:../login/login.php");
	}
	
	else if ($_SESSION['userType'] != "admin") {
		header("Location:../../");	
	}

	if (isset($_POST['edit_data'])) 
	{
		$candidate_id = $_POST['edit_data'];
		$status ="";
		$student_id = $_SESSION['userid'];
		$stmt = $dbh->prepare( "SELECT CANDIDATES.CANDIDATE_ID, POSITIONS.POSITION_NAME, DEPARTMENTS.DEPARTMENT_NAME, COURSES.COURSE_NAME, ELECTIONS.ELECTION_ID, ELECTIONS.ELECTION_DATE, ELECTIONS.ELECTION_START_TIME, ELECTIONS.ELECTION_END_TIME, STUDENTS.STUDENT_FIRSTNAME, STUDENTS.STUDENT_LASTNAME, ELECTIONS.POSITION_ID
		FROM CANDIDATES 
		INNER JOIN STUDENTS ON CANDIDATES.STUDENT_ID =STUDENTS.STUDENT_ID
		INNER JOIN ELECTIONS ON CANDIDATES.ELECTION_ID = ELECTIONS.ELECTION_ID
		INNER JOIN POSITIONS ON ELECTIONS.POSITION_ID = POSITIONS.POSITION_ID
		INNER JOIN COURSES ON ELECTIONS.COURSE_ID = COURSES.COURSE_ID
		INNER JOIN DEPARTMENTS ON COURSES.DEPARTMENT_ID = DEPARTMENTS.DEPARTMENT_ID
		WHERE CANDIDATE_ID = :candidate_id;" );
		$stmt->bindParam(':candidate_id', $candidate_id);

		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$stmt->execute();

		while ($result=$stmt->fetch()) {
			$election_id = $result['ELECTION_ID'];
			$position_id = $result['POSITION_ID'];
			$position_name = ucfirst($result['POSITION_NAME']);
			$dept_name = ucfirst($result['DEPARTMENT_NAME']);
			$course_name = ucfirst($result['COURSE_NAME']);
			$date = $result['ELECTION_DATE'];
			$start_time = $result['ELECTION_START_TIME'];
			$end_time = $result['ELECTION_END_TIME'];
			$first_name = $result['STUDENT_FIRSTNAME'];
			$last_name = $result['STUDENT_LASTNAME'];
		}
	}
	unset($stmt);
	unset($result);

?>

	<div class="row">
		<div class="col-sm-12 collapse">
			<div class="form-group form-group-default">
				<label>ID</label>
				<input id="electionId" type="text" class="form-control" name="electionId" value="<?php echo $candidate_id;?>">
			</div>
		</div>
		<div class="col-sm-12">
			<div class="form-group form-group-default">
				<div class="ml-5">
					<br>
					<b>Position :</b>  <span><?php echo $position_name ?></span><br><br>
					<b>Department :</b>  <span><?php echo $dept_name ?></span><br><br>
					<b>Program :</b>  <span><?php echo $course_name ?></span><br><br>
					<b>Date :</b>  <span><?php echo $date ?></span><br><br>
					<b>From :</b>  <span><?php echo $start_time ?></span><br><br>
					<b>Till :</b>  <span><?php echo $end_time ?></span><br><br>
				</div>
			</div>
			<div class="form-group form-group-default">
				<center><label for="">Candidates Name</label></center>
<?php 
$stmt = $dbh->prepare( "SELECT CANDIDATES.CANDIDATE_ID, POSITIONS.POSITION_NAME, DEPARTMENTS.DEPARTMENT_NAME, COURSES.COURSE_NAME, ELECTIONS.ELECTION_ID, ELECTIONS.ELECTION_DATE, ELECTIONS.ELECTION_START_TIME, ELECTIONS.ELECTION_END_TIME, STUDENTS.STUDENT_FIRSTNAME, STUDENTS.STUDENT_LASTNAME, ELECTIONS.POSITION_ID
		FROM CANDIDATES 
		INNER JOIN STUDENTS ON CANDIDATES.STUDENT_ID =STUDENTS.STUDENT_ID
		INNER JOIN ELECTIONS ON CANDIDATES.ELECTION_ID = ELECTIONS.ELECTION_ID
		INNER JOIN POSITIONS ON ELECTIONS.POSITION_ID = POSITIONS.POSITION_ID
		INNER JOIN COURSES ON ELECTIONS.COURSE_ID = COURSES.COURSE_ID
		INNER JOIN DEPARTMENTS ON COURSES.DEPARTMENT_ID = DEPARTMENTS.DEPARTMENT_ID
		WHERE CANDIDATE_ID = :candidate_id;" );
		$stmt->bindParam(':candidate_id', $candidate_id);

		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$stmt->execute();

		while ($result=$stmt->fetch()) {
			$election_id = $result['ELECTION_ID'];
			$position_id = $result['POSITION_ID'];
			$position_name = ucfirst($result['POSITION_NAME']);
			$dept_name = ucfirst($result['DEPARTMENT_NAME']);
			$course_name = ucfirst($result['COURSE_NAME']);
			$date = $result['ELECTION_DATE'];
			$start_time = $result['ELECTION_START_TIME'];
			$end_time = $result['ELECTION_END_TIME'];
			$first_name = $result['STUDENT_FIRSTNAME'];
			$last_name = $result['STUDENT_LASTNAME'];
		
 ?>
					<b><?php echo $first_name." ".$last_name ?></b><br><br>
				<?php } ?>
				</div>
			</div>
		</div>
	</div>