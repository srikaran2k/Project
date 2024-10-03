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

//Retrieve necessary data
$categories = mysqli_query($conn, "SELECT * FROM categories") or die("There are no records to display ... \n" . mysqli_error()); 
$quantities = mysqli_query($conn, "SELECT * FROM quantities") or die("Something is wrong ... \n" . mysqli_error()); 
$currencies = mysqli_query($conn, "SELECT * FROM currencies") or die("Something is wrong ... \n" . mysqli_error()); 
$currencies_1 = mysqli_query($conn, "SELECT * FROM currencies") or die("Something is wrong ... \n" . mysqli_error()); 
$ratings = mysqli_query($conn, "SELECT * FROM ratings") or die("Something is wrong ... \n" . mysqli_error());
$timezones = mysqli_query($conn, "SELECT * FROM timezones") or die("Something is wrong ... \n" . mysqli_error()); 
$timezones_1 = mysqli_query($conn, "SELECT * FROM timezones") or die("Something is wrong ... \n" . mysqli_error());  
$tables = mysqli_query($conn, "SELECT * FROM tables") or die("Something is wrong ... \n" . mysqli_error());
$partyhalls = mysqli_query($conn, "SELECT * FROM partyhalls") or die("Something is wrong ... \n" . mysqli_error());
$questions = mysqli_query($conn, "SELECT * FROM questions") or die("Something is wrong ... \n" . mysqli_error());
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Options</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Options Management</h1>
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

    <!-- Manage Categories -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg mb-4">
                <div class="card-header bg-primary text-white">
                    <h3>Manage Categories</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Add Category -->
                        <div class="col-md-6">
                            <form name="categoryForm" id="categoryForm" action="categories-exec.php" method="post" onsubmit="return categoriesValidate(this)">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <input type="text" name="name" class="form-control" id="category">
                                </div>
                                <button type="submit" name="Insert" class="btn btn-success btn-block">Add</button>
                            </form>
                        </div>
                        <!-- Remove Category -->
                        <div class="col-md-6">
                            <form name="categoryForm" id="categoryForm" action="delete-category.php" method="post" onsubmit="return categoriesValidate(this)">
                                <div class="form-group">
                                    <label for="category">Select Category</label>
                                    <select name="category" class="form-control" id="category">
                                        <option value="select">- select category -</option>
                                        <?php 
                                        while ($row = mysqli_fetch_array($categories)){
                                            echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>"; 
                                        }
                                        ?>
                                    </select>
                                </div>
                                <button type="submit" name="Delete" class="btn btn-danger btn-block">Remove</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Similar blocks for managing Quantities, Currencies, Timezones, Tables, Party-Halls, and Questions -->
    
    <!-- Example for managing quantities -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg mb-4">
                <div class="card-header bg-success text-white">
                    <h3>Manage Quantities</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Add Quantity -->
                        <div class="col-md-6">
                            <form name="quantityForm" id="quantityForm" action="quantities-exec.php" method="post" onsubmit="return quantitiesValidate(this)">
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="text" name="name" class="form-control" id="quantity">
                                </div>
                                <button type="submit" name="Insert" class="btn btn-success btn-block">Add</button>
                            </form>
                        </div>
                        <!-- Remove Quantity -->
                        <div class="col-md-6">
                            <form name="quantityForm" id="quantityForm" action="delete-quantity.php" method="post" onsubmit="return quantitiesValidate(this)">
                                <div class="form-group">
                                    <label for="quantity">Select Quantity</label>
                                    <select name="quantity" class="form-control" id="quantity">
                                        <option value="select">- select quantity -</option>
                                        <?php 
                                        while ($row = mysqli_fetch_array($quantities)){
                                            echo "<option value='{$row['quantity_id']}'>{$row['quantity_value']}</option>"; 
                                        }
                                        ?>
                                    </select>
                                </div>
                                <button type="submit" name="Delete" class="btn btn-danger btn-block">Remove</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Repeat similar structure for Currencies, Timezones, Tables, Party-Halls, Questions -->
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
