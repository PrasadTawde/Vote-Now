<!DOCTYPE html>
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
						<li class="nav-item active">
							<a href="">
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
							<li class="nav-item">
								<a href="students.php">
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
					<h4 class="page-title">Polls</h4>
					<div class="col-md-12">
						<div class="card">
							<div class="card-body">
								<div class="table-responsive">
									<table id="add-row" class="display table table-striped table-hover" >
										<thead>
											<tr>
												<th>Position Name</th>
												<th>Department Name</th>
												<th>Program Name</th>
												<th style="width: 10%">Action</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>General Secretary</td>
												<td>--</td>
												<td>--</td>
												<td>
													<div class="form-button-action">
														<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="View Results">
															<i class="far fa-check-square"></i>
														</button>
													</div>
												</td>
											</tr>
											<tr>
												<td>Secretary</td>
												<td>--</td>
												<td>--</td>
												<td>
													<div class="form-button-action">
														<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="View Results">
															<i class="far fa-check-square"></i>
														</button>
													</div>
												</td>
											</tr>
											<tr>
												<td>Class Representative</td>
												<td>Goa Bussiness School</td>
												<td>MCA</td>
												<td>
													<div class="form-button-action">
														<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="View Results">
															<i class="far fa-check-square"></i>
														</button>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!-- charts -->
					<div class="row">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Bar Chart</div>
								</div>
								<div class="card-body">
									<div class="chart-container">
										<canvas id="barChart"></canvas>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Pie Chart</div>
								</div>
								<div class="card-body">
									<div class="chart-container">
										<canvas id="pieChart" style="width: 50%; height: 50%"></canvas>
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

<!-- Sweet Alert -->
<script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

<!-- Azzara JS -->
<script src="../assets/js/ready.min.js"></script>
<script>
	$('#add-row').DataTable({
			"pageLength": 5,
		});
	var myBarChart = new Chart(barChart, {
		type: 'bar',
		data: {
			labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
			datasets : [{
				label: "Sales",
				backgroundColor: 'rgb(23, 125, 255)',
				borderColor: 'rgb(23, 125, 255)',
				data: [3, 2, 9, 5, 4, 6, 4, 6, 7, 8, 7, 4],
			}],
		},
		options: {
			responsive: true, 
			maintainAspectRatio: false,
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true
					}
				}]
			},
		}
	});

	var myPieChart = new Chart(pieChart, {
		type: 'pie',
		data: {
			datasets: [{
				data: [50, 35, 15],
				backgroundColor :["#1d7af3","#f3545d","#fdaf4b"],
				borderWidth: 0
			}],
			labels: ['New Visitors', 'Subscribers', 'Active Users'] 
		},
		options : {
			responsive: true, 
			maintainAspectRatio: false,
			legend: {
				position : 'bottom',
				labels : {
					fontColor: 'rgb(154, 154, 154)',
					fontSize: 11,
					usePointStyle : true,
					padding: 20
				}
			},
			pieceLabel: {
				render: 'percentage',
				fontColor: 'white',
				fontSize: 14,
			},
			tooltips: false,
			layout: {
				padding: {
					left: 20,
					right: 20,
					top: 20,
					bottom: 20
				}
			}
		}
	});

</script>
</body>
</html>