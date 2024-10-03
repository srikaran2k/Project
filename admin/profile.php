<?php
	require_once('auth.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Profile</title>
	<!-- Bootstrap CSS -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
	<script language="JavaScript" src="validation/admin.js"></script>
</head>
<body>
	<div class="container mt-5">
		<div class="row">
			<div class="col-md-12">
				<h1 class="text-center">Profile</h1>
				<nav class="nav justify-content-center mb-4">
					<a class="nav-link" href="index.php">Home</a>
					<a class="nav-link" href="categories.php">Categories</a>
					<a class="nav-link" href="foods.php">Foods</a>
					<a class="nav-link" href="accounts.php">Accounts</a>
					<a class="nav-link" href="orders.php">Orders</a>
					<a class="nav-link" href="reservations.php">Reservations</a>
					<a class="nav-link" href="specials.php">Specials</a>
					<a class="nav-link" href="allocation.php">Staff</a>
					<a class="nav-link" href="messages.php">Messages</a>
					<a class="nav-link" href="options.php">Options</a>
					<a class="nav-link" href="logout.php">Logout</a>
				</nav>
			</div>
		</div>

		<div class="row">
			<!-- Change Admin Password Form -->
			<div class="col-md-6">
				<div class="card shadow-lg mb-4">
					<div class="card-header bg-danger text-white text-center">
						<h3>Change Admin Password</h3>
					</div>
					<div class="card-body">
						<form id="updateForm" name="updateForm" method="post" action="update-exec.php?id=<?php echo $_SESSION['SESS_ADMIN_ID'];?>" onsubmit="return updateValidate(this)">
							<div class="form-group">
								<label for="opassword">Current Password <span class="text-danger">*</span></label>
								<input type="password" class="form-control" name="opassword" id="opassword" required>
							</div>
							<div class="form-group">
								<label for="npassword">New Password <span class="text-danger">*</span></label>
								<input type="password" class="form-control" name="npassword" id="npassword" required>
							</div>
							<div class="form-group">
								<label for="cpassword">Confirm New Password <span class="text-danger">*</span></label>
								<input type="password" class="form-control" name="cpassword" id="cpassword" required>
							</div>
							<button type="submit" class="btn btn-primary btn-block">Change</button>
						</form>
					</div>
				</div>
			</div>

			<!-- Add New Staff Form -->
			<div class="col-md-6">
				<div class="card shadow-lg mb-4">
					<div class="card-header bg-primary text-white text-center">
						<h3>Add New Staff</h3>
					</div>
					<div class="card-body">
						<form id="staffForm" name="staffForm" method="post" action="staff-exec.php" onsubmit="return staffValidate(this)">
							<div class="form-group">
								<label for="fName">First Name <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="fName" id="fName" required>
							</div>
							<div class="form-group">
								<label for="lName">Last Name <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="lName" id="lName" required>
							</div>
							<div class="form-group">
								<label for="sAddress">Street Address <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="sAddress" id="sAddress" required>
							</div>
							<div class="form-group">
								<label for="mobile">Mobile/Tel <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="mobile" id="mobile" required>
							</div>
							<button type="submit" class="btn btn-success btn-block">Add</button>
						</form>
					</div>
				</div>
			</div>
		</div>

		<hr>

		<?php include 'footer.php'; ?>
	</div>

	<!-- Bootstrap JS and dependencies -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
