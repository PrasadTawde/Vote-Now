<?php 
	include_once ("../../config.php");

	if (isset($_POST['edit_id'])) 
	{
		$edit_id = $_POST['edit_id'];
		$stmt = $dbh->prepare( "SELECT STUDENT_ID, STUDENT_PRN, STUDENT_FIRSTNAME, STUDENT_LASTNAME, STUDENT_EMAIL, STUDENT_CONTACT, DEPARTMENTS.DEPARTMENT_ID, DEPARTMENTS.DEPARTMENT_NAME, COURSES.COURSE_ID, COURSE_NAME, STUDENT_ACADEMIC_YEAR_START, STUDENT_ACADEMIC_YEAR_END FROM STUDENTS,COURSES INNER JOIN DEPARTMENTS ON COURSES.DEPARTMENT_ID = DEPARTMENTS.DEPARTMENT_ID WHERE STUDENT_ID = :student_id AND DEPARTMENT_NAME != 'all'" );
		$stmt->bindParam(':student_id', $edit_id);

		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$stmt->execute();

		while ($result=$stmt->fetch()) {
			$id = $result['STUDENT_ID'];
			$pr = $result['STUDENT_PRN'];
			$first_name = ucfirst($result['STUDENT_FIRSTNAME']);
			$last_name = ucfirst($result['STUDENT_LASTNAME']);
			$email = $result['STUDENT_EMAIL'];
			$contact = $result['STUDENT_CONTACT'];
			$dept_id = $result['DEPARTMENT_ID'];
			$course_id = $result['COURSE_ID'];
			$course_name = $result['COURSE_NAME'];
			$dept_name = $result['DEPARTMENT_NAME'];
			$join_year = $result['STUDENT_ACADEMIC_YEAR_START'];
			$leave_year = $result['STUDENT_ACADEMIC_YEAR_END'];
		}
	}
	unset($stmt);
	unset($result);
?>

<div class="row">
	<div class="col-sm-12">
		<div class="col-sm-12 collapse">
			<div class="form-group form-group-default">
				<label>ID</label>
				<input id="id" type="text" class="form-control" name="id" value="<?php echo $id; ?>">
			</div>
		</div>
		<div class="form-group form-group-default">
			<label>Student PR Number</label>
			<input id="prNumberUpdate" name="prNumberUpdate" type="number" class="form-control" placeholder="Enter  student PR number." value="<?php echo $pr; ?>" disabled="">
			<span class="text-danger" id="error_pr"></span>
		</div>
		<div class="form-group form-group-default">
			<label>First Name</label>
			<input id="firstNameUpdate" name="firstNameUpdate" type="text" class="form-control" placeholder="Enter first name" value="<?php echo $first_name; ?>">
			<span class="text-danger" id="error_fname"></span>
		</div>
		<div class="form-group form-group-default">
			<label>Last Name</label>
			<input id="lastNameUpdate" name="lastNameUpdate" type="text" class="form-control" placeholder="Enter last name" value="<?php echo $last_name;?>">
			<span class="text-danger" id="error_lname"></span>
		</div>
		<div class="form-group form-group-default">
			<label>Email</label>
			<input id="emailUpdate" name="emailUpdate" type="email" class="form-control" placeholder="Enter email address" value="<?php echo $email; ?>">
			<span class="text-danger" id="error_email"></span>
		</div>
		<div class="form-group form-group-default">
			<label>Contact No</label>
			<input id="contactUpdate" name="contactUpdate" type="text" class="form-control" placeholder="Enter contact number" value="<?php echo $contact; ?>">
			<span class="text-danger" id="error_contact"></span>
		</div>
		<div class="form-group form-group-default">
			<label>Select Department</label>
			<select class="form-control" name="selectDeptUpdate" id="selectDeptUpdate">
				<option selected="" disabled="">---</option>
				<?php
					$stmt = $dbh->prepare( "SELECT * FROM DEPARTMENTS WHERE DEPARTMENT_NAME != 'all'");
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
			<label>Select Course</label>
			<select class="form-control" name="selectCourseUpdate" id="selectCourseUpdate">
				<option disabled="">Select Course</option>
				<?php
					$stmt = $dbh->prepare( "SELECT * FROM COURSES WHERE COURSE_ID = :course_id");
					$stmt->bindParam(':course_id', $course_id);
					$stmt->setFetchMode(PDO::FETCH_ASSOC);
					$stmt->execute();
					while ($result=$stmt->fetch()) {
						$id = $result['COURSE_ID'];
						$name = $result['COURSE_NAME'];
				?>
				<option value="<?php echo $id; ?>" <?php if($id == $dept_id){echo 'selected=""';} ?>><?php echo $name; ?></option>
			<?php } unset($stmt); unset($result); ?>
			</select>
			<span class="text-danger" id="error_course"></span>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Joining Year</label>
					<div class="input-group">
						<input type="text" class="form-control" id="joinYearUpdate" name="joinYearUpdate" placeholder="Select Year" value="<?php echo $join_year; ?>">
					</div>
					<span class="text-danger" id="error_year"></span>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Leaving Year</label>
					<div class="input-group">
						<input type="text" class="form-control" id="leaveYearUpdate" name="leaveYearUpdate" placeholder="Select Year" value="<?php echo $leave_year; ?>">
					</div>
					<span class="text-danger" id="error_leave"></span>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$('#joinYearUpdate').datetimepicker({
		format: 'YYYY',
		viewMode: "years",
	});
	$('#leaveYearUpdate').datetimepicker({
		format: 'YYYY',
		viewMode: "years",
	});

	//filling course select box
	$('#selectDeptUpdate').change(function(){
		var s2 = document.getElementById ('selectDeptUpdate');
		var selectDept = s2.options [s2.selectedIndex] .value;
		if(selectDept){
			$.ajax({
				type:'POST',
				url: 'student/get_course_select.php',
				data: {selectDept:selectDept},
				success:function (html) {
					$('#selectCourseUpdate').html(html);
				}
			});
		}else{
			$('#selectCourseUpdate').html('<option value="">Something went wrong!</option>');
		}
	});
</script>