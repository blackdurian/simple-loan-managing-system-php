<?php
session_start();


//Clear Session
$_SESSION["user_id"] = "";
session_destroy();

// clear cookies
if (isset($_COOKIE["user_login"])) {
    setcookie("user_login", "");
}
header("Location: login.php");
?>