<?php 
	include_once ("../../config.php");

	if (isset($_POST['edit_id'])) 
	{
		$edit_id = $_POST['edit_id'];
		$stmt = $dbh->prepare( "SELECT * FROM POSITIONS WHERE POSITION_ID = :position_id;" );
		$stmt->bindParam(':position_id', $edit_id);

		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$stmt->execute();

		while ($result=$stmt->fetch()) {
			$position_id = $result['POSITION_ID'];
			$position_name = $result['POSITION_NAME'];
		}
	}
	unset($stmt);
	unset($result);
?>

	<div class="row">
		<div class="col-sm-12 collapse">
			<div class="form-group form-group-default">
				<label>ID</label>
				<input id="idPosition" type="text" class="form-control" name="idPosition" value="<?php echo $position_id;?>">
			</div>
		</div>
		<div class="col-sm-12">
			<div class="form-group form-group-default">
				<label>Position Name</label>
				<input id="positionName" type="text" class="form-control" name="positionName" value="<?php echo $position_name; ?>" placeholder="Enter name of position">
				<span class="text-danger" id="error_msg"></span>
			</div>
		</div>
	</div>