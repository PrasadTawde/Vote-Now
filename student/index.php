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
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Home</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

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
									<img src="data:image/jpeg;base64,<?php echo base64_encode($profile); ?>" alt="profile" class="avatar-img rounded-circle">
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
									<a class="dropdown-item" href="../login/logout.php">Logout</a>
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
							<a href="">
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
						<li class="nav-item">
							<a href="polls.php">
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
					<div class="page-header">
						<h4 class="page-title">Home</h4>
					</div>
					<div class="row">
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-primary bubble-shadow-small">
												<i class="fas fa-school"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<p class="card-category">Departments</p>
												<h4 class="card-title">
													<?php 
														$query = "SELECT * FROM DEPARTMENTS"; 
														$result = $dbh->prepare($query); 
														$result->execute(); 
														$number_of_rows = $result->rowCount(); 
														echo  $number_of_rows;
														$result = null;
													 ?>
												</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-info bubble-shadow-small">
												<i class="far fas fa-user-graduate"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<p class="card-category">Programs</p>
												<h4 class="card-title">
													<?php 
														$query = "SELECT * FROM COURSES"; 
														$result = $dbh->prepare($query); 
														$result->execute(); 
														$number_of_rows = $result->rowCount(); 
														echo  $number_of_rows;
														$result = null;
													 ?>
												</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-secondary bubble-shadow-small">
												<i class="fas fa-user-friends"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<p class="card-category">Students</p>
												<h4 class="card-title">
													<?php 
														$query = "SELECT * FROM STUDENTS"; 
														$result = $dbh->prepare($query); 
														$result->execute(); 
														$number_of_rows = $result->rowCount(); 
														echo  $number_of_rows;
														$result = null;
													 ?>
												</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-success bubble-shadow-small">
												<i class="far fas fa-clock"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<p class="card-category">Active Elections</p>
												<h4 class="card-title">
													<?php 
														$query = "SELECT * FROM ELECTIONS WHERE ELECTION_DATE = :election_date"; 
														$result = $dbh->prepare($query);
														$result->execute(array(':election_date' => $current_date)); 
														$result->execute(); 
														$number_of_rows = $result->rowCount(); 
														echo  $number_of_rows;
														$result = null;
													 ?>
												</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- charts -->
					<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								<div class="card-title">Course Chart</div>
							</div>
							<div class="card-body">
								<div class="chart-container">
									<canvas id="courseChart" style="width: 50%; height: 50%"></canvas>
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
<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>

<!-- jQuery UI -->
<script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

<script src="../assets/js/plugin/chart.js/chart.min.js"></script>
<!-- Bootstrap Wizard -->
<script src="../assets/js/plugin/bootstrap-wizard/bootstrapwizard.js"></script>


<!-- Azzara JS -->
<script src="../assets/js/ready.min.js"></script>
<script src="../charts/courses.js"></script>
</body>
</html>