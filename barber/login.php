<?php
	session_start();

	// IF THE USER HAS ALREADY LOGGED IN
	if(isset($_SESSION['username_barber']) && isset($_SESSION['password_barber']))
	{
		header('Location: index.php');
		exit();
	}
	// ELSE
	$pageTitle = 'Barber Login';
	include 'connect.php';
	// include 'Includes/functions/functions.php';
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Barber Login</title>
		<!-- FONTS FILE -->
		<link href="Design/fonts/css/all.min.css" rel="stylesheet" type="text/css">

		<!-- Nunito FONT FAMILY FILE -->
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

		<!-- CSS FILES -->
		<link href="Design/css/sb-admin-2.min.css" rel="stylesheet">
		<link href="Design/css/main.css" rel="stylesheet">
	</head>
	<body>
		<div class="login">
			<form class="login-container validate-form" name="login-form" method="POST" action="login.php" >
			<img src="Design/image/logo-company.jpg" alt="company-logo" style="height: 120px" class="mx-auto d-block">
				<span class="login100-form-title p-b-32 text-center p-4">
					Barber Login
				</span>

				<!-- PHP SCRIPT WHEN SUBMIT -->

				<?php

					if( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signin']))
					{
						$username = ($_POST['username']);
						$password = ($_POST['password']);
						// $name = ($_POST['name']);

						// $hashedPass = md5($password);

						$sql = "SELECT * FROM barbers WHERE barber_un='$username' AND barber_password='$password' ";
						$query=mysqli_query($conn,$sql);
						$num=mysqli_fetch_array($query);

						if($num>0)
						{
						// $_POST['password']=$_POST['username'];
						// $_SESSION['name_barber'] = $name;
						$_SESSION['username_barber'] = $username;
						$_SESSION['password_barber'] = $password;
						$_SESSION['barber_id'] = $sql['barber_id'];
						header("location:index.php");
						echo "haii ";
						exit();
						}
						else
						{
							?>

							<div class="alert alert-danger">
								<button data-dismiss="alert" class="close close-sm" type="button">
									<span aria-hidden="true">×</span>
								</button>
								<div class="messages">
									<div>Username and/or password are incorrect! Please Contact Admin</div>
								</div>
							</div>

							<?php
						}
					}

				?>

				<!-- USERNAME INPUT -->

				<div class="form-input">
					<span class="txt1">Username</span>
					<input type="text" name="username" class = "form-control"  autocomplete="off">
					<span class="invalid-feedback" id="required_username">Username is required!</span>
				</div>
				
				<!-- PASSWORD INPUT -->

				<div class="form-input">
					<span class="txt1">Password</span>
					<input type="password" name="password" class="form-control" autocomplete="new-password">
					<span class="invalid-feedback" id="required_password">Password is required!</span>
				</div>
				
				<!-- SIGN IN BUTTON -->

				<p>
					<button type="submit" name="signin" >Sign In</button>
				</p>

				<!-- FORGOT YOUR PASSWORD LINK -->

				<span class="forgotPW">Forgot your password ? <a href="#">Reset it here.</a></span>
			</form>
		</div>
		
		<!-- Footer -->
		<footer class="sticky-footer bg-white">
			<div class="container my-auto">
		  		<div class="copyright text-center my-auto">
					<span>Copyright &copy; Barbershop Website by Twin & Dad Barbershop</span>
		  		</div>
			</div>
	  	</footer>
		<!-- End of Footer -->

		<!-- INCLUDE JS SCRIPTS -->
		<script src="Design/js/jquery.min.js"></script>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<script src="Design/js/bootstrap.bundle.min.js"></script>
		<script src="Design/js/sb-admin-2.min.js"></script>
		<script src="Design/js/main.js"></script>
	</body>
</html>