<?php
	// Start session
	session_start();
	
	// Unset the variables stored in session
	unset($_SESSION['SESS_MEMBER_ID']);
	unset($_SESSION['SESS_FIRST_NAME']);
	unset($_SESSION['SESS_LAST_NAME']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Logged Out | Food Plaza</title>
	<!-- Bootstrap CDN for styling -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom styles -->
	<link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="container mt-5">
	<div id="page">
		<div class="text-center mb-4">
			<h1>Food Plaza Restaurant</h1>
		</div>
		
		<!-- Menu navigation -->
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="collapse navbar-collapse justify-content-center">
				<ul class="navbar-nav">
					<li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
					<li class="nav-item"><a class="nav-link" href="foodzone.php">Food Zone</a></li>
					<li class="nav-item"><a class="nav-link" href="specialdeals.php">Special Deals</a></li>
					<li class="nav-item"><a class="nav-link" href="member-index.php">My Account</a></li>
					<li class="nav-item"><a class="nav-link" href="contactus.php">Contact Us</a></li>
				</ul>
			</div>
		</nav>
		
		<!-- Center content -->
		<div class="card mx-auto mt-4" style="max-width: 600px;">
			<div class="card-body text-center">
				<h2 class="text-danger">Logged Out</h2>
				<p class="text-muted">You have been successfully logged out.</p>
				<a href="login-register.php" class="btn btn-primary">Click Here to Login again</a>
			</div>
		</div>

		<!-- Footer -->
		<div id="footer" class="text-center mt-5">
			<div class="bottom_menu">
				<a href="index.php">Home Page</a> | 
				<a href="aboutus.php">About Us</a> | 
				<a href="specialdeals.php">Special Deals</a> | 
				<a href="foodzone.php">Food Zone</a> | 
				<a href="#">Affiliate Program</a> | 
				<a href="admin/index.php" target="_blank">Administrator</a>
			</div>
			<div class="bottom_addr mt-3">&copy; <?php echo date('Y'); ?> Food Plaza. All Rights Reserved</div>
		</div>
	</div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
