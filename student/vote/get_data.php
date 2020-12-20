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

	date_default_timezone_set("Asia/Kolkata");
	$current_date = date("d/m/yy");
	$current_time = date("h:i a");
	$session_user_id = $_SESSION['userid'];


	if (isset($_POST['get_data'])) 
	{
		$get_data = $_POST['get_data'];
		$stmt = $dbh->prepare( "SELECT ELECTION_ID, ELECTIONS.POSITION_ID, ELECTION_DATE, ELECTION_START_TIME, ELECTION_END_TIME, POSITION_NAME, DEPARTMENTS.DEPARTMENT_NAME, COURSES.DEPARTMENT_ID, COURSES.COURSE_NAME, COURSES.COURSE_ID FROM ELECTIONS
				INNER JOIN POSITIONS ON ELECTIONS.POSITION_ID = POSITIONS.POSITION_ID
				INNER JOIN COURSES ON ELECTIONS.COURSE_ID = COURSES.COURSE_ID
				INNER JOIN DEPARTMENTS ON COURSES.DEPARTMENT_ID = DEPARTMENTS.DEPARTMENT_ID WHERE ELECTION_ID = :get_data;" );
		$stmt->bindParam(':get_data', $get_data);

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
<div class="col-sm-12">
	<div class="form-group form-group-default">
		<b>Position :</b>  <span><?php echo $position_name; ?></span><br>
		<b>Department :</b>  <span><?php echo $dept_name; ?></span><br>
		<b>Program :</b>  <span><?php echo $course_name; ?></span><br>
		<b>Date :</b>  <span><?php echo $date; ?></span><br>
		<b>From :</b>  <span><?php echo $start_time; ?></span><br>
		<b>Till :</b>  <span><?php echo $end_time; ?></span><br>
	</div>
	<div class="form-group form-group-default">
		<center><label for="">Candidates Name</label></center>
		<!-- while loop to print name -->
		<div class="col-sm-12 collapse">
			<div class="form-group form-group-default">
				<label>ID</label>
				<input id="studenId" type="text" class="form-control" name="studenId" value="<?php echo $session_user_id;?>">
				<input id="electionId" type="text" class="form-control" name="electionId" value="<?php echo $election_id;?>">
			</div>
		</div>
		<?php 
			$stmt = $dbh->prepare( "SELECT ELECTIONS.ELECTION_ID, STUDENT_FIRSTNAME, STUDENT_LASTNAME, COURSES.COURSE_NAME, DEPARTMENTS.DEPARTMENT_NAME, CANDIDATE_ID FROM ELECTIONS
				INNER JOIN CANDIDATES ON ELECTIONS.ELECTION_ID = CANDIDATES.ELECTION_ID
				INNER JOIN STUDENTS ON CANDIDATES.STUDENT_ID = STUDENTS.STUDENT_ID
				INNER JOIN COURSES ON STUDENTS.COURSE_ID = COURSES.COURSE_ID
				INNER JOIN DEPARTMENTS ON COURSES.DEPARTMENT_ID = DEPARTMENTS.DEPARTMENT_ID WHERE ELECTIONS.ELECTION_ID = :get_data;" );
			$stmt->bindParam(':get_data', $get_data);
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->execute();
			$no =0;
			$radio_id = 0;
			while ($result=$stmt->fetch()) {
				$no++;
				$radio_id++;
				$student_first = ucfirst($result['STUDENT_FIRSTNAME']);
				$student_last = ucfirst($result['STUDENT_LASTNAME']);
				$student_dept = ucwords($result['DEPARTMENT_NAME']);
				$student_course = ucwords($result['COURSE_NAME']);
				$candidate_id = $result['CANDIDATE_ID'];
				?>
					<div class="form-check form-check-inline">
						<div class="custom-control custom-radio">
							<input type="radio" id="statusActive<?php echo $radio_id; ?>" name="vote_check" class="custom-control-input" value="<?php echo $candidate_id; ?>">
							<label class="custom-control-label" for="statusActive<?php echo $radio_id; ?>"><?php echo $no.") ".$student_first." ".$student_last; ?></label>
						</div>
					</div>
				<?php
			}
		 ?>
	</div>
</div>

<!-- 
<script>
		//give vote
		$('updateVoteButton').click(function(e){
			e.preventDefault();
			swal({
				title: 'Are you sure?',
				text: "Once vote is casted you cannot revert it!",
				icon: 'warning',
				buttons:{
					confirm: {
						text : 'Yes, delete it!',
						className : 'btn btn-success'
					},
					cancel: {
						visible: true,
						className: 'btn btn-danger'
					}
				}
			}).then((Delete) => {
				if (Delete) {
					var edit_id = $(this).attr('id');
					$.ajax({
							url: "vote/update_vote.php",
							type: "POST",
							data: $("#vote_form").serialize(),
						});
					swal({
						title: 'Voted!',
						text: 'Your vote successfully recorded!',
						icon: 'success',
						buttons : {
							confirm: {
								className : 'btn btn-success'
							}
						},
						}).then(function () {
							swal.close();
							location.reload();
						});
					} else {
						swal.close();
						location.reload();
					}
				});
			});
</script> -->