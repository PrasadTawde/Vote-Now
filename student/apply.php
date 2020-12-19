<?php 
include_once("../config.php");
include_once("../login/functions.php");
if (!func::checkLoginState($dbh))
	{
		header("location:../login/login.php");
	}
	
	else if ($_SESSION['userType'] != "student") {
		header("Location:../../");	
	}
	$result = $dbh->prepare( "SELECT * FROM STUDENTS WHERE STUDENT_ID = :user_id" );
	$result->bindParam(':user_id', $_SESSION['userid']);

		$result->setFetchMode(PDO::FETCH_ASSOC);
		$result->execute();
		while ($result2=$result->fetch()) {
			$firstName = ucfirst($result2['STUDENT_FIRSTNAME']);
			$lastName = ucfirst($result2['STUDENT_LASTNAME']);
			$email = $result2['STUDENT_EMAIL'];
			$contact = $result2['STUDENT_CONTACT'];
			$profile  = $result2['STUDENT_PROFILE'];
			$course = $result2['COURSE_ID'];
		}
	$result =null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Elections</title>
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
						<li class="nav-item active">
							<a href="">
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
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Elections</h4>
					</div>
					<div class="col-md-10 ml-auto mr-auto">
						<div class="card">
							<div class="card-header">
								<div class="d-flex align-items-center">
									<h4 class="page-title">Elections</h4>
								</div>
							</div>
							<div class="card-body">
								<!-- Update Modal -->
								<div class="modal fade" id="updateApplicationModal" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header no-bd">
												<h5 class="modal-title">
													<span class="fw-mediumbold">
														Apply for Election
													</span>
												</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<form action="" method="POST" id="updateApplicationForm">
												<div class="modal-body" id="update_details">
													<!-- Updating form with jquery dynamic -->
												</div>
												<div class="modal-footer no-bd">
													<input class="submit btn btn-primary" id="updateApplicationButton" type="submit" value="Update"/>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
												</div>
											</form>
										</div>
									</div>
								</div>

								<div class="table-responsive">
									<table id="add-row" class="display table table-striped table-hover" >
										<thead>
											<tr>
												<th>No.</th>
												<th>Position</th>
												<th>Department</th>
												<th>Program</th>
												<th>Date</th>
												<th>Starting Time</th>
												<th>Ending Time</th>
												<th style="width: 10%">Apply</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$stmt = $dbh->prepare( "SELECT ELECTION_ID, ELECTIONS.POSITION_ID, ELECTION_DATE, ELECTION_START_TIME, ELECTION_END_TIME, POSITION_NAME, DEPARTMENTS.DEPARTMENT_NAME, COURSES.COURSE_NAME FROM ELECTIONS
													INNER JOIN POSITIONS ON ELECTIONS.POSITION_ID = POSITIONS.POSITION_ID
													INNER JOIN COURSES ON ELECTIONS.COURSE_ID = COURSES.COURSE_ID
													INNER JOIN DEPARTMENTS ON COURSES.DEPARTMENT_ID = DEPARTMENTS.DEPARTMENT_ID WHERE ELECTIONS.COURSE_ID = :course_id OR COURSES.COURSE_NAME = 'all'" );
												$stmt->bindParam(':course_id', $course);
												$stmt->setFetchMode(PDO::FETCH_ASSOC);
												$stmt->execute();
												$srno = 0;
												while ($result=$stmt->fetch()) {

													$srno++;
													$id = $result['ELECTION_ID'];
													$position_name = ucfirst($result['POSITION_NAME']);
													$dept_name = ucfirst($result['DEPARTMENT_NAME']);
													$course_name = ucfirst($result['COURSE_NAME']);
													$date = $result['ELECTION_DATE'];
													$start_time = $result['ELECTION_START_TIME'];
													$end_time = $result['ELECTION_END_TIME'];
											?>
											<tr>
												<td><?php echo $srno; ?></td>
												<td><?php echo $position_name; ?></td>
												<td><?php echo $dept_name; ?></td>
												<td><?php echo $course_name; ?></td>
												<td><?php echo $date; ?></td>
												<td><?php echo $start_time; ?></td>
												<td><?php echo $end_time; ?></td>
												<td>
													<div class="form-button-action">
														<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg edit_data" data-original-title="Apply" id="<?php echo $id;?>">
															<i class="fa fa-check-square"></i>
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

<!-- jQuery Scrollbar -->
<script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="../assets/js/plugin/datatables/datatables.min.js"></script>
<script src="../assets/js/plugin/moment/moment.min.js"></script>
<script src="../assets/js/plugin/datepicker/bootstrap-datetimepicker.min.js"></script>


<!-- Select2 -->
<script src="../assets/js/plugin/select2/select2.full.min.js"></script>

<!-- Sweet Alert -->
<script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

<!-- Azzara JS -->
<script src="../assets/js/ready.min.js"></script>
<script src="../assets/js/functions.js"></script>
<script src="../assets/js/modify_candidate.js"></script>

<script >
	$(document).ready(function() {

		// Add Row
		$('#add-row').DataTable({
			"pageLength": 5,
		});

	//edit election
	$(document).on('click','.edit_data',function(){
		var edit_data = $(this).attr('id');
		$.ajax({
				url: "apply/edit_application.php",
				type: "POST",
				data: {edit_data:edit_data},
				success:function(data){
					$("#update_details").html(data);
					$("#updateApplicationModal").modal('show');
				}
			});
	});

	//update course
	$('updateApplicationButton').click(function(e){
		e.preventDefault();
			$.ajax({
				url: "apply/modify_candidate.php",
				type: "POST",
				data: $("#updateApplicationForm").serialize(),
				success:function(data){
					swal("Successfully Applied!",{
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
					$("#updateApplicationModal").modal('hide');
				}
			});
	});

	});
</script>
</body>
</html>