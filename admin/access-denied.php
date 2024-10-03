<?php require_once('connection/config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
    <!-- Linking external CSS for improved styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
    <style>
        body {
            background-color: #f8f9fa;
        }
        .error-page {
            max-width: 600px;
            margin: 100px auto;
            padding: 20px;
            border: 1px solid #e0e0e0;
            background-color: white;
            box-shadow: 0px 0px 10px 0px #d6d6d6;
        }
        h1 {
            color: #dc3545;
        }
        .err {
            font-size: 18px;
            color: #dc3545;
        }
        .btn-primary {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div id="page">
    <div class="error-page text-center">
        <h1>Access Denied</h1>
        <p class="err">You do not have access to this resource.</p>
        <p>Please <a href="login-form.php">login</a> to gain access.</p>
        <a href="login-form.php" class="btn btn-primary">Login</a>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>
</div>

<!-- Bootstrap JS for potential interactivity -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
