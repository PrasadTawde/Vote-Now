<?php 
include_once ("../config.php");
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Login</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<!-- <link rel="icon" href="../assets/img/icon.ico" type="image/x-icon"/> -->

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
<body class="login">
	<div class="wrapper wrapper-login">
		<div class="container container-login animated fadeIn">
			<h3 class="text-center">Sign In</h3>
			<div class="login-form">
				<form action="signin.php" method="POST" id="signinID">
					<div class="form-group">
						<center><span class="text-danger" id="error_span"></span></center>
						<label class="col-lg-4 col-md-3 col-sm-4 mt-sm-2 text-right">User Type :</label>
							<div class="custom-control custom-radio">
								<input type="radio" id="admin" name="user_type" class="custom-control-input" checked="" value="admin">
								<label class="custom-control-label" for="admin">Admin</label>
							</div>
							<div class="custom-control custom-radio">
								<input type="radio" id="student" name="user_type" class="custom-control-input" value="student">
								<label class="custom-control-label" for="student">Student</label>
							</div>
					</div>
					<div class="form-group form-floating-label">
						<center><span class="text-danger" id="error_email"></span></center>
						<input id="useremail" name="useremail" type="text" class="form-control input-border-bottom" required>
						<label for="Email" class="placeholder">Email</label>
					</div>
					<div class="form-group form-floating-label">
						<center><span class="text-danger" id="error_password"></span></center>
						<input id="password" name="password" type="password" class="form-control input-border-bottom" required>
						<label for="password" class="placeholder">Password</label>
						<div class="show-password">
							<i class="flaticon-interface"></i>
						</div>
					</div>
					<div class="row form-sub m-0">
						<a href="forgot.html" class="link " id="show-forgot">Forget Password ?</a>
					</div>
					<div class="form-action mb-3">
						<input id="btSubmitLogin" type="submit" name="submit" class="btn btn-primary btn-rounded btn-login" value="Sign In">
					</div>
					<div class="login-account">
						<span class="msg">Don't have an account yet ?</span>
						<a href="#" id="show-signup" class="link">Sign Up</a>
					</div>
				</form>
			</div>
		</div>

		<div class="container container-signup animated fadeIn">
			<h3 class="text-center">Sign Up</h3>
			<div class="login-form">
				<form action="signup.php" method="POST" id="signupID">
					<div class="form-group form-floating-label">
						<input  id="prNumber" name="prNumber" type="number" class="form-control input-border-bottom" required>
						<label for="prNumber" class="placeholder">PR Number</label>
						<span class="text-danger" id="error_pr"></span>
					</div>
					<div class="form-group form-floating-label">
						<input  id="firstName" name="firstName" type="text" class="form-control input-border-bottom" required>
						<label for="firstName" class="placeholder">First Name</label>
						<span class="text-danger" id="error_fname"></span>
					</div>
					<div class="form-group form-floating-label">
						<input  id="lastName" name="lastName" type="text" class="form-control input-border-bottom" required>
						<label for="lastName" class="placeholder">Last Name</label>
						<span class="text-danger" id="error_lname"></span>
					</div>
					<div class="form-group form-floating-label">
						<select class="form-control input-border-bottom" name="selectDepartment" id="selectDepartment" required>
							<option value="" >&nbsp;</option>
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
						<label for="selectDepartment" class="placeholder">Select Department</label>
						<span class="text-danger" id="error_dept"></span>
					</div>
					<div class="form-group form-floating-label">
						<select class="form-control input-border-bottom" id="selectCourse" name="selectCourse" required>
							<option value="" >&nbsp;</option>
							<option>Select Depaartment first.</option>
						</select>
						<label for="selectCourse" class="placeholder">Select Programme</label>
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
					<div class="form-group form-floating-label">
						<input  id="email" name="email" type="email" class="form-control input-border-bottom" required>
						<label for="email" class="placeholder">Email</label>
						<span class="text-danger" id="error_email"></span>
					</div>
					<div class="form-group form-floating-label">
						<input  id="contact" name="contact" type="number" class="form-control input-border-bottom" required>
						<label for="contact" class="placeholder">Contact</label>
						<span class="text-danger" id="error_contact"></span>
					</div>
					<div class="form-group form-floating-label">
						<input  id="password" name="password" type="password" class="form-control input-border-bottom" required>
						<label for="password" class="placeholder">Password</label>
						<div class="show-password">
							<i class="flaticon-interface"></i>
						</div>
						<span class="text-danger" id="error_password"></span>
					</div>
					<div class="form-group form-floating-label">
						<input  id="confirmpassword" name="confirmpassword" type="password" class="form-control input-border-bottom" required>
						<label for="confirmpassword" class="placeholder">Confirm Password</label>
						<div class="show-password">
							<i class="flaticon-interface"></i>
						</div>
						<span class="text-danger" id="error_passconfirm"></span>
					</div>
					<div class="form-action">
						<a href="#" id="show-signin" class="btn btn-danger btn-rounded btn-login mr-3">Cancel</a>
						<input id="signinBtn" type="submit" name="submit" class="btn btn-primary btn-rounded btn-login" value="Sign Up">
					</div>
				</form>
			</div>
		</div>
	</div>

	<!--   Core JS Files   -->
	<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="../assets/js/core/popper.min.js"></script>
	<script src="../assets/js/core/bootstrap.min.js"></script>
	<script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="../assets/js/plugin/moment/moment.min.js"></script>
	<script src="../assets/js/plugin/datepicker/bootstrap-datetimepicker.min.js"></script>
	<script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>
	<script src="../assets/js/ready.js"></script>
	<script src="../assets/js/functions.js"></script>
	<script src="../assets/js/signin.js"></script>
	<script src="../assets/js/signup.js"></script>
	<script>
		$(document).ready(function() {
			$('#joinYear').datetimepicker({
				format: 'YYYY',
				viewMode: "years",
			});
			$('#leaveYear').datetimepicker({
				format: 'YYYY',
				viewMode: "years",
			});

			//filling course select box
			$('#selectDepartment').change(function(){
				var s2 = document.getElementById ('selectDepartment');
				var selectDept = s2.options [s2.selectedIndex] .value;
				if(selectDept){
					$.ajax({
						type:'POST',
						url: '../admin/student/get_course_select.php',
						data: {selectDept:selectDept},
						success:function (html) {
							$('#selectCourse').html(html);
						}
					});
				}else{
					$('#selectCourse').html('<option value="">Something went wrong!</option>');
				}
			});
		});
	</script>
</body>
</html>