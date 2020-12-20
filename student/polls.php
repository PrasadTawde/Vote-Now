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
			$first_name = ucfirst($result2['STUDENT_FIRSTNAME']);
			$last_name = ucfirst($result2['STUDENT_LASTNAME']);
			$email = $result2['STUDENT_EMAIL'];
			$contact = $result2['STUDENT_CONTACT'];
			$profile  = $result2['STUDENT_PROFILE'];
		}
	$result =null;
	date_default_timezone_set("Asia/Kolkata");
	$current_date = date("d/m/yy");
	$current_time = date("h:i a");
?>
<html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Polls</title>
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
									<img src="data:image/jpeg;base64,<?php echo base64_encode($profile);?>" alt="profile" class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<li>
									<div class="user-box">
										<div class="avatar-lg"><img src="data:image/jpeg;base64,<?php echo base64_encode($profile);?>" alt="profile" class="avatar-img rounded"></div>
										<div class="u-text">
											<h4><?php echo $first_name." ". $last_name ?></h4>
											<p class="text-muted"><?php echo $email; ?></p>
										</div>
									</div>
								</li>
								<li>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="profile/profile.php">My Profile</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="../login/logout.php">Logout</a>>
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
							<a href="elections.php">
								<i class="fas fa-user-clock"></i>
								<p>Elections</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="apply.php">
								<i class="fas fa-edit"></i>
								<p>Apply</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="votes.php">
								<i class="fas fa-door-closed"></i>
								<p>Vote</p>
							</a>
						</li>
						<li class="nav-item active">
							<a href="">
								<i class="fas fa-chart-bar"></i>
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
					<h4 class="page-title">Polls</h4>
					<div class="col-md-12">
						<div class="card">
							<div class="card-body">
								<!-- Update Modal -->
								<div class="modal fade" id="updateElectionModal" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header no-bd">
												<h5 class="modal-title">
													<span class="fw-mediumbold">
														Election details
													</span>
												</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div id="update_details">
												<!-- Updating form with jquery dynamic -->
											</div>
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
												<th style="width: 10%">View</th>
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
													$time1 = DateTime::createFromFormat('h:i a', $current_time);
													$time2 = DateTime::createFromFormat('h:i a', $start_time);
													$time3 = DateTime::createFromFormat('h:i a', $end_time);
											?>
											<tr>
												<td><?php echo $srno; ?></td>
												<td><?php echo $position_name; ?></td>
												<td><?php echo $dept_name; ?></td>
												<td><?php echo $course_name; ?></td>
												<td><?php echo $date; ?></td>
												<td>
													<div class="form-button-action">
														<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg view_data" data-original-title="View Details" id="<?php echo $id;?>">
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


<!-- Datatables -->
<script src="../assets/js/plugin/datatables/datatables.min.js"></script>


<!-- Bootstrap Tagsinput -->
<script src="../assets/js/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>

<!-- Bootstrap Wizard -->
<script src="../assets/js/plugin/bootstrap-wizard/bootstrapwizard.js"></script>

<!-- jQuery Validation -->
<script src="../assets/js/plugin/jquery.validate/jquery.validate.min.js"></script>

<script src="../assets/js/plugin/chart.js/chart.min.js"></script>

<!-- Select2 -->
<script src="../assets/js/plugin/select2/select2.full.min.js"></script>
<script src="../assets/js/plugin/moment/moment.min.js"></script>
<script src="../assets/js/plugin/datepicker/bootstrap-datetimepicker.min.js"></script>

<!-- Sweet Alert -->
<script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

<!-- Azzara JS -->
<script src="../assets/js/ready.min.js"></script>
<script>
	$('#dateSelect').datetimepicker({
			format: 'DD/MM/YYYY',
			daysOfWeekDisabled: [0],
			minDate: moment(),
	});
	$('#timeFrom').datetimepicker({
		format: 'h:mm A', 
		// disabledTimeIntervals: [
  //     		[moment().hour(0).minutes(0), moment().hour(8).minutes(30)],
  //     		[moment().hour(20).minutes(30), moment().hour(24).minutes(0)]
  //     	]
	});
	$('#timeTo').datetimepicker({
		format: 'h:mm A', 
	});

	$(document).ready(function() {

		// Add Row
		$('#add-row').DataTable({
			"pageLength": 5,
		});

	//edit election
	$(document).on('click','.view_data',function(){
		var view_data = $(this).attr('id');
		$.ajax({
				url: "polls/view_results.php",
				type: "POST",
				data: {view_data:view_data},
				success:function(data){
					$("#update_details").html(data);
					$("#updateElectionModal").modal('show');
				}
			});
	});

	});
</script>
</body>
</html>