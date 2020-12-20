<?php 
	include_once ("../../config.php");

	if (isset($_POST['candidate_id'])) 
	{
		$candidate_id = filter_var(htmlspecialchars(trim($_POST['candidate_id'])),FILTER_SANITIZE_STRING);
		$query = $dbh->prepare( "DELETE FROM CANDIDATES WHERE CANDIDATE_ID = :candidate_id" );
		$query->bindParam(':candidate_id', $candidate_id);
		$query->execute();
	}
	unset($query);
?>
