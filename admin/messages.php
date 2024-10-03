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

//Select all records from the messages table
$result = mysqli_query($conn, "SELECT * FROM messages")
or die("There are no records to display ... \n" . mysqli_error());
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Messages</title>
	<!-- Bootstrap CSS -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom Stylesheet -->
	<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
	<script language="JavaScript" src="validation/admin.js"></script>
</head>
<body>
<div class="container mt-5">
	<div class="row">
		<div class="col-md-12 text-center">
			<h1>Messages Management</h1>
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

	<!-- Send a Message Form -->
	<div class="row">
		<div class="col-md-8 offset-md-2">
			<div class="card shadow-lg mb-4">
				<div class="card-header bg-primary text-white text-center">
					<h3>Send a Message</h3>
				</div>
				<div class="card-body">
					<form id="messageForm" name="messageForm" method="post" action="message-exec.php" onsubmit="return messageValidate(this)">
						<div class="form-group">
							<label for="subject">Subject</label>
							<input type="text" name="subject" id="subject" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="txtmessage">Message</label>
							<textarea name="txtmessage" id="txtmessage" class="form-control" rows="5" required></textarea>
						</div>
						<div class="text-center">
							<button type="submit" class="btn btn-primary">Send Message</button>
							<button type="reset" class="btn btn-secondary">Clear Field</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Sent Messages Table -->
	<div class="row">
		<div class="col-md-12">
			<div class="card shadow-lg mb-4">
				<div class="card-header bg-info text-white text-center">
					<h3>Sent Messages</h3>
				</div>
				<div class="card-body">
					<table class="table table-bordered table-striped text-center">
						<thead class="thead-dark">
							<tr>
								<th>Message ID</th>
								<th>Date Sent</th>
								<th>Time Sent</th>
								<th>Message Subject</th>
								<th>Message Text</th>
								<th>Action(s)</th>
							</tr>
						</thead>
						<tbody>
							<?php
							//Loop through all table rows
							while ($row = mysqli_fetch_array($result)) {
								echo "<tr>";
								echo "<td>{$row['message_id']}</td>";
								echo "<td>{$row['message_date']}</td>";
								echo "<td>{$row['message_time']}</td>";
								echo "<td>{$row['message_subject']}</td>";
								echo "<td class='text-left'>" . nl2br($row['message_text']) . "</td>";
								echo '<td><a href="delete-message.php?id=' . $row['message_id'] . '" class="btn btn-danger btn-sm">Remove</a></td>';
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
