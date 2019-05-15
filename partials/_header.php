<?php 
  session_start();

  //todo define cookie

  if (! empty($_SESSION["user_id"]) && ! empty($_SESSION["name"]) ) {
    $isLoggedIn = true;
    $user_id = $_SESSION["user_id"];
    $role = $_SESSION["role"]; 
    $name = $_SESSION["name"];
  }

  if(!$isLoggedIn) {
      header("Location: ./login.php");
  }
  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Tiny Loan Management System</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/custom.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
  </head>
  
  <body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.php -->
    <?php include('partials/_navbar.php');?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.php -->
      <?php include('partials/_slidebar.php');?>   
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">