<?php 
include_once ("../config.php");

$uemail = $_POST['uemail'];
$upassword = $_POST['upassword'];

	$options = array("cost"=>12);
$hashPassword = password_hash($upassword,PASSWORD_BCRYPT,$options);

		$query = "INSERT INTO USERS (USER_EMAIL, USER_PASSWORD )
		VALUES (:user_email, :user_password);";

		$stmt = $dbh->prepare($query);
				$stmt->execute(array(':user_email' => $uemail,
									 ':user_password' => $hashPassword));


 ?>

