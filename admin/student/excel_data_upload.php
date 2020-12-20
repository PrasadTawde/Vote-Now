<?php
include_once('../../config.php');
if (!empty($_FILES['customFile']['name'])) 
{
	$output = '';  
    $allowed_ext = array("csv");
    $temp = explode(".",$_FILES['customFile']['name']);  
    $extension = end($temp);

    if (in_array($extension, $allowed_ext)) {
    	$file_data = fopen($_FILES["customFile"]["tmp_name"], 'r');  
        fgetcsv($file_data);

        while ($row = fgetcsv($file_data)) {
        	$admission_no=$row[0];
			$first_name=$row[1];
			$last_name=$row[2];
			$address=$row[3];
			$s_email=$row[4];
			$s_contact=$row[5];
			$s_course=$row[6];
			$s_division=$row[7];


			$query = "INSERT INTO STUDENTS (STUDENT_PRN, STUDENT_FIRSTNAME, STUDENT_LASTNAME, STUDENT_EMAIL, STUDENT_CONTACT, STUDENT_PASSWORD, STUDENT_ACADEMIC_YEAR_START, STUDENT_ACADEMIC_YEAR_END)
			VALUES (:pr_number, :first_name, :last_name, :email, :contact, :password, :join_year, :leave_year);";

			$stmt = $dbh->prepare($query);
					$stmt->execute(array(':pr_number' => $admission_no,
										 ':first_name' => $first_name,
										 ':last_name' => $last_name,
										 ':email' => $s_email,
										 ':contact' => $s_contact,
										 ':password' => $hashPass,
										 ':join_year' => $join_year,
										 ':leave_year' => $leave_year,));
        }
    }
    else{
    	echo 'Error1';
    }  
 }  
 else  
 {  
      echo "Error2";  
 } 

?>
