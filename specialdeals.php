<?php
//checking connection and connecting to a database
require_once('connection/config.php');
//Connect to MySQL server
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
if (!$conn) {
    die('Failed to connect to server: ' . mysqli_error());
}

//retrieve promotions from the specials table
$result = mysqli_query($conn, "SELECT * FROM specials")
or die("There are no records to display ... \n" . mysqli_error()); 

//retrieve the active currency
$flag_1 = 1;
$currencies = mysqli_query($conn, "SELECT * FROM currencies WHERE flag='$flag_1'")
or die("A problem has occurred. Please check back later.");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Krispy TakeAway Restaurant: Specials</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="page" class="container">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Krispy TakeAway</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="member-index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="foodzone.php">Food Zone</a></li>
                <li class="nav-item"><a class="nav-link" href="specialdeals.php">Special Deals</a></li>
                <li class="nav-item"><a class="nav-link" href="member-index.php">My Account</a></li>
                <li class="nav-item"><a class="nav-link" href="contactus.php">Contact Us</a></li>
            </ul>
        </div>
    </nav>

    <!-- Header Section -->
    <div class="jumbotron text-center">
        <h1 class="display-4">Special Deals</h1>
        <p class="lead">Check out our limited-time offers. Hurry, they won't last long!</p>
        <hr class="my-4">
        <p>To place an order, visit the Food Zone and select Specials from the categories list.</p>
    </div>

    <!-- Specials Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
            <thead class="thead-dark">
                <tr>
                    <th>Promo Photo</th>
                    <th>Promo Name</th>
                    <th>Promo Description</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Promo Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $symbol = mysqli_fetch_assoc($currencies); //gets active currency
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td><a href='images/{$row['special_photo']}' target='_blank'><img src='images/{$row['special_photo']}' class='img-thumbnail' width='80' height='70' alt='Promo Image'></a></td>";
                    echo "<td>{$row['special_name']}</td>";
                    echo "<td class='text-left'>{$row['special_description']}</td>";
                    echo "<td>{$row['special_start_date']}</td>";
                    echo "<td>{$row['special_end_date']}</td>";
                    echo "<td>{$symbol['currency_symbol']}{$row['special_price']}</td>";
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

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
