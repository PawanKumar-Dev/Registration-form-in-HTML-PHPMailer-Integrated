<?php
require_once("connection.php");
session_start();

// This code will prevent exisiting user from accessing signup page when logged in
if (isset($_SESSION['login_active'])) {
  header('Location: admin.php');
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">

  <title>Login & Registration</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Home</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Signup</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container text-center d-flex align-items-center min-vh-100">

    <!-- Begin page content -->
    <div class="card mx-auto bg-info pb-5 px-4" style="width: 25rem;">
      <h1 class="mt-5 text-center">Signup</h1>
      <br>

      <?php if (isset($_SESSION['errors'])) : ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <?php
          $message = $_SESSION['errors'];
          unset($_SESSION['errors']);
          echo $message;
          ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>

      <div>
        <form action="register.php" method="post" autocomplete="off">

          <div class="col-md-12 mb-3">
            <label class="form-label">Name</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-users" aria-hidden="true"></i></span>
              <input type="text" name="name" class="form-control" required>
            </div>
          </div>

          <div class="col-md-12 mb-3">
            <label class="form-label">Email</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>
              <input type="email" name="email" class="form-control" required>
            </div>
          </div>

          <div class="col-md-12 mb-3">
            <label class="form-label">Password</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
              <input type="password" name="password" class="form-control" required>
            </div>
          </div>

          <div class="col-12 text-center mb-3">
            <button class="btn btn-primary" name="signup">Signup <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
          </div>
        </form>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>