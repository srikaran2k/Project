<?php
	require_once('auth.php');
?>
<?php
//checking connection and connecting to a database
require_once('connection/config.php');

//Connect to mysqli server
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_DATABASE);
if(!$conn) {
    die('Failed to connect to server: ' . mysqli_error());
}

//define default value for flag
$flag_1 = 1;

//defining global variables
$qry = "";
$excellent_qry = "";
$good_qry = "";
$average_qry = "";
$bad_qry = "";
$worse_qry = "";

//count the number of records in the members, orders_details, and reservations_details tables
$members = mysqli_query($conn, "SELECT * FROM members") or die("There are no records to count ... \n" . mysqli_error()); 
$orders_placed = mysqli_query($conn, "SELECT * FROM orders_details") or die("There are no records to count ... \n" . mysqli_error());
$orders_processed = mysqli_query($conn, "SELECT * FROM orders_details WHERE flag='$flag_1'") or die("There are no records to count ... \n" . mysqli_error());
$tables_reserved = mysqli_query($conn, "SELECT * FROM reservations_details WHERE table_flag='$flag_1'") or die("There are no records to count ... \n" . mysqli_error());
$partyhalls_reserved = mysqli_query($conn, "SELECT * FROM reservations_details WHERE partyhall_flag='$flag_1'") or die("There are no records to count ... \n" . mysqli_error());
$tables_allocated = mysqli_query($conn, "SELECT * FROM reservations_details WHERE flag='$flag_1' AND table_flag='$flag_1'") or die("There are no records to count ... \n" . mysqli_error());
$partyhalls_allocated = mysqli_query($conn, "SELECT * FROM reservations_details WHERE flag='$flag_1' AND partyhall_flag='$flag_1'") or die("There are no records to count ... \n" . mysqli_error());

//get food names and ids from food_details table
$foods = mysqli_query($conn, "SELECT * FROM food_details") or die("Something is wrong ... \n" . mysqli_error());
?>
<?php
    if(isset($_POST['Submit'])){
        //Function to sanitize values received from the form. Prevents SQL injection
        function clean($str) {
            global $conn;
            $str = trim($str);
            return mysqli_real_escape_string($conn, $str);
        }

        //get category id
        $id = clean($_POST['food']);
        
        //get ratings ids
        $ratings = mysqli_query($conn, "SELECT * FROM ratings") or die("Something is wrong ... \n" . mysqli_error());
        $row_1 = mysqli_fetch_array($ratings);
        $row_2 = mysqli_fetch_array($ratings);
        $row_3 = mysqli_fetch_array($ratings);
        $row_4 = mysqli_fetch_array($ratings);
        $row_5 = mysqli_fetch_array($ratings);

        if($row_1) { $excellent = $row_1['rate_id']; }
        if($row_2) { $good = $row_2['rate_id']; }
        if($row_3) { $average = $row_3['rate_id']; }
        if($row_4) { $bad = $row_4['rate_id']; }
        if($row_5) { $worse = $row_5['rate_id']; }

        //selecting records based on food id
        $qry = mysqli_query($conn, "SELECT * FROM food_details, polls_details WHERE polls_details.food_id='$id' AND food_details.food_id='$id'") or die("Something is wrong ... \n" . mysqli_error());
        
        $excellent_qry = mysqli_query($conn, "SELECT * FROM food_details, polls_details WHERE polls_details.food_id='$id' AND food_details.food_id='$id' AND polls_details.rate_id='$excellent'") or die("Something is wrong ... \n" . mysqli_error());
        $good_qry = mysqli_query($conn, "SELECT * FROM food_details, polls_details WHERE polls_details.food_id='$id' AND food_details.food_id='$id' AND polls_details.rate_id='$good'") or die("Something is wrong ... \n" . mysqli_error());
        $average_qry = mysqli_query($conn, "SELECT * FROM food_details, polls_details WHERE polls_details.food_id='$id' AND food_details.food_id='$id' AND polls_details.rate_id='$average'") or die("Something is wrong ... \n" . mysqli_error());
        $bad_qry = mysqli_query($conn, "SELECT * FROM food_details, polls_details WHERE polls_details.food_id='$id' AND food_details.food_id='$id' AND polls_details.rate_id='$bad'") or die("Something is wrong ... \n" . mysqli_error());
        $worse_qry = mysqli_query($conn, "SELECT * FROM food_details, polls_details WHERE polls_details.food_id='$id' AND food_details.food_id='$id' AND polls_details.rate_id='$worse'") or die("Something is wrong ... \n" . mysqli_error());
        
        $no_rate_qry = mysqli_query($conn, "SELECT * FROM food_details WHERE food_id='$id'") or die("Something is wrong ... \n" . mysqli_error());
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Index</title>
	<!-- Bootstrap CSS -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
	<div class="container mt-5">
		<div class="row">
			<div class="col-md-12 text-center">
				<h1 class="display-4">Administrator Control Panel</h1>
				<nav class="nav justify-content-center my-4">
					<a class="nav-link" href="profile.php">Profile</a>
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
			<div class="col-md-12">
				<table class="table table-bordered text-center">
					<caption><h3>Current Status</h3></caption>
					<thead class="thead-dark">
						<tr>
							<th>Members Registered</th>
							<th>Orders Placed</th>
							<th>Orders Processed</th>
							<th>Orders Pending</th>
							<th>Table(s) Reserved</th>
							<th>Table(s) Allocated</th>
							<th>Table(s) Pending</th>
							<th>PartyHall(s) Reserved</th>
							<th>PartyHall(s) Allocated</th>
							<th>PartyHall(s) Pending</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$result1 = mysqli_num_rows($members);
							$result2 = mysqli_num_rows($orders_placed);
							$result3 = mysqli_num_rows($orders_processed);
							$result4 = $result2 - $result3; //pending orders
							$result5 = mysqli_num_rows($tables_reserved);
							$result6 = mysqli_num_rows($tables_allocated);
							$result7 = $result5 - $result6; //pending tables
							$result8 = mysqli_num_rows($partyhalls_reserved);
							$result9 = mysqli_num_rows($partyhalls_allocated);
							$result10 = $result8 - $result9; //pending partyhalls

							echo "<tr>";
							echo "<td>$result1</td>";
							echo "<td>$result2</td>";
							echo "<td>$result3</td>";
							echo "<td>$result4</td>";
							echo "<td>$result5</td>";
							echo "<td>$result6</td>";
							echo "<td>$result7</td>";
							echo "<td>$result8</td>";
							echo "<td>$result9</td>";
							echo "<td>$result10</td>";
							echo "</tr>";
						?>
					</tbody>
				</table>
			</div>
		</div>

		<hr>

		<div class="row">
			<div class="col-md-6 offset-md-3">
				<form name="foodStatusForm" id="foodStatusForm" method="post" action="index.php" onsubmit="return statusValidate(this)">
					<div class="form-group">
						<label for="food">Select Food</label>
						<select class="form-control" name="food" id="food">
							<option value="select">- Select Food -</option>
							<?php 
								while ($row = mysqli_fetch_array($foods)) {
									echo "<option value=$row[food_id]>$row[food_name]</option>"; 
								}
							?>
						</select>
					</div>
					<button type="submit" class="btn btn-primary btn-block" name="Submit">Show Ratings</button>
				</form>
			</div>
		</div>

		<hr>

		<div class="row">
			<div class="col-md-8 offset-md-2">
				<table class="table table-striped table-bordered text-center">
					<caption><h3>Customers' Ratings (100%)</h3></caption>
					<thead class="thead-dark">
						<tr>
							<th>Food</th>
							<th>Excellent</th>
							<th>Good</th>
							<th>Average</th>
							<th>Bad</th>
							<th>Worse</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if(isset($_POST['Submit'])){
								$excellent_value = mysqli_num_rows($excellent_qry);
								$good_value = mysqli_num_rows($good_qry);
								$average_value = mysqli_num_rows($average_qry);
								$bad_value = mysqli_num_rows($bad_qry);
								$worse_value = mysqli_num_rows($worse_qry);
								$total_value = mysqli_num_rows($qry);

								if($total_value != 0){
									$excellent_rate = $excellent_value / $total_value * 100;
									$good_rate = $good_value / $total_value * 100;
									$average_rate = $average_value / $total_value * 100;
									$bad_rate = $bad_value / $total_value * 100;
									$worse_rate = $worse_value / $total_value * 100;
								} else {
									$excellent_rate = 0;
									$good_rate = 0;
									$average_rate = 0;
									$bad_rate = 0;
									$worse_rate = 0;
								}

								$row = mysqli_fetch_array($qry) ? mysqli_fetch_array($qry) : mysqli_fetch_array($no_rate_qry);
								$food_name = $row['food_name'];

								echo "<tr>";
								echo "<td>$food_name</td>";
								echo "<td>$excellent_value ($excellent_rate%)</td>";
								echo "<td>$good_value ($good_rate%)</td>";
								echo "<td>$average_value ($average_rate%)</td>";
								echo "<td>$bad_value ($bad_rate%)</td>";
								echo "<td>$worse_value ($worse_rate%)</td>";
								echo "</tr>";
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- Bootstrap JS and dependencies -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
