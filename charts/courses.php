<?php 
header('Content-Type: application/json');
	include_once ("../config.php");

	$presentStatus = 1;
	$absentStatus = 2;
	$jmStatus = 3;
	$jdStatus = 4;
	$holidayStatus = 5;
	$yearFull = date('Y').'%';
	$yearSh = date('y', mktime(0, 0, 0, date('y')-1, 1, date('y')));
	$year1 = $yearFull.'-'.$yearSh;

	$data = array('');
	$labels = array('');
	$i=0;
	$stmt = $dbh->prepare("SELECT * FROM DEPARTMENTS");
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$stmt->execute();
	while ($result = $stmt->fetch()) {
		$dept_id = $result['DEPARTMENT_ID'];
		$dept_name = $result['DEPARTMENT_NAME'];

		$query = $dbh->prepare( "SELECT * FROM COURSES WHERE DEPARTMENT_ID = :dept_id");
		$query->bindParam(':dept_id', $dept_id);
		$query->setFetchMode(PDO::FETCH_ASSOC);
		$query->execute();
		$course_count = $query->rowCount();
		$data[$i] = $course_count;
		$labels[$i] = $dept_name;
		$i++;
	}

$dbh = null;
print json_encode($data);

 ?>