<?php
  require_once('connection/config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <title>Administrator Login</title>
  <!-- Bootstrap CDN for styling -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <script language="JavaScript" src="validation/admin.js"></script>
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card">
          <div class="card-header bg-primary text-white text-center">
            <h3>Administrator Login</h3>
          </div>
          <div class="card-body">
            <form id="loginForm" name="loginForm" method="post" action="login-exec.php" onsubmit="return loginValidate(this)">
              <div class="form-group">
                <label for="login"><b>Username</b></label>
                <input name="login" type="text" class="form-control" id="login" required />
              </div>
              <div class="form-group">
                <label for="password"><b>Password</b></label>
                <input name="password" type="password" class="form-control" id="password" required />
              </div>
              <div class="form-group text-center">
                <button type="submit" name="Submit" class="btn btn-primary btn-block">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'footer.php'; ?>
</body>
</html>
