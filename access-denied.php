<?php require_once('connection/config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME; ?>: Access Denied</title>
    <!-- Bootstrap CSS for improved styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="page">
    <!-- Navigation Menu -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"><?php echo APP_NAME; ?></a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="foodzone.php">Food Zone</a></li>
                <li class="nav-item"><a class="nav-link" href="specialdeals.php">Special Deals</a></li>
                <li class="nav-item"><a class="nav-link" href="member-index.php">My Account</a></li>
                <li class="nav-item"><a class="nav-link" href="contactus.php">Contact Us</a></li>
            </ul>
        </div>
    </nav>

    <div id="center" class="container mt-5">
        <div class="text-center">
            <h1 class="display-4 text-danger">Access Denied</h1>
            <p class="lead">Oops! You don't have access to this page.</p>
            <p class="mb-4">Please <a href="login-register.php">login</a> or register to continue. The registration is quick and easy!</p>
            <a href="login-register.php" class="btn btn-primary btn-lg">Login/Register</a>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
