<?php
	require_once('auth.php');
?>
<?php
//checking connection and connecting to a database
require_once('connection/config.php');
//Connect to MySQL server
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
if(!$conn) {
	die('Failed to connect to server: ' . mysqli_error());
}

//get member id from session
$memberId = $_SESSION['SESS_MEMBER_ID'];

//selecting all records from the orders_details table
$result = mysqli_query($conn,"SELECT * FROM orders_details o 
	inner join cart_details c on c.cart_id = o.cart_id 
	inner join quantities q on q.quantity_id = c.quantity_id 
	WHERE o.member_id='$memberId'")
or die("There are no records to display ... \n" . mysqli_error()); 

//retrieving all rows from the cart_details table based on flag=0
$flag_0 = 0;
$items = mysqli_query($conn, "SELECT * FROM cart_details WHERE member_id='$memberId' AND flag='$flag_0'")
or die("Something is wrong ... \n" . mysqli_error()); 
$num_items = mysqli_num_rows($items);

//retrieving all rows from the messages table
$messages = mysqli_query($conn, "SELECT * FROM messages")
or die("Something is wrong ... \n" . mysqli_error()); 
$num_messages = mysqli_num_rows($messages);

//retrieve a currency from the currencies table
$flag_1 = 1;
$currencies = mysqli_query($conn, "SELECT * FROM currencies WHERE flag='$flag_1'")
or die("A problem has occurred ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours."); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo APP_NAME; ?>: Member Home</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Krispy Takeaway</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link" href="member-index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="foodzone.php">Food Zone</a></li>
        <li class="nav-item"><a class="nav-link" href="specialdeals.php">Special Deals</a></li>
        <li class="nav-item"><a class="nav-link" href="contactus.php">Contact Us</a></li>
      </ul>
    </div>
  </nav>

  <!-- Welcome Message -->
  <div class="jumbotron text-center">
    <h1>Welcome <?php echo $_SESSION['SESS_FIRST_NAME']; ?></h1>
    <p>View your order history, manage reservations, and more!</p>
  </div>

  <!-- User Options -->
  <div class="text-center mb-3">
    <a href="member-profile.php" class="btn btn-primary">My Profile</a>
    <a href="cart.php" class="btn btn-info">Cart [<?php echo $num_items; ?>]</a>
    <a href="inbox.php" class="btn btn-warning">Inbox [<?php echo $num_messages; ?>]</a>
    <a href="tables.php" class="btn btn-success">Tables</a>
    <a href="partyhalls.php" class="btn btn-danger">Party-Halls</a>
    <a href="ratings.php" class="btn btn-secondary">Rate Us</a>
    <a href="logout.php" class="btn btn-dark">Logout</a>
  </div>

  <!-- Order History -->
  <h2 class="text-center">Order History</h2>
  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead class="thead-dark">
        <tr>
          <th>Order ID</th>
          <th>Food Photo</th>
          <th>Food Name</th>
          <th>Food Category</th>
          <th>Food Price</th>
          <th>Quantity</th>
          <th>Total Cost</th>
          <th>Delivery Date</th>
          <th>Action(s)</th>
        </tr>
      </thead>
      <tbody>
        <?php
        //loop through all table rows
        $symbol = mysqli_fetch_assoc($currencies); //gets active currency
        while ($row = mysqli_fetch_array($result)) {
          $lt = $row['lt'];
          if($lt == 'food') {
            $qry = "SELECT * FROM food_details f inner join categories c on c.category_id = f.food_category WHERE food_id = {$row['food_id']}";
          } else {
            $qry = "SELECT * FROM specials WHERE special_id = {$row['food_id']}";
          }
          $res = mysqli_fetch_array(mysqli_query($conn, $qry));
          echo "<tr>";
          echo "<td>" . $row['order_id'] . "</td>";
          echo '<td><a href="images/' . $res[$lt.'_photo'] . '" target="_blank"><img src="images/' . $res[$lt.'_photo'] . '" class="img-thumbnail" width="80" height="70"></a></td>';
          echo "<td>" . $res[$lt.'_name'] . "</td>";
          echo "<td>" . ($lt == 'food' ? $res['category_name'] : 'Special Deals') . "</td>";
          echo "<td>" . $symbol['currency_symbol'] . $res[$lt.'_price'] . "</td>";
          echo "<td>" . $row['quantity_value'] . "</td>";
          echo "<td>" . $symbol['currency_symbol'] . $row['total'] . "</td>";
          echo "<td>" . $row['delivery_date'] . "</td>";
          echo '<td><a href="delete-order.php?id=' . $row['order_id'] . '" class="btn btn-danger btn-sm">Cancel Order</a></td>';
          echo "</tr>";
        }
        mysqli_free_result($result);
        mysqli_close($conn);
        ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Footer -->
<?php include 'footer.php'; ?>

<!-- Bootstrap JS, jQuery, and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
