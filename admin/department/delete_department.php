<?php 
	include_once ("../../config.php");

	if (isset($_POST['edit_id'])) 
	{
		$dept_id = filter_var(htmlspecialchars(trim($_POST['edit_id'])),FILTER_SANITIZE_STRING);
		$query = $dbh->prepare( "DELETE FROM DEPARTMENTS WHERE DEPARTMENT_ID = :dept_id" );
		$query->bindParam(':dept_id', $dept_id);
		$query->execute();
	}
	unset($query);
?>
