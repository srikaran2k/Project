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

//Selecting records from multiple tables
$result = mysqli_query($conn, "SELECT * FROM orders_details o 
    INNER JOIN cart_details c ON c.cart_id = o.cart_id 
    INNER JOIN quantities q ON q.quantity_id = c.quantity_id 
    INNER JOIN members m ON m.member_id = c.member_id 
    INNER JOIN billing_details b ON b.billing_id = o.billing_id")
or die("There are no records to display ... \n" . mysqli_error());
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Orders</title>
	<!-- Bootstrap CSS -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom Stylesheet -->
	<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="container mt-5">
	<div class="row">
		<div class="col-md-12 text-center">
			<h1>Orders Management</h1>
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

	<!-- Orders List Table -->
	<div class="row">
		<div class="col-md-12">
			<div class="card shadow-lg mb-4">
				<div class="card-header bg-info text-white text-center">
					<h3>Orders List</h3>
				</div>
				<div class="card-body">
					<table class="table table-bordered table-striped text-center">
						<thead class="thead-dark">
							<tr>
								<th>Order ID</th>
								<th>Customer Name</th>
								<th>Food Name</th>
								<th>Food Price</th>
								<th>Quantity</th>
								<th>Total Cost</th>
								<th>Delivery Date</th>
								<th>Delivery Address</th>
								<th>Mobile No</th>
								<th>Action(s)</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php
							// Loop through all table rows
							while ($row = mysqli_fetch_assoc($result)) {
								$lt = $row['lt'];
								if ($lt == 'food') {
									$qry = "SELECT * FROM food_details f 
									        INNER JOIN categories c ON c.category_id = f.food_category 
									        WHERE food_id = {$row['food_id']}";
								} else {
									$qry = "SELECT * FROM specials WHERE special_id = {$row['food_id']}";
								}
								$res = mysqli_fetch_array(mysqli_query($conn, $qry));
								
								echo "<tr>";
								echo "<td>" . $row['order_id'] . "</td>";
								echo "<td>" . $row['firstname'] . " " . $row['lastname'] . "</td>";
								echo "<td>" . $res[$lt . '_name'] . "</td>";
								echo "<td>" . $res[$lt . '_price'] . "</td>";
								echo "<td>" . $row['quantity_value'] . "</td>";
								echo "<td>" . $row['total'] . "</td>";
								echo "<td>" . $row['delivery_date'] . "</td>";
								echo "<td>" . $row['Street_Address'] . "</td>";
								echo "<td>" . $row['Mobile_No'] . "</td>";
								echo '<td><a href="delete-order.php?id=' . $row['order_id'] . '" class="btn btn-danger btn-sm">Remove</a></td>';
								echo '<td><a href="orderComplete.php?id=' . $row['order_id'] . '" class="btn btn-danger btn-sm">Delivered</a></td>';
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
