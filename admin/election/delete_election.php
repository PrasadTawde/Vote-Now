<?php 
	include_once ("../../config.php");

	if (isset($_POST['edit_id'])) 
	{
		$election_id = filter_var(htmlspecialchars(trim($_POST['edit_id'])),FILTER_SANITIZE_STRING);
		$query = $dbh->prepare( "DELETE FROM ELECTIONS WHERE ELECTION_ID = :election_id" );
		$query->bindParam(':election_id', $election_id);
		$query->execute();
	}
	unset($query);
?>
