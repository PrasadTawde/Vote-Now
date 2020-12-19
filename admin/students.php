<?php 
include_once("../config.php");
include_once("../login/functions.php");
if (!func::checkLoginState($dbh))
	{
		header("location:../login/login.php");
	}
	
	else if ($_SESSION['userType'] != "admin") {
		header("Location:../../");	
	}
	// 	$result = $dbh->prepare( "SELECT * FROM USERS WHERE USER_ID = :user_id" );
	// 	$result->bindParam(':user_id', $_SESSION['userid']);

	// 	$result->setFetchMode(PDO::FETCH_ASSOC);
	// 	$result->execute();
	// 	while ($result2=$result->fetch()) {
	// 		$firstName = ucfirst($result2['USER_FIRSTNAME']);
	// 		$lastName = ucfirst($result2['USER_LASTNAME']);
	// 		$email = $result2['USER_EMAIL'];
	// 		$contact = $result2['USER_CONTACT'];
	// 		$profile  = $result2['USER_PROFILE'];
	// 	}
	// $result =null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Students</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<!-- <link rel="icon" href="http://demo.themekita.com/azzara/livepreview/assets/img/icon.ico" type="image/x-icon"/> -->

	<!-- Fonts and icons -->
	<script src="../assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Open+Sans:300,400,600,700"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['../assets/css/fonts.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/azzara.min.css">

<!-- 	CSS Just for demo purpose, don't include it in your project
	<link rel="stylesheet" href="../assets/css/demo.css"> -->
</head>
<body>
	<div class="wrapper">
		<div class="main-header" data-background-color="blue">
			<!-- Logo Header -->
			<div class="logo-header">
				
				<a href="index.php" class="logo">
					<!-- <img src="http://demo.themekita.com/azzara/livepreview/assets/img/logoazzara.svg" alt="navbar brand" class="navbar-brand"> -->
				</a>
				<p class="h2 text-white">Vote Now</p>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="fa fa-bars"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
				<div class="navbar-minimize">
					<button class="btn btn-minimize btn-rounded">
						<i class="fa fa-bars"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg">
				
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="../assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<li>
									<div class="user-box">
										<div class="avatar-lg"><img src="../assets/img/profile.jpg" alt="image profile" class="avatar-img rounded"></div>
										<div class="u-text">
											<h4>Barry</h4>
											<p class="text-muted">hello@example.com</p>
										</div>
									</div>
								</li>
								<li>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="#">My Profile</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="#">Logout</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<div class="sidebar">
			
			<div class="sidebar-background"></div>
			<div class="sidebar-wrapper scrollbar-inner">
				<div class="sidebar-content">
					<ul class="nav">
						<li class="nav-item">
							<a href="index.php">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="positions.php">
								<i class="fas fas fa-user-tie"></i>
								<p>Manage Positions</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="candidates.php">
								<i class="fas far fa-address-card"></i>
								<p>Manage Candidates</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="elections.php">
								<i class="fas fa-edit"></i>
								<p>Elections</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="polls.php">
								<i class="fas fa-check"></i>
								<p>Polls</p>
							</a>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#dept">
								<i class="fas fas fa-school"></i>
								<p>Departments & Programs</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="dept">
								<ul class="nav nav-collapse">
									<li>
										<a href="departments.php">
											<span class="sub-item">Departments</span>
										</a>
									</li>
									<li>
										<a href="programs.php">
											<span class="sub-item">Programs</span>
										</a>
									</li>
								</ul>
							</div>
							<li class="nav-item active">
								<a href="">
									<i class="fas fa-id-card"></i>
									<p>Students</p>
								</a>
							</li>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Students</h4>
					</div>
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<div class="d-flex align-items-center">
									<h4 class="page-title">Students</h4>
									<button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#bulkUpload">
										<i class="fa fa-plus"></i>
										Bulk Upload
									</button>
									<button class="btn btn-primary btn-round ml-2" data-toggle="modal" data-target="#addStudentModal">
										<i class="fa fa-plus"></i>
										Add New Student
									</button>
								</div>
							</div>
							<div class="card-body">
								<!-- Add Modal -->
								<div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header no-bd">
												<h5 class="modal-title">
													<span class="fw-mediumbold">
														New	Student
													</span>
												</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<form action="" method="POST" id="studentForm">
												<div class="modal-body">
													<div class="row">
														<div class="col-sm-12">
															<div class="form-group form-group-default">
																<label>Student PR Number</label>
																<input id="prNumber" name="prNumber" type="number" class="form-control" placeholder="Enter  student PR number.">
																<span class="text-danger" id="error_pr"></span>
															</div>
															<div class="form-group form-group-default">
																<label>First Name</label>
																<input id="firstName" name="firstName" type="text" class="form-control" placeholder="Enter first name">
																<span class="text-danger" id="error_fname"></span>
															</div>
															<div class="form-group form-group-default">
																<label>Last Name</label>
																<input id="lastName" name="lastName" type="text" class="form-control" placeholder="Enter last name">
																<span class="text-danger" id="error_lname"></span>
															</div>
															<div class="form-group form-group-default">
																<label>Email</label>
																<input id="email" name="email" type="email" class="form-control" placeholder="Enter email address">
																<span class="text-danger" id="error_email"></span>
															</div>
															<div class="form-group form-group-default">
																<label>Contact No</label>
																<input id="contact" name="contact" type="text" class="form-control" placeholder="Enter contact number">
																<span class="text-danger" id="error_contact"></span>
															</div>
															<div class="form-group form-group-default">
																<label>Select Department</label>
																<select class="form-control" name="selectDept" id="selectDept">
																	<option selected="" disabled="">---</option>
																	<?php
																		$stmt = $dbh->prepare( "SELECT * FROM DEPARTMENTS WHERE DEPARTMENT_NAME != 'all';");
																		$stmt->setFetchMode(PDO::FETCH_ASSOC);
																		$stmt->execute();
																		while ($result=$stmt->fetch()) {
																			$id = $result['DEPARTMENT_ID'];
																			$name = $result['DEPARTMENT_NAME'];
																	?>
																	<option value="<?php echo $id; ?>"><?php echo $name; ?></option>
																<?php } unset($stmt); unset($result); ?>
																</select>
																<span class="text-danger" id="error_dept"></span>
															</div>
															<div class="form-group form-group-default">
																<label>Select Course</label>
																<select class="form-control" name="selectCourse" id="selectCourse">
																	<option selected="" disabled="">Select Department first</option>
																</select>
																<span class="text-danger" id="error_course"></span>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label>Joining Year</label>
																		<div class="input-group">
																			<input type="text" class="form-control" id="joinYear" name="joinYear" placeholder="Select Year">
																		</div>
																		<span class="text-danger" id="error_year"></span>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label>Leaving Year</label>
																		<div class="input-group">
																			<input type="text" class="form-control" id="leaveYear" name="leaveYear" placeholder="Select Year">
																		</div>
																		<span class="text-danger" id="error_leave"></span>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="modal-footer no-bd">
													<input class="submit btn btn-primary" id="addStudentButton" type="submit" value="Add"/>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
												</div>
											</form>
										</div>
									</div>
								</div>

								<!-- Update Modal -->
								<div class="modal fade" id="updateStudentModal" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header no-bd">
												<h5 class="modal-title">
													<span class="fw-mediumbold">
														Update Student Details
													</span>
												</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<form action="" method="POST" id="updateStudentForm">
												<div class="modal-body" id="update_details">
													<!-- Updating form with jquery dynamic -->
												</div>
												<div class="modal-footer no-bd">
													<input class="submit btn btn-primary" id="updateStudentButton" type="submit" value="Update"/>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
												</div>
											</form>
										</div>
									</div>
								</div>
								<!-- Bulk Upload model -->
								<div class="modal fade" id="bulkUpload" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header no-bd">
												<h5 class="modal-title">
													<span class="fw-mediumbold">
														New	Candidate
													</span>
												</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<form>
													<div class="row">
														<div class="col-sm-12">
															<div class="custom-file ">
															  <input type="file" name="customFile" class="custom-file-input" id="customFile">
															  <label class="custom-file-label" for="customFile">Choose Excel file</label>
															</div>
														</div>
													</div>
												</form>
											</div>
											<div class="modal-footer no-bd">
												<button type="button" id="addRowButton" class="btn btn-primary">Upload</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
											</div>
										</div>
									</div>
								</div>

								<div class="table-responsive">
									<table id="add-row" class="display table table-striped table-hover" >
										<thead>
											<tr>
												<th>&emsp;&emsp;No&emsp;&emsp;</th>
												<th>&emsp;&emsp;PR No&emsp;&emsp;</th>
												<th>&emsp;&emsp;First Name&emsp;&emsp;</th>
												<th>&emsp;&emsp;Last Name&emsp;&emsp;</th>
												<th>&emsp;&emsp;Email&emsp;&emsp;</th>
												<th>&emsp;&emsp;Contact No&emsp;&emsp;</th>
												<th>&emsp;&emsp;Department&emsp;&emsp;</th>
												<th>&emsp;&emsp;Course&emsp;&emsp;</th>
												<th>&emsp;&emsp;Joining Year&emsp;&emsp;</th>
												<th>&emsp;&emsp;Leaving Year&emsp;&emsp;</th>
												<th style="width: 10%">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$stmt = $dbh->prepare( "SELECT STUDENT_ID, STUDENT_PRN, STUDENT_FIRSTNAME, STUDENT_LASTNAME, STUDENT_EMAIL, STUDENT_CONTACT, DEPARTMENTS.DEPARTMENT_NAME, COURSE_NAME, STUDENT_ACADEMIC_YEAR_START, STUDENT_ACADEMIC_YEAR_END FROM STUDENTS,COURSES INNER JOIN DEPARTMENTS ON COURSES.DEPARTMENT_ID = DEPARTMENTS.DEPARTMENT_ID WHERE DEPARTMENT_NAME != 'all';" );
												$stmt->setFetchMode(PDO::FETCH_ASSOC);
												$stmt->execute();
												$srno = 0;
												while ($result=$stmt->fetch()) {

													$srno++;
													$id = $result['STUDENT_ID'];
													$pr = $result['STUDENT_PRN'];
													$first_name = ucfirst($result['STUDENT_FIRSTNAME']);
													$last_name = ucfirst($result['STUDENT_LASTNAME']);
													$email = $result['STUDENT_EMAIL'];
													$contact = $result['STUDENT_CONTACT'];
													$course_name = $result['COURSE_NAME'];
													$dept_name = $result['DEPARTMENT_NAME'];
													$join_year = $result['STUDENT_ACADEMIC_YEAR_START'];
													$leave_year = $result['STUDENT_ACADEMIC_YEAR_END'];
											?>
											<tr>
												<td><?php echo $srno; ?></td>
												<td><?php echo $pr; ?></td>
												<td><?php echo $first_name; ?></td>
												<td><?php echo $last_name; ?></td>
												<td><?php echo $email; ?></td>
												<td><?php echo $contact; ?></td>
												<td><?php echo $dept_name; ?></td>
												<td><?php echo $course_name; ?></td>
												<td><?php echo $join_year; ?></td>
												<td><?php echo $leave_year; ?></td>
												<td>
													<div class="form-button-action">
														<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg edit_data" data-original-title="Edit" id="<?php echo $id;?>">
															<i class="fa fa-edit"></i>
														</button>
														<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger delete_data" data-original-title="Delete" id="<?php echo $id;?>">
															<i class="fa fa-times"></i>
														</button>
													</div>
												</td>
											</tr>
										<?php } unset($result); unset($stmt);?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>
<!--   Core JS Files   -->
<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>

<!-- jQuery UI -->
<script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

<!-- Moment JS -->
<script src="../assets/js/plugin/moment/moment.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

<!-- Datatables -->
<script src="../assets/js/plugin/datatables/datatables.min.js"></script>

<!-- DateTimePicker -->
<script src="../assets/js/plugin/datepicker/bootstrap-datetimepicker.min.js"></script>

<!-- Select2 -->
<script src="../assets/js/plugin/select2/select2.full.min.js"></script>

<!-- Sweet Alert -->
<script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

<!-- Azzara JS -->
<script src="../assets/js/ready.min.js"></script>

<script src="../assets/js/functions.js"></script>
<script src="../assets/js/add_student.js"></script>
<script src="../assets/js/update_student.js"></script>

<script >
	$(document).ready(function() {

		// Add Row
		$('#add-row').DataTable({
			"pageLength": 5,
		});
		$('#joinYear').datetimepicker({
			format: 'YYYY',
			viewMode: "years",
		});
		$('#leaveYear').datetimepicker({
			format: 'YYYY',
			viewMode: "years",
		});

		//filling course select box
		$('#selectDept').change(function(){
			var s2 = document.getElementById ('selectDept');
			var selectDept = s2.options [s2.selectedIndex] .value;
			if(selectDept){
				$.ajax({
					type:'POST',
					url: 'student/get_course_select.php',
					data: {selectDept:selectDept},
					success:function (html) {
						$('#selectCourse').html(html);
					}
				});
			}else{
				$('#selectCourse').html('<option value="">Something went wrong!</option>');
			}
		});

	//Add Course
	$(function(){
		$('addStudentButton').click(function(e){
			e.preventDeafult();
				var prNumber = $('#prNumber').val();
				var firstName = $('#firstName').val();
				var lastName = $('#lastName').val();
				var email = $('#email').val();
				var contact = $('#contact').val();
				var selectDept = $('#selectDept').val();
				var selectCourse = $('#selectCourse').val();
				var joinYear = $('#joinYear').val();
				var leaveYear = $('#leaveYear').val();
				$.ajax({
					url: 'student/add_student.php',
					type: 'POST',
					data: {prNumber:prNumber, firstName:firstName, lastName:lastName, email:email, contact:contact, selectDept:selectDept, selectCourse:selectCourse, joinYear:joinYear, leaveYear:leaveYear},
					success:function(data){
						swal("Student Added Successfully !",{
							icon : "success",
							button : {
								confirm : {
									className : 'btn btn-success'
								}
							},
						}).then(function(){
							swal.close();
							location.reload();
						});
						$('#addStudentModal').modal('hide');
					}
				});
		});
	})

	//edit student
	$(document).on('click','.edit_data',function(){
		var edit_id = $(this).attr('id');
		$.ajax({
				url: "student/edit_student.php",
				type: "POST",
				data: {edit_id:edit_id},
				success:function(data){
					$("#update_details").html(data);
					$("#updateStudentModal").modal('show');
				}
			});
	});

	//update student
	$('updateStudentButton').click(function(e){
		e.preventDefault();
			$.ajax({
				url: "student/update_student.php",
				type: "POST",
				data: $("#updateStudentForm").serialize(),
				success:function(data){
					swal("Student record updated successfully!",{
						icon : "success",
						buttons: {       			
							confirm: {
								className : 'btn btn-success'
							}
						},
					}).then(function () {
						swal.close();
						location.reload();
					});
					$("#updateStudentModal").modal('hide');
				}
			});
	});
	// Delete student record
	$(document).on('click','.delete_data',function(){
			swal({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				buttons:{
					confirm: {
						text : 'Yes, delete it!',
						className : 'btn btn-success'
					},
					cancel: {
						visible: true,
						className: 'btn btn-danger'
					}
				}
			}).then((Delete) => {
				if (Delete) {
					var edit_id = $(this).attr('id');
					$.ajax({
							url: "student/delete_student.php",
							type: "POST",
							data: {edit_id:edit_id}
						});
					swal({
						title: 'Deleted!',
						text: 'Student record deleted successfully !',
						icon: 'success',
						buttons : {
							confirm: {
								className : 'btn btn-success'
							}
						},
						}).then(function () {
							swal.close();
							location.reload();
						});
					} else {
						swal.close();
						location.reload();
					}
				});
			});

	});
</script>
</body>
</html>