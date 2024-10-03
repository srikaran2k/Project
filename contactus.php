<?php require_once('connection/config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo APP_NAME; ?>: Contacts</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php"><?php echo APP_NAME; ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link" href="member-index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="foodzone.php">Food Zone</a></li>
        <li class="nav-item"><a class="nav-link" href="specialdeals.php">Special Deals</a></li>
        <li class="nav-item"><a class="nav-link" href="member-index.php">My Account</a></li>
        <li class="nav-item active"><a class="nav-link" href="contactus.php">Contact Us</a></li>
      </ul>
    </div>
  </nav>

  <!-- Contact Us Section -->
  <div class="jumbotron text-center">
    <h1>Contact Us</h1>
    <p>We'd love to hear from you! Reach us through the following channels.</p>
  </div>

  <!-- Contact Information -->
  <div class="row">
    <div class="col-md-6">
      <img class="img-fluid" src="images/Gemini_Generated_Image_s41xe0s41xe0s41x.jpg" alt="Restaurant Location" />
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><?php echo APP_NAME; ?> Restaurant</h5>
          <p class="card-text">
            <strong>Address:</strong><br>
            P.O. Box: 77058<br>
            Houston, TX<br>
            USA<br><br>
            <strong>Phone:</strong><br>
            Landline: +1 4553456<br>
            Mobile: +1 234567890<br><br>
            <strong>Email:</strong><br>
            <a href="mailto:sales@krispytakeaways.com">sales@krispytakeaways.com</a>
          </p>
        </div>
      </div>
    </div>
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
