<?php 
	include_once ("../../config.php");

	if (isset($_POST['edit_id'])) 
	{
		$edit_id = $_POST['edit_id'];
		$stmt = $dbh->prepare( "SELECT * FROM COURSES INNER JOIN DEPARTMENTS ON COURSES.DEPARTMENT_ID = DEPARTMENTS.DEPARTMENT_ID WHERE COURSE_ID = :course_id;" );
		$stmt->bindParam(':course_id', $edit_id);

		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$stmt->execute();

		while ($result=$stmt->fetch()) {
			$course_id = $result['COURSE_ID'];
			$dept_id = $result['DEPARTMENT_ID'];
			$dept_name = $result['DEPARTMENT_NAME'];
			$course_name = $result['COURSE_NAME'];
		}
	}
	unset($stmt);
	unset($result);
?>

	<div class="row">
		<div class="col-sm-12 collapse">
			<div class="form-group form-group-default">
				<label>ID</label>
				<input id="idcourse" type="text" class="form-control" name="idcourse" value="<?php echo $course_id;?>">
			</div>
		</div>
		<div class="col-sm-12">
			<div class="form-group form-group-default">
				<label>Select Department</label>
				<select class="form-control" name="selectDept" id="selectDept">
					<option disabled="">---</option>
					<?php 
						$stmt = $dbh->prepare( "SELECT * FROM DEPARTMENTS WHERE DEPARTMENT_NAME != 'all'");
						$stmt->setFetchMode(PDO::FETCH_ASSOC);
						$stmt->execute();
						while ($result=$stmt->fetch()) {
							$id = $result['DEPARTMENT_ID'];
							$name = $result['DEPARTMENT_NAME'];
					 ?>
					<option <?php if($id == $dept_id){echo 'selected=""';} ?> value="<?php echo $id; ?>"><?php echo $name; ?></option>
					<?php } unset($stmt); unset($result); ?>
				</select>
				<span class="text-danger" id="dept_error"></span>
			</div>
			<div class="form-group form-group-default">
				<label>Name Of The Program</label>
				<input id="nameprogram" type="text" class="form-control" name="nameprogram" value="<?php echo $course_name; ?>" placeholder="Enter name of Program">
				<span class="text-danger" id="course_error"></span>
			</div>
		</div>
	</div>