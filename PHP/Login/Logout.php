<?php
session_start();
session_destroy();
setcookie(session_name(), '', time()-7000000, '/');
header("Location: LoginSignupForm.php");
die();
?>