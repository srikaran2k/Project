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

//Retrieve promotions from the specials table
$result = mysqli_query($conn, "SELECT * FROM specials") or die("There are no records to display ... \n" . mysqli_error());

//Retrieve currency (active)
$flag_1 = 1;
$currencies = mysqli_query($conn, "SELECT * FROM currencies WHERE flag='$flag_1'") or die("A problem has occurred ... \n Our team is working on it. Please check back after a few hours.");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Specials Management</title>
	<!-- Bootstrap CSS -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container mt-5">
	<!-- Header Navigation -->
	<div class="row">
		<div class="col-md-12 text-center">
			<h1>Specials Management</h1>
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

	<!-- Add Promotion Form -->
	<div class="row">
		<div class="col-md-12">
			<div class="card shadow-lg mb-4">
				<div class="card-header bg-primary text-white">
					<h3>Add a New Promotion</h3>
				</div>
				<div class="card-body">
					<form name="specialsForm" id="specialsForm" action="specials-exec.php" method="post" enctype="multipart/form-data" onsubmit="return specialsValidate(this)">
						<div class="form-row">
							<div class="form-group col-md-3">
								<label for="name">Name</label>
								<input type="text" name="name" id="name" class="form-control" required>
							</div>
							<div class="form-group col-md-3">
								<label for="description">Description</label>
								<textarea name="description" id="description" class="form-control" rows="2" required></textarea>
							</div>
							<div class="form-group col-md-2">
								<label for="price">Price</label>
								<input type="text" name="price" id="price" class="form-control" required>
							</div>
							<div class="form-group col-md-2">
								<label for="start_date">Start Date</label>
								<input type="date" name="start_date" id="start_date" class="form-control" required>
							</div>
							<div class="form-group col-md-2">
								<label for="end_date">End Date</label>
								<input type="date" name="end_date" id="end_date" class="form-control" required>
							</div>
							<div class="form-group col-md-2">
								<label for="photo">Photo</label>
								<input type="file" name="photo" id="photo" class="form-control-file">
							</div>
						</div>
						<button type="submit" name="Submit" class="btn btn-success btn-block">Add Promotion</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Promotions List Table -->
	<div class="row">
		<div class="col-md-12">
			<div class="card shadow-lg mb-4">
				<div class="card-header bg-info text-white">
					<h3>Promotions List</h3>
				</div>
				<div class="card-body">
					<table class="table table-bordered table-striped text-center">
						<thead class="thead-dark">
							<tr>
								<th>Promo Photo</th>
								<th>Promo Name</th>
								<th>Promo Description</th>
								<th>Promo Price</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>Action(s)</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$symbol = mysqli_fetch_assoc($currencies); //get active currency
							while ($row = mysqli_fetch_array($result)) {
								echo "<tr>";
								echo '<td><img src="../images/' . $row['special_photo'] . '" width="80" height="70" class="img-thumbnail"></td>';
								echo "<td>{$row['special_name']}</td>";
								echo "<td>{$row['special_description']}</td>";
								echo "<td>{$symbol['currency_symbol']}{$row['special_price']}</td>";
								echo "<td>{$row['special_start_date']}</td>";
								echo "<td>{$row['special_end_date']}</td>";
								echo '<td><a href="delete-special.php?id=' . $row['special_id'] . '" class="btn btn-danger btn-sm">Remove Promo</a></td>';
								echo "</tr>";
							}
							mysqli_free_result($result);
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
