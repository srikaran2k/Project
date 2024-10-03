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

//retrieve promotions from the specials table
$result = mysqli_query($conn, "SELECT * FROM food_details,categories WHERE food_details.food_category=categories.category_id")
or die("There are no records to display ... \n" . mysqli_error()); 

//retrieve categories from the categories table
$categories = mysqli_query($conn, "SELECT * FROM categories")
or die("There are no records to display ... \n" . mysqli_error()); 

//retrieve a currency from the currencies table
$flag_1 = 1;
$currencies = mysqli_query($conn, "SELECT * FROM currencies WHERE flag='$flag_1'")
or die("A problem has occurred ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after a few hours."); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foods</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript" src="validation/admin.js"></script>
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Foods Management</h1>
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

    <!-- Add New Food Form -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg mb-4">
                <div class="card-header bg-success text-white text-center">
                    <h3>Add a New Food</h3>
                </div>
                <div class="card-body">
                    <form name="foodsForm" id="foodsForm" action="foods-exec.php" method="post" enctype="multipart/form-data" onsubmit="return foodsValidate(this)">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="2" required></textarea>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" name="price" id="price" required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="price">Quantity</label>
                                <input type="number" class="form-control" name="quantity" id="quantity" required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="category">Category</label>
                                <select class="form-control" name="category" id="category" required>
                                    <option value="">- Select -</option>
                                    <?php 
                                    while ($row = mysqli_fetch_array($categories)) {
                                        echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>"; 
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="photo">Photo</label>
                                <input type="file" class="form-control-file" name="photo" id="photo" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Available Foods Table -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg mb-4">
                <div class="card-header bg-info text-white text-center">
                    <h3>Available Foods</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th>Food Photo</th>
                                <th>Food Name</th>
                                <th>Food Description</th>
                                <th>Food Price</th>
                                <th>Food Category</th>
                                <th>Quantity</th>
                                <th>Action(s)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $symbol = mysqli_fetch_assoc($currencies); //gets active currency
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo '<td><img src="../images/' . $row['food_photo'] . '" width="80" height="70"></td>';
                                echo "<td>{$row['food_name']}</td>";
                                echo "<td>{$row['food_description']}</td>";
                                echo "<td>{$symbol['currency_symbol']}{$row['food_price']}</td>";
                                echo "<td>{$row['category_name']}</td>";
                                echo "<td>{$row['Quantity']}</td>";
                                echo '<td><a href="delete-food.php?id=' . $row['food_id'] . '" class="btn btn-danger btn-sm">Remove</a></td>';
                                
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
