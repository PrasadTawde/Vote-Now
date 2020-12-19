<?php 
	include_once ("../../config.php");

	if (isset($_POST['edit_id'])) 
	{
		$position_id = filter_var(htmlspecialchars(trim($_POST['edit_id'])),FILTER_SANITIZE_STRING);
		$query = $dbh->prepare( "DELETE FROM POSITIONS WHERE POSITION_ID = :position_id" );
		$query->bindParam(':position_id', $position_id);
		$query->execute();
	}
	unset($query);
?>
