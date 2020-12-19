<?php 
	include_once ("../config.php");

	date_default_timezone_set("Asia/Kolkata");
	$current_date = date("d/m/yy");
	$current_time = date("h:i a");


	if (isset($_POST['view_data'])) 
	{
		$view_id = $_POST['view_data'];
		$stmt = $dbh->prepare( "SELECT ELECTION_ID, ELECTIONS.POSITION_ID, ELECTION_DATE, ELECTION_START_TIME, ELECTION_END_TIME, POSITION_NAME, DEPARTMENTS.DEPARTMENT_NAME, COURSES.DEPARTMENT_ID, COURSES.COURSE_NAME, COURSES.COURSE_ID FROM ELECTIONS
				INNER JOIN POSITIONS ON ELECTIONS.POSITION_ID = POSITIONS.POSITION_ID
				INNER JOIN COURSES ON ELECTIONS.COURSE_ID = COURSES.COURSE_ID
				INNER JOIN DEPARTMENTS ON COURSES.DEPARTMENT_ID = DEPARTMENTS.DEPARTMENT_ID WHERE ELECTION_ID = :view_id;" );
		$stmt->bindParam(':view_id', $view_id);

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
?>
<div class="modal-body">
	<div class="row">
		<div class="col-sm-12">
			<div class="form-group form-group-default">
				<b>Position :</b>  <span><?php echo $position_name; ?></span><br><br>
				<b>Department :</b>  <span><?php echo $dept_name; ?></span><br><br>
				<b>Program :</b>  <span><?php echo $course_name; ?></span><br><br>
				<b>Date :</b>  <span><?php echo $date; ?></span><br><br>
				<b>From :</b>  <span><?php echo $start_time; ?></span><br><br>
				<b>Till :</b>  <span><?php echo $end_time; ?></span><br><br>
				
			</div>
		</div>
	</div>
</div>
<div class="modal-footer no-bd">
<?php 
	$time1 = DateTime::createFromFormat('h:i a', $current_time);
	$time2 = DateTime::createFromFormat('h:i a', $start_time);
	$time3 = DateTime::createFromFormat('h:i a', $end_time);
	if ($current_date == $date && ($time1 > $time2 && $time1 < $time3))
	{
	   	?>
		<input class="submit btn btn-primary" id="updateElectionButton" type="submit" value="Vote"/>
		<?php
	}
 ?>
	<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>