<?php 
	include_once ("../../config.php");
	include_once("../../login/functions.php");
	if (!func::checkLoginState($dbh))
	{
		header("location:../login/login.php");
	}
	
	else if ($_SESSION['userType'] != "student") {
		header("Location:../../");	
	}

	if (isset($_POST['edit_data'])) 
	{
		$edit_id = $_POST['edit_data'];
		$status ="";
		$student_id = $_SESSION['userid'];
		$stmt = $dbh->prepare( "SELECT ELECTION_ID, ELECTIONS.POSITION_ID, ELECTION_DATE, ELECTION_START_TIME, ELECTION_END_TIME, POSITION_NAME, DEPARTMENTS.DEPARTMENT_NAME, COURSES.DEPARTMENT_ID, COURSES.COURSE_NAME, COURSES.COURSE_ID FROM ELECTIONS
				INNER JOIN POSITIONS ON ELECTIONS.POSITION_ID = POSITIONS.POSITION_ID
				INNER JOIN COURSES ON ELECTIONS.COURSE_ID = COURSES.COURSE_ID
				INNER JOIN DEPARTMENTS ON COURSES.DEPARTMENT_ID = DEPARTMENTS.DEPARTMENT_ID WHERE ELECTION_ID = :edit_id;" );
		$stmt->bindParam(':edit_id', $edit_id);

		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$stmt->execute();

		while ($result=$stmt->fetch()) {
			$election_id = $result['ELECTION_ID'];
			$position_id = $result['POSITION_ID'];
			$position_name = ucfirst($result['POSITION_NAME']);
			$dept_id = ucfirst($result['DEPARTMENT_ID']);
			$dept_name = ucfirst($result['DEPARTMENT_NAME']);
			$course_id = ucfirst($result['COURSE_ID']);
			$course_name = ucfirst($result['COURSE_NAME']);
			$date = $result['ELECTION_DATE'];
			$start_time = $result['ELECTION_START_TIME'];
			$end_time = $result['ELECTION_END_TIME'];
		}
	}
	unset($stmt);
	unset($result);

	$query = $dbh->prepare( "SELECT * FROM CANDIDATES
				INNER JOIN ELECTIONS ON CANDIDATES.ELECTION_ID = ELECTIONS.ELECTION_ID
				WHERE STUDENT_ID = :student_id AND ELECTIONS.ELECTION_ID = :election_id;" );
		$query->bindParam(':student_id', $student_id);
		$query->bindParam(':election_id', $election_id);
		// $query->setFetchMode(PDO::FETCH_ASSOC);
		$query->execute();

		if ($query->fetchColumn() > 0) {
			$status = 1;
		}else{
			$status = 2;
		}

?>

	<div class="row">
		<div class="col-sm-12 collapse">
			<div class="form-group form-group-default">
				<label>ID</label>
				<input id="electionId" type="text" class="form-control" name="electionId" value="<?php echo $election_id;?>">
				<input id="studentId" type="text" class="form-control" name="studentId" value="<?php echo $student_id;?>">
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
				<div class="form-check form-check-inline">
					<div class="custom-control custom-radio">
						<input type="radio" id="statusActive" name="statusCheck" class="custom-control-input" <?php 
								if ($status == 1) {
									echo "checked";
								}
						 ?> value="1">
						<label class="custom-control-label" for="statusActive">Apply</label>
					</div>
					<div class="custom-control custom-radio">
						<input type="radio" id="statusInactive" name="statusCheck" class="custom-control-input" <?php 
								if ($status == 2) {
									echo "checked";
								}
						 ?> value="2">
						<label class="custom-control-label" for="statusInactive">Cancel</label>
					</div>
				</div>
				<span class="text-danger" id="error_msg"></span>
			</div>
		</div>
	</div>