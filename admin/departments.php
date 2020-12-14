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
	<title>Departments</title>
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
						<li class="nav-item active">
							<a data-toggle="collapse" href="#dept">
								<i class="fas fas fa-school"></i>
								<p>Departments & Programs</p>
								<span class="caret"></span>
							</a>
							<div class="collapse show" id="dept">
								<ul class="nav nav-collapse">
									<li class="active">
										<a href="">
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
					<div class="page-header">
						<h4 class="page-title">Departments & Program</h4>
					</div>
					<div class="col-md-12 ml-auto mr-auto">
						<div class="card">
							<div class="card-header">
								<div class="d-flex align-items-center">
									<h4 class="card-title">Departments</h4>
									<button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addDeptModal">
										<i class="fa fa-plus"></i>
										Add New Department
									</button>
								</div>
							</div>
							<div class="card-body">
								<!-- Modal -->
								<div class="modal fade" id="addDeptModal" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header no-bd">
												<h5 class="modal-title">
													<span class="fw-mediumbold">
														New	Department
													</span>
												</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<form action="" method="POST" id="deptForm">
												<div class="modal-body">
													<div class="row">
														<div class="col-sm-12">
															<div class="form-group form-group-default">
																<label>Name</label>
																<input id="deptName" name="deptName" type="text" class="form-control" placeholder="Enter department name">
																<span class="text-danger" id="namedpt_error"></span>
															</div>
														</div>
													</div>
												</div>
												<div class="modal-footer no-bd">
													<input class="submit btn btn-primary" id="addDeptButton" type="submit" value="Add"/>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
												</div>
											</form>
										</div>
									</div>
								</div>

								<!-- Update Modal -->
								<div class="modal fade" id="updateDeptModal" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header no-bd">
												<h5 class="modal-title">
													<span class="fw-mediumbold">
														Update Department
													</span>
												</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<form action="" method="POST" id="updateDeptForm">
												<div class="modal-body" id="update_details">
													<!-- <div class="row">
														<div class="col-sm-12">
															<div class="form-group form-group-default">
																<label>Name</label>
																<input id="deptName" name="deptName" type="text" class="form-control" placeholder="Enter department name">
																<span class="text-danger" id="namedpt_error"></span>
															</div>
														</div>
													</div> -->
												</div>
												<div class="modal-footer no-bd">
													<input class="submit btn btn-primary" id="updateDeptButton" type="submit" value="Update"/>
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
												<th>Department Name</th>
												<th style="width: 10%">Action</th>
											</tr>
										</thead>
										<!-- <tfoot>
											<tr>
												<th>Name</th>
												<th>Position</th>
												<th>Office</th>
												<th>Action</th>
											</tr>
										</tfoot> -->
										<tbody>
											<?php
												$result = $dbh->prepare( "SELECT * FROM DEPARTMENTS" );
												$result->setFetchMode(PDO::FETCH_ASSOC);
												$result->execute();
												$srno = 0;
												while ($result2=$result->fetch()) {

													$srno++;
													$id = $result2['DEPARTMENT_ID'];
													$name = $result2['DEPARTMENT_NAME'];
											?>
											<tr>
												<td><?php echo $srno; ?></td>
												<td><?php echo $name; ?></td>
												<td>
													<div class="form-button-action">
														<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg edit_data" data-original-title="Edit" id="<?php echo $id;?>">
															<i class="fa fa-edit"></i>
														</button>
														<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Delete" id="<?php echo $id;?>">
															<i class="fa fa-times"></i>
														</button>
													</div>
												</td>
											</tr>
										<?php } ?>
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

<!-- Select2 -->
<script src="../assets/js/plugin/select2/select2.full.min.js"></script>

<!-- Sweet Alert -->
<script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

<!-- Azzara JS -->
<script src="../assets/js/ready.min.js"></script>

<script src="../assets/js/functions.js"></script>
<script src="../assets/js/add_dept.js"></script>
<script >

	$(document).ready(function() {

		// Add Row
		$('#add-row').DataTable({
			"pageLength": 5,
		});

		var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

		//Add Department
		$(function(){
			$('addDeptButton').click(function(e){
				e.preventDeafult();
					var deptName = $("#deptName").val();
					$.ajax({
						url: 'add_department.php',
						type: 'POST',
						data: {'deptName' : deptName},
						success:function(data){
							swal("Department Added Successfully !",{
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
							$('#addDeptModal').modal('hide');
						}
					});
			});
		})

		//edit department
		$(document).on('click','.edit_data',function(){
			var edit_id = $(this).attr('id');
			$.ajax({
					url: "department/edit_dept.php",
					type: "POST",
					data: {edit_id:edit_id},
					success:function(data){
						$("#update_details").html(data);
						$("#updateDeptModal").modal('show');
					}
				});
		});

		//update department
			$('#updateDeptButton').click(function(e){
				e.preventDefault();
				if($("#updateDeptForm").validationEngine("validate")){
					$.ajax({
							url: "update_department.php",
							type: "POST",
							data: $("#updateDeptForm").serialize(),
							success:function(data){
								swal("Department Updated successfully!",{
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
								$("#updateDeptModal").modal('hide');
							}
						});
					}
			});

	});
</script>
</body>
</html>