<?php 
	include_once ("../../config.php");

	if (isset($_POST['edit_id'])) 
	{
		$course_id = filter_var(htmlspecialchars(trim($_POST['edit_id'])),FILTER_SANITIZE_STRING);
		$query = $dbh->prepare( "DELETE FROM COURSES WHERE COURSE_ID = :course_id" );
		$query->bindParam(':course_id', $course_id);
		$query->execute();
	}
	unset($query);
?>
