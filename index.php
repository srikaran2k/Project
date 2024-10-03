<?php
//checking connection and connecting to a database
require_once('connection/config.php');
error_reporting(1);

//Connect to MySQL server
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
if (!$conn) {
    die('Failed to connect to server: ' . mysqli_error());
}

//retrieve questions from the questions table
$questions = mysqli_query($conn, "SELECT * FROM questions")
or die("Something is wrong ... \n" . mysqli_error());
?>

<?php
//setting-up a remember me cookie
if (isset($_POST['Submit'])) {
    //setting up a remember me cookie
    if ($_POST['remember']) {
        $year = time() + 31536000;
        setcookie('remember_me', $_POST['login'], $year);
    } else if (!$_POST['remember']) {
        if (isset($_COOKIE['remember_me'])) {
            $past = time() - 100;
            setcookie('remember_me', '', $past);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Krispy TakeAway Restaurant</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="page">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Krispy Takeaway</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="foodzone.php">Food Zone</a></li>
                <li class="nav-item"><a class="nav-link" href="specialdeals.php">Special Deals</a></li>
                <li class="nav-item"><a class="nav-link" href="member-index.php">My Account</a></li>
                <li class="nav-item"><a class="nav-link" href="contactus.php">Contact Us</a></li>
            </ul>
        </div>
    </nav>

    <!-- Header Section -->
    <header class="bg-primary text-white text-center py-5">
        <h1>Welcome To Krispy Takeaway Restaurant Management System!</h1>
        <p>Order your food today and enjoy fast delivery, weekly deals, and convenient payment options!</p>
    </header>

    <!-- Login and Registration Forms -->
    <div class="container mt-5">
        <div class="row">
            <!-- Login Form -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h3>Login</h3>
                    </div>
                    <div class="card-body">
                        <form id="loginForm" name="loginForm" method="post" action="login-exec.php" onsubmit="return loginValidate(this)">
                            <div class="form-group">
                                <label for="login">Email</label>
                                <input type="text" name="login" class="form-control" id="login" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" required>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="remember" class="form-check-input" id="remember" value="1" <?php if (isset($_COOKIE['remember_me'])) echo 'checked="checked"'; ?>>
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                            <div class="form-group">
                                <a href="JavaScript: resetPassword()">Forgot password?</a>
                            </div>
                            <button type="submit" name="Submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Registration Form -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h3>Register</h3>
                    </div>
                    <div class="card-body">
                        <form id="registerForm" name="registerForm" method="post" action="register-exec.php" onsubmit="return registerValidate(this)">
                            <div class="form-group">
                                <label for="fname">First Name</label>
                                <input type="text" name="fname" class="form-control" id="fname" required>
                            </div>
                            <div class="form-group">
                                <label for="lname">Last Name</label>
                                <input type="text" name="lname" class="form-control" id="lname" required>
                            </div>
                            <div class="form-group">
                                <label for="login">Email</label>
                                <input type="text" name="login" class="form-control" id="login" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" required>
                            </div>
                            <div class="form-group">
                                <label for="cpassword">Confirm Password</label>
                                <input type="password" name="cpassword" class="form-control" id="cpassword" required>
                            </div>
                            <div class="form-group">
                                <label for="question">Security Question</label>
                                <select name="question" id="question" class="form-control" required>
                                    <option value="select">- select question -</option>
                                    <?php 
                                    while ($row = mysqli_fetch_array($questions)) {
                                        echo "<option value='{$row['question_id']}'>{$row['question_text']}</option>"; 
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="answer">Security Answer</label>
                                <input type="text" name="answer" class="form-control" id="answer" required>
                            </div>
                            <button type="submit" name="Submit" class="btn btn-success btn-block">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
