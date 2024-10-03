<?php
	require_once('auth.php');
?>
<?php
//checking connection and connecting to a database
require_once('connection/config.php');

//Connect to MySQL server
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
if (!$conn) {
	die('Failed to connect to server: ' . mysqli_error());
}

//Retrieve staff records
$staff = mysqli_query($conn, "SELECT * FROM staff") or die("There are no records to display ... \n" . mysqli_error());

//Retrieve order ids with flag = 0
$orders = mysqli_query($conn, "SELECT * FROM orders_details WHERE flag='0'") or die("There are no records to display ... \n" . mysqli_error());

//Retrieve reservation ids with flag = 0
$reservations = mysqli_query($conn, "SELECT * FROM reservations_details WHERE flag='0'") or die("There are no records to display ... \n" . mysqli_error());

//Retrieve staff for allocation forms
$staff_1 = mysqli_query($conn, "SELECT * FROM staff") or die("There are no records to display ... \n" . mysqli_error());
$staff_2 = mysqli_query($conn, "SELECT * FROM staff") or die("There are no records to display ... \n" . mysqli_error());
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Staff Allocation</title>
	<!-- Bootstrap CSS -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom Stylesheet -->
	<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container mt-5">
	<!-- Header Navigation -->
	<div class="row">
		<div class="col-md-12 text-center">
			<h1>Staff Allocation</h1>
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

	<!-- Staff List -->
	<div class="row">
		<div class="col-md-12">
			<div class="card shadow-lg mb-4">
				<div class="card-header bg-primary text-white">
					<h3>Staff List</h3>
				</div>
				<div class="card-body">
					<table class="table table-bordered table-striped text-center">
						<thead class="thead-dark">
							<tr>
								<th>Staff ID</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Street Address</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							while ($row = mysqli_fetch_array($staff)) {
								echo "<tr>";
								echo "<td>{$row['StaffID']}</td>";
								echo "<td>{$row['firstname']}</td>";
								echo "<td>{$row['lastname']}</td>";
								echo "<td>{$row['Street_Address']}</td>";
								echo '<td><a href="delete-staff.php?id=' . $row['StaffID'] . '" class="btn btn-danger btn-sm">Remove Staff</a></td>';
								echo "</tr>";
							}
							mysqli_free_result($staff);
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<!-- Orders Allocation Form -->
	<div class="row">
		<div class="col-md-6">
			<div class="card shadow-lg mb-4">
				<div class="card-header bg-info text-white">
					<h3>Orders Allocation</h3>
				</div>
				<div class="card-body">
					<form id="ordersAllocationForm" name="ordersAllocationForm" method="post" action="orders-allocation.php" onsubmit="return ordersAllocationValidate(this)">
						<div class="form-group">
							<label for="orderid">Order ID</label>
							<select name="orderid" id="orderid" class="form-control" required>
								<option value="select">- select one option -</option>
								<?php 
								while ($row = mysqli_fetch_array($orders)) {
									echo "<option value='{$row['order_id']}'>{$row['order_id']}</option>"; 
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="staffid">Staff ID</label>
							<select name="staffid" id="staffid" class="form-control" required>
								<option value="select">- select one option -</option>
								<?php 
								while ($row = mysqli_fetch_array($staff_1)) {
									echo "<option value='{$row['StaffID']}'>{$row['StaffID']}</option>"; 
								}
								?>
							</select>
						</div>
						<button type="submit" name="Submit" class="btn btn-success btn-block">Allocate Staff</button>
					</form>
				</div>
			</div>
		</div>

		<!-- Reservations Allocation Form -->
		<div class="col-md-6">
			<div class="card shadow-lg mb-4">
				<div class="card-header bg-info text-white">
					<h3>Reservations Allocation</h3>
				</div>
				<div class="card-body">
					<form id="reservationsAllocationForm" name="reservationsAllocationForm" method="post" action="reservations-allocation.php" onsubmit="return reservationsAllocationValidate(this)">
						<div class="form-group">
							<label for="reservationid">Reservation ID</label>
							<select name="reservationid" id="reservationid" class="form-control" required>
								<option value="select">- select one option -</option>
								<?php 
								while ($row = mysqli_fetch_array($reservations)) {
									echo "<option value='{$row['ReservationID']}'>{$row['ReservationID']}</option>"; 
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="staffid">Staff ID</label>
							<select name="staffid" id="staffid" class="form-control" required>
								<option value="select">- select one option -</option>
								<?php 
								while ($row = mysqli_fetch_array($staff_2)) {
									echo "<option value='{$row['StaffID']}'>{$row['StaffID']}</option>"; 
								}
								?>
							</select>
						</div>
						<button type="submit" name="Submit" class="btn btn-success btn-block">Allocate Staff</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php include 'footer.php'; ?>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
