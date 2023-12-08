<?php 
session_start();

require_once 'inc/dbh.php';

if (isset($_POST['submit'])) {
  $user_name = filter(trim($_POST['user_name']));
  $password = filter($_POST['password']);

  $result = $conn->query("SELECT * FROM `users` WHERE `user_name` = '$user_name'");

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['login_status'] = true;
        header('Location: ' . URL_ROOT . 'index.php');
        exit(); // Important to stop the script execution after redirection
    } else {
        header('Location: ' . URL_ROOT . 'login.php?err=true');
        exit(); // Important to stop the script execution after redirection
    }
} else {
    header('Location: ' . URL_ROOT . 'login.php?err=true');
    exit(); // Important to stop the script execution after redirection
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Your Company | Login</title>

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="img/favicon.png">

  <!-- CSS Links -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/login.css">
</head>
<body>
  <div class="container login-container">
    <?php if (isset($_GET['err'])): ?>
      <div class="row">
        <div class="col-md-4 m-auto text-center p-0">
          <div class="alert alert-danger">Incorrect Username or Password! Please try again!</div>
        </div>
      </div>
    <?php endif; ?>

    <!-- Your Company Logo -->
    <div class="text-center mb-3">
              <p><h3> Youngstown apartments</h3></p>

    </div>

    <div class="row">
      <div class="col-md-4 m-auto login-form">
        <form action="login.php" method="POST" autocomplete="off">
          <div class="form-group">
            <input type="text" class="form-control" name="user_name" placeholder="Username" required autofocus>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <span class="text-muted password-info">Make sure you don't save your password in browser due to security reasons!</span>
          </div>
          <div class="form-group text-right mt-4 mb-0">
            <input type="submit" class="btn btn-primary btn-block mb-2 btn-login" name="submit" value="Sign In">
            <a href="register.php" class="text-muted register-link">Don't have account?</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script rel="stylesheet" href="js/bootstrap.min.js"></script>
</body>
</html>