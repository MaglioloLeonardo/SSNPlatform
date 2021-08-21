<?php
include("Login.php");
print isLoginValid($_POST["Email"], $_POST["Password"]);
?>
