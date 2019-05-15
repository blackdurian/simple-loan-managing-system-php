<?php include('system/page_config.php');?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <?php include('partials/_head_tag_contents.php');?>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.php -->
    <?php require_once('partials/_navbar.php');?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.php -->
      <?php require_once('partials/_slidebar.php');?>   
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <?php require_once('partials/_profile.php');?>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.php -->
          <?php require_once('partials/_footer.php');?>
        </div>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <?php include('partials/_scripts.php');?>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>
</html>