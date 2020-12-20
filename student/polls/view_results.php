<?php 
	include_once ("../../config.php");

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
			<div class="form-group form-group-default">
				<center><label for="">Candidates Name</label></center>
				<!-- while loop to print name -->
				<table class="table table-bordered table-head-bg-info table-bordered-bd-info mt-4">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Name</th>
							<th scope="col">Total</th>
						</tr>
					</thead>
					<tbody>
				<?php 
					

					$stmt = $dbh->prepare( "SELECT VOTE_ID, ELECTIONS.ELECTION_ID, STUDENT_FIRSTNAME, STUDENT_LASTNAME, COURSES.COURSE_NAME, DEPARTMENTS.DEPARTMENT_NAME, NO_OF_VOTES FROM ELECTIONS
						INNER JOIN CANDIDATES ON ELECTIONS.ELECTION_ID = CANDIDATES.ELECTION_ID
						INNER JOIN STUDENTS ON CANDIDATES.STUDENT_ID = STUDENTS.STUDENT_ID
						INNER JOIN COURSES ON STUDENTS.COURSE_ID = COURSES.COURSE_ID
                        LEFT JOIN VOTES ON ELECTIONS.ELECTION_ID = VOTES.ELECTION_ID
						INNER JOIN DEPARTMENTS ON COURSES.DEPARTMENT_ID = DEPARTMENTS.DEPARTMENT_ID WHERE ELECTIONS.ELECTION_ID = :view_id GROUP BY VOTE_ID, VOTES.CANDIDATE_ID;" );
					$stmt->bindParam(':view_id', $view_id);
					$stmt->setFetchMode(PDO::FETCH_ASSOC);
					
					$stmt->execute();
					$query = $dbh->prepare( "SELECT COUNT(*) FROM VOTES WHERE ELECTION_ID = :view_id;" );
						$query->bindParam(':view_id', $view_id);
						$query->setFetchMode(PDO::FETCH_ASSOC);
						$query->execute();
						$count = $query->fetchColumn();
					$no =0;
					while ($result=$stmt->fetch()) {
						$no++;
						$student_first = ucfirst($result['STUDENT_FIRSTNAME']);
						$student_last = ucfirst($result['STUDENT_LASTNAME']);
						$student_dept = ucwords($result['DEPARTMENT_NAME']);
						$student_course = ucwords($result['COURSE_NAME']);
						$no_of_votes = $result['NO_OF_VOTES'];
						

						?>
							<tr>
								<td><?php echo $no ?></td>
								<td><?php echo $student_first." ".$student_last ?></td>
								<td><?php echo $count ?></td>
							</tr>
						<?php
					}
				 ?>
				 	
				 </tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="modal-footer no-bd">
<?php 
	$time1 = DateTime::createFromFormat('h:i a', $current_time);
	$time2 = DateTime::createFromFormat('h:i a', $start_time);
	$time3 = DateTime::createFromFormat('h:i a', $end_time);
 ?>
	<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>