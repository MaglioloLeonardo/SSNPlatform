<?php

function ControlSession(){
    if(!isset($_COOKIE[session_name()])){
        header("Location: ../../Login/LoginSignupForm.php");
        die();
    }else {
        session_start();
        if (!array_key_exists($_COOKIE[session_name()], $_SESSION)) {
            header("Location: ../../Login/Logout.php");
        }
    }
}

?>