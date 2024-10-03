<?php
//checking connection and connecting to a database
require_once('connection/config.php');
error_reporting(1);

//Connect to mysqli server
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
            setcookie('remember_me', gone, $past);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME ?>: Login</title>
    <!-- Bootstrap CSS for styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css">
    <script language="JavaScript" src="validation/user.js"></script>
</head>
<body>
<div id="page">
    <!-- Navigation Menu -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Krispy Takeaway</a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="foodzone.php">Food Zone</a></li>
            <li class="nav-item"><a class="nav-link" href="specialdeals.php">Special Deals</a></li>
            <li class="nav-item"><a class="nav-link" href="member-index.php">My Account</a></li>
            <li class="nav-item"><a class="nav-link" href="contactus.php">Contact Us</a></li>
        </ul>
    </nav>

    <div id="center" class="container mt-5">
        <h1 class="text-center">Login / Register</h1>

        <!-- Login Form -->
        <div class="row">
            <div class="col-md-6">
                <div class="card p-3 mb-3">
                    <h3 class="text-center">Login</h3>
                    <form id="loginForm" name="loginForm" method="post" action="login-exec.php" onsubmit="return loginValidate(this)">
                        <div class="form-group">
                            <label for="login">Email</label>
                            <input name="login" type="text" class="form-control" id="login" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input name="password" type="password" class="form-control" id="password" placeholder="Enter your password" required>
                        </div>
                        <div class="form-group form-check">
                            <input name="remember" type="checkbox" class="form-check-input" id="remember" <?php echo isset($_COOKIE['remember_me']) ? 'checked="checked"' : ''; ?>>
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                        <button type="submit" name="Submit" class="btn btn-primary btn-block">Login</button>
                        <a href="JavaScript: resetPassword()" class="btn btn-link">Forgot password?</a>
                    </form>
                </div>
            </div>

            <!-- Register Form -->
            <div class="col-md-6">
                <div class="card p-3 mb-3">
                    <h3 class="text-center">Register</h3>
                    <form id="registerForm" name="registerForm" method="post" action="register-exec.php" onsubmit="return registerValidate(this)">
                        <div class="form-group">
                            <label for="fname">First Name</label>
                            <input name="fname" type="text" class="form-control" id="fname" placeholder="Enter your first name" required>
                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name</label>
                            <input name="lname" type="text" class="form-control" id="lname" placeholder="Enter your last name" required>
                        </div>
                        <div class="form-group">
                            <label for="login">Email</label>
                            <input name="login" type="email" class="form-control" id="login" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input name="password" type="password" class="form-control" id="password" placeholder="Enter your password" required>
                        </div>
                        <div class="form-group">
                            <label for="cpassword">Confirm Password</label>
                            <input name="cpassword" type="password" class="form-control" id="cpassword" placeholder="Confirm your password" required>
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
                            <input name="answer" type="text" class="form-control" id="answer" placeholder="Enter your security answer" required>
                        </div>
                        <button type="submit" name="Submit" class="btn btn-success btn-block">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
