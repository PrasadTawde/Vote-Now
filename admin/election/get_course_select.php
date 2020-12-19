<?php 
	include_once ("../../config.php");

	if (!empty($_POST['selectDept'])) {

	$selectDept = $_POST['selectDept'];
	$stmt = $dbh->prepare( "SELECT * FROM COURSES INNER JOIN DEPARTMENTS ON COURSES.DEPARTMENT_ID = DEPARTMENTS.DEPARTMENT_ID WHERE DEPARTMENTS.DEPARTMENT_ID = :dept_id");
	$stmt->bindParam(':dept_id', $selectDept);
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$stmt->execute();

	$count = $dbh->prepare( "SELECT COUNT(*) FROM COURSES INNER JOIN DEPARTMENTS ON COURSES.DEPARTMENT_ID = DEPARTMENTS.DEPARTMENT_ID WHERE DEPARTMENTS.DEPARTMENT_ID = :dept_id");
	$count->bindParam(':dept_id', $selectDept);
	$count->execute();

?>
	<option selected="" disabled="">--</option>
<?php 
	if ($count->fetchColumn() > 0) {
		while ($result = $stmt->fetch()) {
			$course_id = $result['COURSE_ID'];
			$course_name = $result['COURSE_NAME'];
			?>
			<option value="<?php echo $course_id ?>"><?php echo $course_name ?></option>
		<?php }
	}else{
		echo '<option>Courses Not Available</option>';
	}
	unset($stmt);
	unset($count);
	unset($result);
}
?>