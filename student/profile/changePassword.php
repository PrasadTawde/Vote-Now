<?php 
include_once("../../config.php");
include_once("../../login/functions.php");
if (!func::checkLoginState($dbh))
	{
		header("location:../login/login.php");
	}
	
	else if ($_SESSION['userType'] != "student") {
		header("Location:../../../");	
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Turnout - Admin</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="../../assets/img/Logo.png" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="../../assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Montserrat:100,200,300,400,500,600,700,800,900"]},
			custom: {"families":["Flaticon", "LineAwesome"], urls: ['../../assets/css/fonts.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../assets/css/ready.min.css">
	<link rel="stylesheet" href="../../assets/css/demo.css">
	<!--   Core JS Files   -->
	<script src="../../assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="../../assets/js/core/popper.min.js"></script>
	<script src="../../assets/js/core/bootstrap.min.js"></script>
	<!-- Jquery Validation Engine -->
	<link rel="stylesheet" href="../../jQuery_Validation/css/validationEngine.jquery.css" type="text/css"/>
	<link rel="stylesheet" href="../../jQuery_Validation/css/template.css" type="text/css"/>
	<script src="../../jQuery_Validation/js/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8">
	</script>
	<script src="../../jQuery_Validation/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
	</script>

	<script>
		jQuery(document).ready( function() {
			jQuery("#profile_form").validationEngine();		
			jQuery("#resetForm").validationEngine();		

		});
	</script>
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header">
				<a href="../index.php" class="big-logo">
					<img src="../../assets/img/Logo.png" alt="logo img" class="logo-img">
				</a>
				<a href="../index.php" class="logo">
					Turnout
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="la la-bars"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue">
				<div class="container-fluid">
					<div class="navbar-minimize">
						<button class="btn btn-minimize btn-rounded">
							<i class="la la-navicon"></i>
						</button>
					</div>
					<!-- <div class="collapse" id="search-nav">
						<form class="navbar-left navbar-form nav-search ml-md-3 mr-md-3">
							<div class="input-group">
								<input type="text" placeholder="Search ..." class="form-control">
								<div class="input-group-append">
									<button type="submit" class="btn btn-search">
										<i class="la la-search search-icon"></i>
									</button>
								</div>
							</div>
						</form>
					</div> -->
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item toggle-nav-search hidden-caret">
							<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
								<i class="flaticon-search-1"></i>
							</a>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="flaticon-envelope-1"></i>
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="#">Coming Soon...</a>
							</div>
						</li>
						<!-- notification -->
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="flaticon-alarm"></i>
								<span class="notification">1</span>
							</a>
							<ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
								<li>
									<div class="dropdown-title">Coming Soon...</div>
								</li>
							<!-- 	<li>
									<div class="notif-center">
										<a href="#">
											<div class="notif-icon notif-primary"> <i class="la la-user-plus"></i> </div>
											<div class="notif-content">
												<span class="block">
													New user registered
												</span>
												<span class="time">5 minutes ago</span> 
											</div>
										</a>
										<a href="#">
											<div class="notif-icon notif-success"> <i class="la la-comment"></i> </div>
											<div class="notif-content">
												<span class="block">
													Rahmad commented on Admin
												</span>
												<span class="time">12 minutes ago</span> 
											</div>
										</a>
									</div>
								</li>
								<li>
									<a class="see-all" href="javascript:void(0);">See all notifications<i class="la la-angle-right"></i> </a>
								</li> -->
							</ul>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"><img src="data:image/jpeg;base64,<?php echo base64_encode($profile); ?>" width="36" class="img-circle"></a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<li>
									<div class="user-box">
										<div class="u-img"><img src="data:image/jpeg;base64,<?php echo base64_encode($profile); ?>"></div>
										<div class="u-text">
											<h4><?php echo $firstName." ".$lastName; ?></h4>
											<p class="text-muted"><?php echo $email; ?></p>
											<a href="profile.php" class="btn btn-rounded btn-danger btn-sm">View Profile</a>
										</div>
									</div>
								</li>
								<li>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="profile.php">My Profile</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="#">Change Password</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="../../welcome_pages/logout.php">Logout</a>
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
					<div class="user">
						<div class="photo">
							<img src="data:image/jpeg;base64,<?php echo base64_encode($profile); ?>">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									<?php echo $firstName." ".$lastName; ?>
									<span class="user-level">Administrator</span>
								</span>
							</a>
						</div>
					</div>
					<ul class="nav">
						<li class="nav-item">
							<a href="../">
								<i class="flaticon-home"></i>
								<p>Dashboard</p>
								
							</a>
						</li>
						<li class="nav-item">
							<a href="../attendance/manage_attendance_view.php">
								<i class="flaticon-home"></i>
								<p>Manage Attendance</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../justification/justification.php">
								<i class="flaticon-pen"></i>
								<p>Justification</p>
							</a>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#Academics">
								<i class="flaticon-layers-1"></i>
								<p>Academics</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="Academics">
								<ul class="nav nav-collapse">
									<!-- departmrnt add and view -->
									<li>
										<a href="../departmrnt/departmrnt.php">
											<span class="sub-item">Departments</span>
										</a>
									</li>
									<!-- Student Academic Year add and view -->
									<li>
										<a data-toggle="collapse" href="#acaYearNav">
											<span class="sub-item">Student Academic Year</span>
											<span class="caret"></span>
										</a>
										<div class="collapse" id="acaYearNav">
											<ul class="nav nav-collapse subnav">
												<li>
													<a href="../academics/student_aca/student_aca_view.php">
														<span class="sub-item">View</span>
													</a>
												</li>
												<li>
													<a href="../academics/student_aca/student_aca_assign.php">
														<span class="sub-item">Assign Roll No</span>
													</a>
												</li>
												<li>
													<a href="../academics/student_aca/promote_view.php">
														<span class="sub-item">Promote Student</span>
													</a>
												</li>
											</ul>
										</div>
									</li>
									<li>
										<a data-toggle="collapse" href="#batchNav">
											<span class="sub-item">Batches</span>
											<span class="caret"></span>
										</a>
										<div class="collapse" id="batchNav">
											<ul class="nav nav-collapse subnav">
												<li>
													<a href="../academics/batches/batches_view.php">
														<span class="sub-item">View Batches</span>
													</a>
												</li>
												<li>
													<a href="../academics/batches/create_batch_view.php">
														<span class="sub-item">Create Batch</span>
													</a>
												</li>
											</ul>
										</div>
									</li>
									<!-- course add and view -->
									<li>
										<a data-toggle="collapse" href="#coursenav">
											<span class="sub-item">Course And Section</span>
											<span class="caret"></span>
										</a>
										<div class="collapse" id="coursenav">
											<ul class="nav nav-collapse subnav">
												<li>
													<a href="../academics/course/course_view.php">
														<span class="sub-item">View Courses</span>
													</a>
												</li>
												<li>
													<a href="../academics/course/classDivision_view.php">
														<span class="sub-item">Class And Division</span>
													</a>
												</li>
											</ul>
										</div>
									</li>
									<!-- subjects add view allocate -->
									<li>
										<a data-toggle="collapse" href="#subjectnav">
											<span class="sub-item">Subjects</span>
											<span class="caret"></span>
										</a>
										<div class="collapse" id="subjectnav">
											<ul class="nav nav-collapse subnav">
												<li>
													<a href="../academics/subject/subject_view.php">
														<span class="sub-item">View</span>
													</a>
												</li>
												<li>
													<a href="../academics/subject/assign_teacher/assignTeacher_view.php">
														<span class="sub-item">Assign To Teacher</span>
													</a>
												</li>
												<li>
													<a href="../academics/subject/assign_class/assignClass_view.php">
														<span class="sub-item">Assign To Class</span>
													</a>
												</li>
											</ul>
										</div>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#reportnav">
								<i class="flaticon-agenda-1"></i>
								<p>Report</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="reportnav">
								<ul class="nav nav-collapse">
									<li>
										<a href="../reports/report_view.php">
											<span class="sub-item">Monthly</span>
										</a>
									</li>
									<li>
										<a href="../reports/reportSem_view.php">
											<span class="sub-item">Semester</span>
										</a>
									</li>
									<li>
										<a href="../reports/reportSubject_view.php">
											<span class="sub-item">Subject</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="la la-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Manage Staff and Users</h4>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#studentnav">
								<i class="flaticon-agenda-1"></i>
								<p>Students</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="studentnav">
								<ul class="nav nav-collapse">
									<li>
										<a href="../student/students_view.php">
											<span class="sub-item">View</span>
										</a>
									</li>
								</div>
							</li>

							<li class="nav-item">
								<a data-toggle="collapse" href="#teachernav">
									<i class="flaticon-agenda-1"></i>
									<p>Teachers</p>
									<span class="caret"></span>
								</a>
								<div class="collapse" id="teachernav">
									<ul class="nav nav-collapse">
										<li>
											<a href="../teacher/teacher_view.php">
												<span class="sub-item">View</span>
											</a>
										</li>
										<li>
											<a href="../teacher/registred-teacher_view.php">
												<span class="sub-item">Activate Teacher</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- End Sidebar -->

			<div class="main-panel">
				<div class="content">
					<div class="container-fluid">
						<h4 class="page-title">User Profile</h4>
						<div class="row">

							<div class="col-md-10 ml-auto mr-auto">
								<div class="card card-with-nav">

									<div class="card card-profile card-secondary">
										<div class="card-header" style="background-image: url('../../assets/img/blogpost.jpg')">
											<div class="profile-picture">
												<img src="data:image/jpeg;base64,<?php echo base64_encode($profile); ?>">
											</div>
										</div><br><br>
										<div class="card-body">
											<div class="user-profile text-center">
												<div class="name"><?php echo $firstName." ".$lastName; ?></div>
												<div class="job">Administration</div>
											</div>
										</div>
									</div>
									<div class="card-header ml-md-auto">
										<div class="row">
											<ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
												<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-selected="false"><b>Profile</a></b></li>
												<li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#reset" role="tab" aria-selected="false"><b>Change Password</b></a> </li>
											</ul>
										</div>
									</div>
									<div class="tab-content">
										<div class="card-body tab-pane" id="profile"">
										<form action="update_profile.php" method="POST" id="profile_form" enctype="multipart/form-data" onsubmit="return jQuery(this).validationEngine('validate');">
											<div class="row mt-3">
												<div class="col-md-6">
													<center><span class="text-danger" id="error_span"></span></center>
													<input type="hidden" value="<?php echo $_SESSION['userid'] ?>" name="userid1" id="userid1">
													<center><span class="text-danger" id="firstName_error"></span></center>
													<div class="form-group form-group-default">
														<label>First Name</label>
														<input type="text" class="form-control validate[required,custom[onlyLetterSp]]" name="fname" id="fname" placeholder="First Name" value="<?php echo $firstName; ?>">
													</div>
												</div>
												<div class="col-md-6">
													<center><span class="text-danger" id="lastName_error"></span></center>
													<div class="form-group form-group-default">
														<label>Last Name</label>
														<input type="text" class="form-control validate[required,custom[onlyLetterSp]]" name="lname" id="lname" placeholder="Last Name" value="<?php echo $lastName; ?>">
													</div><br>
												</div>
												<div class="col-md-6">
													<center><span class="text-danger" id="error_email"></span></center>
													<div class="form-group form-group-default">
														<label>Email</label>
														<input type="email" class="form-control validate[required,custom[email]]" id="email" name="email" placeholder="Email Address" value="<?php echo $email; ?>">
													</div>
												</div>
												<div class="col-md-6">
													<center><span class="text-danger" id="contact_error"></span></center>
													<div class="form-group form-group-default">
														<label>Contact No</label>
														<input type="text" class="form-control validate[required,custom[contactIndian]]" id="contact" name="contact" placeholder="Contact No" value="<?php echo $contact; ?>" maxlength="10">
													</div><br><br>
												</div>
												<div class="col-md-6">
													<center><span class="text-danger" id="image_error"></span></center>
													<div class="input-file input-file-image">
														<img class="img-upload-preview img-circle" width="100" height="100" src="http://placehold.it/100x100" alt="preview">
														<input type="file" class="form-control form-control-file validate[required]" id="uploadImg" name="uploadImg" accept="image/*" required="">
														<label for="uploadImg" class=" label-input-file btn btn-primary">Upload a Image</label>
													</div>
												</div>
											</div>
											<div class="text-right mt-3 mb-3">
												<button class="btn btn-lg btn-success" id="updatebtn"> &nbsp;Save &nbsp; </button> &nbsp; &nbsp;
											</div>
										</form>
									</div>
										<div class="card-body tab-pane active" id="reset"">
											<form action="changePassword_submit" method="POST" id="resetForm" onsubmit="return jQuery(this).validationEngine('validate');">
											<input type="hidden" name="userid" id="userid" value="<?php echo $_SESSION['userid']; ?>" class="form-control collapse">
											<center><span class="text-danger" id="old_error"></span></center>
											<center><span class="text-danger" id="error_span"></span></center>
											<div class="row mt-3">
												<div class="col-md-6 ml-auto mr-auto">
													<div class="form-group form-group-default">
														<label>Old password</label>
														<input type="password" class="form-control validate[required]" name="oldPassword" id="oldPassword" placeholder="Enter Your old password">
													</div>
												</div>
											</div>
											<center><span class="text-danger" id="new_error"></span></center>
											<div class="row mt-3">
												<div class="col-md-6 ml-auto mr-auto">
													<div class="form-group form-group-default">
														<label>New password</label>
														<input type="password" class="form-control validate[required,custom[password]]" name="newPassword" id="newPassword" placeholder="Enter new password">
													</div>
												</div>
											</div>
											<center><span class="text-danger" id="confirm_error"></span></center>
											<div class="row mt-3">
												<div class="col-md-6 ml-auto mr-auto">
													<div class="form-group form-group-default">
														<label>Confirm password</label>
														<input type="password" class="form-control validate[required,equals[newPassword]]" name="confirmPassword" id="confirmPassword" placeholder="Confirm New Password">
													</div>
												</div>
											</div>
											<div class="text-right mt-3 mb-3 ml-auto mr-auto">
												<button class="btn btn-lg btn-success" id="resetbtn" ><center>Save</center></button>
											</div>
										</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>	


				<footer class="footer">
					<div class="container-fluid">
						<nav class="pull-left">
							<ul class="nav">
								<li class="nav-item">
									<a class="nav-link" href="../../footer/contact.php">
										<i class="flaticon-envelope-1"></i>
										Contact Us
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="../../footer/about.php">
										<i class="flaticon-round"></i>
										About
									</a>
								</li>
							</ul>
						</nav>
						<div class="copyright ml-auto">
							All Right Reserved <a href="../../footer/about.php" class="text-info">Turnout</a> @2018
						</div>				
					</div>
				</footer>
			</div>


		</div>

		<!-- jQuery UI -->
		<script src="../../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
		<script src="../../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

		<!-- jQuery Scrollbar -->
		<script src="../../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

		<!-- Moment JS -->
		<script src="../../assets/js/plugin/moment/moment.min.js"></script>

		<!-- Chart JS -->
		<script src="../../assets/js/plugin/chart.js/chart.min.js"></script>

		<!-- Chart Circle -->
		<script src="../../assets/js/plugin/chart-circle/circles.min.js"></script>

		<!-- Datatables -->
		<script src="../../assets/js/plugin/datatables/datatables.min.js"></script>

		<!-- Bootstrap Notify -->
		<!-- <script src="../../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script> -->

		<!-- Bootstrap Toggle -->
		<script src="../../assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>

		<!-- jQuery Vector Maps -->
		<script src="../../assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
		<script src="../../assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

		<!-- Google Maps Plugin -->
		<script src="../../assets/js/plugin/gmaps/gmaps.js"></script>

		<!-- Dropzone -->
		<script src="../../assets/js/plugin/dropzone/dropzone.min.js"></script>

		<!-- Fullcalendar -->
		<script src="../../assets/js/plugin/fullcalendar/fullcalendar.min.js"></script>

		<!-- DateTimePicker -->
		<script src="../../assets/js/plugin/datepicker/bootstrap-datetimepicker.min.js"></script>

		<!-- Bootstrap Tagsinput -->
		<script src="../../assets/js/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>

		<!-- Bootstrap Wizard -->
		<script src="../../assets/js/plugin/bootstrap-wizard/bootstrapwizard.js"></script>

		<!-- jQuery Validation -->
		<script src="../../assets/js/plugin/jquery.validate/jquery.validate.min.js"></script>

		<!-- Summernote -->
		<script src="../../assets/js/plugin/summernote/summernote-bs4.min.js"></script>

		<!-- Select2 -->
		<script src="../../assets/js/plugin/select2/select2.full.min.js"></script>

		<!-- Sweet Alert -->
		<script src="../../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

		<!-- Ready Pro JS -->
		<script src="../../assets/js/ready.min.js"></script>
		<script src="../../assets/js/setting-demo.js"></script>
		<script src="../../assets/js/demo.js"></script>

	<script src="../../assets/js/functions.js"></script>
	<script src="../../assets/js/profile.js"></script>
	<script src="../../assets/js/reset.js"></script>
	</body>
</html>