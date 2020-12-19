<?php 
	include_once ("../../config.php");

	if (isset($_POST['edit_id'])) 
	{
		$edit_id = $_POST['edit_id'];
		$result = $dbh->prepare( "SELECT * FROM DEPARTMENTS WHERE DEPARTMENT_ID = :department_id" );
		$result->bindParam(':department_id', $edit_id);

		$result->setFetchMode(PDO::FETCH_ASSOC);
		$result->execute();

		while ($result2=$result->fetch()) {
			$id = $result2['DEPARTMENT_ID'];
			$name = $result2['DEPARTMENT_NAME'];
		}
	}
	unset($result);
	unset($result2);
?>

	<div class="row">
		<div class="col-sm-12 collapse">
			<div class="form-group form-group-default">
				<label>ID</label>
				<input id="iddpt" type="text" class="form-control" name="iddpt" value="<?php echo $id; ?>">
			</div>
		</div>
		<div class="col-sm-12">
			<div class="form-group form-group-default">
				<span class="text-danger" id="namedpt_error"></span>
				<label>Name Of The Department</label>
				<input id="namedpt" type="text" class="form-control" name="namedpt" value="<?php echo $name; ?>" placeholder="Enter name of Ddepartment" required>
			</div>
		</div>
	</div>