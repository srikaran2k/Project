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

//selecting all records from the reservations_details table for tables
$tables = mysqli_query($conn, "SELECT members.firstname, members.lastname, reservations_details.ReservationID, reservations_details.table_id, reservations_details.Reserve_Date, reservations_details.Reserve_Time, tables.table_id, tables.table_name 
	FROM members, reservations_details, tables 
	WHERE members.member_id = reservations_details.member_id 
	AND tables.table_id = reservations_details.table_id")
or die("There are no records to display ... \n" . mysqli_error());

//selecting all records from the reservations_details table for party halls
$partyhalls = mysqli_query($conn, "SELECT members.firstname, members.lastname, reservations_details.ReservationID, reservations_details.partyhall_id, reservations_details.Reserve_Date, reservations_details.Reserve_Time, partyhalls.partyhall_id, partyhalls.partyhall_name 
	FROM members, reservations_details, partyhalls 
	WHERE members.member_id = reservations_details.member_id 
	AND partyhalls.partyhall_id = reservations_details.partyhall_id")
or die("There are no records to display ... \n" . mysqli_error());
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Reservations</title>
	<!-- Bootstrap CSS -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom Stylesheet -->
	<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="container mt-5">
	<div class="row">
		<div class="col-md-12 text-center">
			<h1>Reservations Management</h1>
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

	<!-- Tables Reserved -->
	<div class="row">
		<div class="col-md-12">
			<div class="card shadow-lg mb-4">
				<div class="card-header bg-info text-white text-center">
					<h3>Tables Reserved</h3>
				</div>
				<div class="card-body">
					<table class="table table-bordered table-striped text-center">
						<thead class="thead-dark">
							<tr>
								<th>Reservation ID</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Table Name</th>
								<th>Reserved Date</th>
								<th>Reserved Time</th>
								<th>Action(s)</th>
							</tr>
						</thead>
						<tbody>
							<?php
							//loop through all table rows
							while ($row = mysqli_fetch_array($tables)) {
								echo "<tr>";
								echo "<td>{$row['ReservationID']}</td>";
								echo "<td>{$row['firstname']}</td>";
								echo "<td>{$row['lastname']}</td>";
								echo "<td>{$row['table_name']}</td>";
								echo "<td>{$row['Reserve_Date']}</td>";
								echo "<td>{$row['Reserve_Time']}</td>";
								echo '<td><a href="delete-reservation.php?id=' . $row['ReservationID'] . '" class="btn btn-danger btn-sm">Delete</a></td>';
								echo "</tr>";
							}
							mysqli_free_result($tables);
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<!-- Party Halls Reserved -->
	<div class="row">
		<div class="col-md-12">
			<div class="card shadow-lg mb-4">
				<div class="card-header bg-success text-white text-center">
					<h3>Party Halls Reserved</h3>
				</div>
				<div class="card-body">
					<table class="table table-bordered table-striped text-center">
						<thead class="thead-dark">
							<tr>
								<th>Reservation ID</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Party Hall Name</th>
								<th>Reserved Date</th>
								<th>Reserved Time</th>
								<th>Action(s)</th>
							</tr>
						</thead>
						<tbody>
							<?php
							//loop through all table rows
							while ($row = mysqli_fetch_array($partyhalls)) {
								echo "<tr>";
								echo "<td>{$row['ReservationID']}</td>";
								echo "<td>{$row['firstname']}</td>";
								echo "<td>{$row['lastname']}</td>";
								echo "<td>{$row['partyhall_name']}</td>";
								echo "<td>{$row['Reserve_Date']}</td>";
								echo "<td>{$row['Reserve_Time']}</td>";
								echo '<td><a href="delete-reservation.php?id=' . $row['ReservationID'] . '" class="btn btn-danger btn-sm">Delete</a></td>';
								echo "</tr>";
							}
							mysqli_free_result($partyhalls);
							mysqli_close($conn);
							?>
						</tbody>
					</table>
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
