<?php 
	include_once("config.php");
	include_once ("login/functions.php");

	if (!func::checkLoginState($dbh)){
		
		header("location:login/login.php");
		
	}
	else if ($_SESSION['userType'] == "admin") {
		header("Location:Admin/index.php");
			
	}
	else if ($_SESSION['userType'] == "student") {
		
		header("Location:Student/index.php");
			
	}
	else {
		echo 'something went wrong';
	}
 ?>