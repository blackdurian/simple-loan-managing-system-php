<?php
session_start();
require_once "class/loginAuth.php";
$auth = new loginAuth();

// Get Current date, time
$current_time = time();
$current_date = date("Y-m-d H:i:s", $current_time);

// Set Cookie expiration for 1 month
$cookie_expiration_time = $current_time + (30 * 24 * 60 * 60);  // for 1 month

$isLoggedIn = false;

// Check if loggedin session and redirect if session exists
if (! empty($_SESSION["user_id"])) {
    $isLoggedIn = true;
}

if ($isLoggedIn) {
  header("Location: index.php");
}

if (! empty($_POST["login"])) {   
    $username = $_POST["user_name"];
    $password = $_POST["user_password"];
    
    $user = $auth->getMemberByUsername($username);

    if (password_verify($password, $user[0]["password"])) {
        require_once "class/admin.php";
        $admin = new admin();
        $name = $admin->getAdminByID($user[0]["user_id"]);
        $_SESSION["user_id"] = $user[0]["user_id"];
        $_SESSION["name"] = $name[0]["name"];
        $_SESSION["role"] = $name[0]["role"];
        //TODO  Set COOKIE
        header("Location: index.php");
        
    } else {
        $message = "Invalid Login";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php print $PAGE_TITLE;?></title>
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
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auto-form-wrapper">
              <form action="" method="post" id="frmLogin">
                <div class="form-group">
                  <label class="label">Username</label>
                  <div class="input-group">
                    <input class="form-control" name="user_name" type="text"  placeholder="Username" 
                    value="<?php if(isset($_COOKIE["user_login"])) { echo $_COOKIE["user_login"]; } ?>">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">Password</label>
                  <div class="input-group">
                    <input class="form-control" name="user_password" type="password"  placeholder="*********"
                    value="<?php if(isset($_COOKIE["user_password"])) { echo $_COOKIE["user_password"]; } ?>"
                    >
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary submit-btn btn-block" type="submit" name="login" value="Login">
                    Login</button>
                </div>
                <div class="form-group d-flex justify-content-between">
                  <!-- <div class="form-check-flat mt-0">
                    <label class="form-check-label">
                      <input type="checkbox" name="remember" id="remember"
                      //TODO remember me
                      <?php //if(isset($_COOKIE["user_login"])) { ?> checked <?php //} ?> /> 
                      <label for="remember-me">Remember me</label>
                    </label>
                  </div> -->
                  <!-- <a href="#" class="text-small forgot-password text-black">Forgot Password</a> -->
                </div>
<!--                 <div class="form-group">
                  <button class="btn btn-block g-login">
                    <img class="mr-3" src="../../images/file-icons/icon-google.svg" alt="">Log in with Google</button>
                </div> -->
<!--                 <div class="text-block text-center my-3">
                  <span class="text-small font-weight-semibold">Not a member ?</span>
                  <a href="register.php" class="text-black text-small">Create new account</a>
                </div> -->
                <div class="error-message text-black text-small text-danger">
                  <?php if(isset($message)) { echo $message; } ?>
                </div>
              </form>
            </div>
            <ul class="auth-footer">
              <li>
                <a href="#">Conditions</a>
              </li>
              <li>
                <a href="#">Help</a>
              </li>
              <li>
                <a href="#">Terms</a>
              </li>
            </ul>
            <p class="footer-text text-center">copyright © 2018 Bootstrapdash. All rights reserved.</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <script src="../../vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/misc.js"></script>
  <!-- endinject -->
</body>

</html>