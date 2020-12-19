<?php 
	include_once ("../../config.php");

	if (isset($_POST['edit_id'])) 
	{
		$edit_id = $_POST['edit_id'];
		$stmt = $dbh->prepare( "SELECT ELECTION_ID, ELECTIONS.POSITION_ID, ELECTION_DATE, ELECTION_START_TIME, ELECTION_END_TIME, POSITION_NAME, DEPARTMENTS.DEPARTMENT_NAME, COURSES.DEPARTMENT_ID, COURSES.COURSE_NAME, COURSES.COURSE_ID FROM ELECTIONS
				INNER JOIN POSITIONS ON ELECTIONS.POSITION_ID = POSITIONS.POSITION_ID
				INNER JOIN COURSES ON ELECTIONS.COURSE_ID = COURSES.COURSE_ID
				INNER JOIN DEPARTMENTS ON COURSES.DEPARTMENT_ID = DEPARTMENTS.DEPARTMENT_ID WHERE ELECTION_ID = :election_id;" );
		$stmt->bindParam(':election_id', $edit_id);

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

	<div class="row">
		<div class="col-sm-12 collapse">
			<div class="form-group form-group-default">
				<label>ID</label>
				<input id="idcourse" type="text" class="form-control" name="idcourse" value="<?php echo $election_id;?>">
			</div>
		</div>
		<div class="col-sm-12">
			<div class="form-group form-group-default">
				<label>Select Position</label>
				<select class="form-control" id="positionSelect" name="positionSelect">
					<option selected="" disabled="">--</option>
					<?php
						$stmt = $dbh->prepare( "SELECT * FROM POSITIONS");
						$stmt->setFetchMode(PDO::FETCH_ASSOC);
						$stmt->execute();
						while ($result=$stmt->fetch()) {
							$id = $result['POSITION_ID'];
							$name = $result['POSITION_NAME'];
					?>
					<option value="<?php echo $id; ?>" <?php if($id == $position_id){echo 'selected=""';} ?>><?php echo $name; ?></option>
				<?php } unset($stmt); unset($result); ?>
				</select>
				<span class="text-danger" id="error_position"></span>
			</div>
			<div class="form-group form-group-default">
				<label>Select Department</label>
				<select class="form-control" id="deptSelectUpdate" name="deptSelectUpdate">
					<option selected="" disabled="">--</option>
					<?php
						$stmt = $dbh->prepare( "SELECT * FROM DEPARTMENTS");
						$stmt->setFetchMode(PDO::FETCH_ASSOC);
						$stmt->execute();
						while ($result=$stmt->fetch()) {
							$id = $result['DEPARTMENT_ID'];
							$name = $result['DEPARTMENT_NAME'];
					?>
					<option value="<?php echo $id; ?>" <?php if($id == $dept_id){echo 'selected=""';} ?>><?php echo $name; ?></option>
				<?php } unset($stmt); unset($result); ?>
				</select>
				<span class="text-danger" id="error_dept"></span>
			</div>
			<div class="form-group form-group-default">
				<label>Select Program</label>
				<select class="form-control" id="courseSelectUpdate" name="courseSelectUpdate">
					<option selected="" disabled="">--</option>
					<?php
						$stmt = $dbh->prepare( "SELECT * FROM COURSES WHERE DEPARTMENT_ID = :dept_id");
						$stmt->bindParam(':dept_id', $dept_id);
						$stmt->setFetchMode(PDO::FETCH_ASSOC);
						$stmt->execute();
						while ($result=$stmt->fetch()) {
							$id = $result['COURSE_ID'];
							$name = $result['COURSE_NAME'];
					?>
					<option value="<?php echo $id; ?>" <?php if($id == $course_id){echo 'selected=""';} ?>><?php echo $name; ?></option>
				<?php } unset($stmt); unset($result); ?>
				</select>
				<span class="text-danger" id="error_course"></span>
			</div>
			<div class="form-group">
				<label>Select Date</label>
				<div class="input-group">
					<input type="text" class="form-control" id="dateSelect" name="dateSelect" value="<?php echo $date; ?>">
					<div class="input-group-append">
						<span class="input-group-text">
							<i class="fa fa-calendar-check"></i>
						</span>
					</div>
				<span class="text-danger" id="error_date"></span>
				</div>
			</div>
			<div class="form-group">
				<label>Starting From</label>
				<div class="input-group">
					<input type="text" class="form-control" id="timeFrom" name="timeFrom" value="<?php echo $start_time; ?>">
					<div class="input-group-append">
						<span class="input-group-text">
							<i class="fa fa-clock"></i>
						</span>
					</div>
				</div>
				<span class="text-danger" id="error_time_from"></span>
			</div>
			<div class="form-group">
				<label>Ending On</label>
				<div class="input-group">
					<input type="text" class="form-control" id="timeTo" name="timeTo" value="<?php echo $end_time; ?>">
					<div class="input-group-append">
						<span class="input-group-text">
							<i class="fa fa-clock"></i>
						</span>
					</div>
				</div>
				<span class="text-danger" id="error_time_to"></span>
			</div>
		</div>
	</div>

	<script>
		//filling course select box
		$('#deptSelectUpdate').change(function(){
			var s2 = document.getElementById ('deptSelectUpdate');
			var selectDept = s2.options [s2.selectedIndex] .value;
			if(selectDept){
				$.ajax({
					type:'POST',
					url: 'election/get_course_select.php',
					data: {selectDept:selectDept},
					success:function (html) {
						$('#courseSelectUpdate').html(html);
					}
				});
			}else{
				$('#courseSelectUpdate').html('<option value="">Something went wrong!</option>');
			}
		});
	</script>