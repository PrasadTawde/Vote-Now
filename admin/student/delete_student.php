<?php 
	include_once ("../../config.php");

	if (isset($_POST['edit_id'])) 
	{
		$student_id = filter_var(htmlspecialchars(trim($_POST['edit_id'])),FILTER_SANITIZE_STRING);
		$query = $dbh->prepare( "DELETE FROM STUDENTS WHERE STUDENT_ID = :student_id" );
		$query->bindParam(':student_id', $student_id);
		$query->execute();
	}
	unset($query);
?>
