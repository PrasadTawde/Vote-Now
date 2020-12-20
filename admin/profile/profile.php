<?php 
include_once("../../config.php");
include_once("../../login/functions.php");
if (!func::checkLoginState($dbh))
	{
		header("location:../../login/login.php");
	}
	
	else if ($_SESSION['userType'] != "admin") {
		header("Location:../../../");	
	}
		$result = $dbh->prepare( "SELECT * FROM USERS WHERE USER_ID = :user_id" );
		$result->bindParam(':user_id', $_SESSION['userid']);

		$result->setFetchMode(PDO::FETCH_ASSOC);
		$result->execute();
		while ($result2=$result->fetch()) {
			$first_name = ucfirst($result2['USER_FIRSTNAME']);
			$last_name = ucfirst($result2['USER_LASTNAME']);
			$email = $result2['USER_EMAIL'];
			$contact = $result2['USER_CONTACT'];
			$profile  = $result2['USER_PROFILE'];
		}
	$result =null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Profile</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<!-- <link rel="icon" href="http://demo.themekita.com/azzara/livepreview/assets/img/icon.ico" type="image/x-icon"/> -->

	<!-- Fonts and icons -->
	<script src="../../assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Open+Sans:300,400,600,700"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['../../assets/css/fonts.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../assets/css/azzara.min.css">
</head>
<body>
	<div class="wrapper">
		<div class="main-header" data-background-color="blue">
			<!-- Logo Header -->
			<div class="logo-header">
				
				<a href="index.php" class="logo">
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
									<img src="data:image/jpeg;base64,<?php echo base64_encode($profile); ?>" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<li>
									<div class="user-box">
										<div class="avatar-lg"><img src="data:image/jpeg;base64,<?php echo base64_encode($profile); ?>" alt="profile" class="avatar-img rounded"></div>
										<div class="u-text">
											<h4><?php echo $first_name." ". $last_name ?></h4>
											<p class="text-muted"><?php echo $email; ?></p>
										</div>
									</div>
								</li>
								<li>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="">My Profile</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="../../login/logout.php">Logout</a>
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
						<li class="nav-item active">
							<a href="../index.php">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../positions.php">
								<i class="fas fas fa-user-tie"></i>
								<p>Manage Positions</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../candidates.php">
								<i class="fas far fa-address-card"></i>
								<p>Manage Candidates</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../elections.php">
								<i class="fas fa-edit"></i>
								<p>Elections</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../polls.php">
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
										<a href="../departments.php">
											<span class="sub-item">Departments</span>
										</a>
									</li>
									<li>
										<a href="../programs.php">
											<span class="sub-item">Programs</span>
										</a>
									</li>
								</ul>
							</div>
							<li class="nav-item">
								<a href="../students.php">
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
											<div class="name"><?php echo $first_name." ".$last_name; ?></div>
											<div class="job">Admin</div>
										</div>
									</div>
								</div>
								<div class="card-header ml-md-auto">
									<div class="row">
										<ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
											<li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#profile" role="tab" aria-selected="false"><b>Profile</a></b></li>
											<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#reset" role="tab" aria-selected="false"><b>Change Password</b></a> </li>
										</ul>
									</div>
								</div>
								<div class="tab-content">
									<div class="card-body tab-pane active" id="profile">
										<form action="update_profile.php" method="POST" id="profile_form" enctype="multipart/form-data">
											<div class="row mt-3">
												<div class="col-md-6">
													<center><span class="text-danger" id="error_span"></span></center>
													<input type="hidden" value="<?php echo $_SESSION['userid'] ?>" name="userid1" id="userid1">
													<center><span class="text-danger" id="firstName_error"></span></center>
													<div class="form-group form-group-default">
														<label>First Name</label>
														<input type="text" class="form-control validate[required,custom[onlyLetterSp]]" name="fname" id="fname" placeholder="First Name" value="<?php echo $first_name; ?>">
													</div>
												</div>
												<div class="col-md-6">
													<center><span class="text-danger" id="lastName_error"></span></center>
													<div class="form-group form-group-default">
														<label>Last Name</label>
														<input type="text" class="form-control validate[required,custom[onlyLetterSp]]" name="lname" id="lname" placeholder="Last Name" value="<?php echo $last_name; ?>">
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
														<input type="file" class="form-control form-control-file validate[required]" accept="image/*" required id="uploadImg" name="uploadImg" required="">
														<label for="uploadImg" class=" label-input-file btn btn-primary">Upload a Image</label>
													</div>
												</div>
											</div>
											<div class="text-right mt-3 mb-3">
												<button class="btn btn-lg btn-success" id="updatebtn"> &nbsp;Save &nbsp; </button> &nbsp; &nbsp;
											</div>
										</form>
									</div>
									<div class="card-body tab-pane" id="reset">
										<form action="reset.php" method="POST" id="resetForm" onsubmit="return jQuery(this).validationEngine('validate');">
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
												<button class="btn btn-lg btn-success" id="resetbtn"><center>Save</center></button>
											</div>
										</form>
									</div>
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
<script src="../../assets/js/core/jquery.3.2.1.min.js"></script>
<script src="../../assets/js/core/popper.min.js"></script>
<script src="../../assets/js/core/bootstrap.min.js"></script>

<!-- jQuery UI -->
<script src="../../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="../../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="../../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


<!-- Datatables -->
<script src="../../assets/js/plugin/datatables/datatables.min.js"></script>

<!-- Bootstrap Tagsinput -->
<script src="../../assets/js/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>

<!-- Bootstrap Wizard -->
<script src="../../assets/js/plugin/bootstrap-wizard/bootstrapwizard.js"></script>

<!-- jQuery Validation -->
<script src="../../assets/js/plugin/jquery.validate/jquery.validate.min.js"></script>


<!-- Select2 -->
<script src="../../assets/js/plugin/select2/select2.full.min.js"></script>

<!-- Sweet Alert -->
<script src="../../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

<!-- Azzara JS -->
<script src="../../assets/js/ready.min.js"></script>

<script src="../../assets/js/functions.js"></script>
<script src="../../assets/js/profile.js"></script>
<script src="../../assets/js/reset.js"></script>

</body>
</html>