<?php
	// Start session
	session_start();
	
	// Unset the variables stored in session
	unset($_SESSION['SESS_ADMIN_ID']);
	unset($_SESSION['SESS_ADMIN_NAME']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Logged Out</title>
	<!-- Bootstrap CDN for styling -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container mt-5">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header bg-danger text-white text-center">
						<h2>Logout</h2>
					</div>
					<div class="card-body text-center">
						<h4 class="text-danger">You have been logged out.</h4>
						<p><a href="login-form.php" class="btn btn-primary">Click Here to Login</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<footer class="text-center mt-4">
		<div class="bottom_addr">&copy; <?php echo date('Y'); ?> Krispy Takeaway Restaurant. All Rights Reserved</div>
	</footer>
</body>
</html>
