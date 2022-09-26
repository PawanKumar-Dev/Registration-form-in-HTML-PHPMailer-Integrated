<?php
require_once("connection.php");
session_start();

function sanitize($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if (isset($_POST['login'])) {
  $email = sanitize($_POST['email']);
  $inputpassword = sanitize($_POST['password']);

  $password = md5($inputpassword);

  $sql = "SELECT id FROM users WHERE email = '$email' AND password = '$password' AND active = 1";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    $_SESSION['login_active'] = [$email, $password];
    header("Location: admin.php");
    exit();
  } else {
    $_SESSION['errors'] = "Login Error! Check Email & Password";
    header("Location: index.php");
    exit();
  }
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
            <a class="nav-link active" aria-current="page" href="signup.php">Signup</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container text-center d-flex align-items-center min-vh-100">

    <div class="card mx-auto bg-info py-5" style="width: 25rem;">
      <h1>Login</h1>

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

      <div class="card-body">
        <form action="" method="post">
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>

          <button type="submit" class="btn btn-primary" name="login">Login</button>
        </form>
        <br>
        <a href="signup.php" class="btn btn-warning">Signup Here</a>
      </div>
    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>