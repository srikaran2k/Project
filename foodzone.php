<?php
//checking connection and connecting to a database
require_once('connection/config.php');
//Connect to MySQL server
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
if (!$conn) {
    die('Failed to connect to server: ' . mysqli_error());
}

//selecting all records from the food_details table
$result = mysqli_query($conn, "SELECT * FROM food_details,categories WHERE food_details.food_category=categories.category_id")
or die("A problem has occurred. Please check back later.");

//retrieve categories from the categories table
$categories = mysqli_query($conn, "SELECT * FROM categories")
or die("A problem has occurred. Please check back later.");

//retrieve the active currency
$flag_1 = 1;
$currencies = mysqli_query($conn, "SELECT * FROM currencies WHERE flag='$flag_1'")
or die("A problem has occurred. Please check back later.");
?>

<?php
if (isset($_POST['Submit'])) {
    //Function to sanitize values received from the form to prevent SQL injection
    function clean($str) {
        global $conn;
        return mysqli_real_escape_string($conn, trim($str));
    }

    $id = clean($_POST['category']);
    
    if ($id > 0) {
        $result = mysqli_query($conn, "SELECT * FROM food_details,categories WHERE food_category='$id' AND food_details.food_category=categories.category_id")
        or die("A problem has occurred. Please check back later.");
    } elseif ($id == 0) {
        $result = mysqli_query($conn, "SELECT * FROM specials WHERE '" . date('Y-m-d') . "' BETWEEN date(special_start_date) AND date(special_end_date)")
        or die("A problem has occurred. Please check back later.");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Krispy TakeAway Restaurant: Foods</title>
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
        <h1 class="display-4">Choose Your Food</h1>
        <p class="lead">Order your favorite dishes and enjoy special deals!</p>
        <hr class="my-4">
        <p>Select a category to filter the food list or check out our special deals.</p>
    </div>

    <!-- Food Category Form -->
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form name="categoryForm" id="categoryForm" method="post" action="foodzone.php" class="form-inline justify-content-center mb-4">
                <label for="category" class="mr-2">Category</label>
                <select name="category" id="category" class="form-control mr-2">
                    <option value="select">- select category -</option>
                    <?php 
                    while ($row = mysqli_fetch_array($categories)) {
                        echo "<option value='{$row["category_id"]}' " . (isset($id) && $id == $row['category_id'] ? "selected" : "") . ">{$row['category_name']}</option>"; 
                    }
                    ?>
                    <option value="0" <?php echo isset($id) && $id == 0 ? "selected" : ""; ?>>Special Deals</option>
                </select>
                <button type="submit" name="Submit" class="btn btn-primary">Show Foods</button>
            </form>
        </div>
    </div>

    <!-- Food Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
            <thead class="thead-dark">
                <tr>
                    <th>Food Photo</th>
                    <th>Food Name</th>
                    <th>Food Description</th>
                    <th>Food Category</th>
                    <th>Food Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = mysqli_num_rows($result);
                if (isset($_POST['Submit']) && $count < 1) {
                    echo "<tr><td colspan='6'><div class='alert alert-warning'>No foods under the selected category at the moment. Please check back later.</div></td></tr>";
                } else {
                    $symbol = mysqli_fetch_assoc($currencies); //gets active currency
                    $lt = (isset($id) && $id == 0) ? "special" : "food";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td><a href='images/{$row[$lt.'_photo']}' target='_blank'><img src='images/{$row[$lt.'_photo']}' width='80' height='70' alt='Food Image'></a></td>";
                        echo "<td>{$row[$lt.'_name']}</td>";
                        echo "<td>{$row[$lt.'_description']}</td>";
                        echo "<td>" . ($lt == 'food' ? $row['category_name'] : 'SPECIAL DEALS') . "</td>";
                        echo "<td>{$symbol['currency_symbol']}{$row[$lt.'_price']}</td>";
                        echo "<td><a href='cart-exec.php?id={$row[$lt.'_id']}&lt={$lt}' class='btn btn-success btn-sm'>Add To Cart</a></td>";
                        echo "</tr>";
                    }
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
