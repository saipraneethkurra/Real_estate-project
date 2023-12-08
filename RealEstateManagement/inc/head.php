<?php
// Check if URL_ROOT is defined
if (!defined('URL_ROOT')) {
  define('URL_ROOT', 'http://localhost/RealEstateManagement/');
}

// Check if APP_NAME is defined
if (!defined('APP_NAME')) {
  define('APP_NAME', 'Real Estate Management');
}
session_start();

if (!isset($_SESSION['login_status'])) {
  header('Location: ' . URL_ROOT . 'login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Rental Property Management</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="img/favicon.png">

  <!-- CSS Links -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/app.css">
</head>
<body>