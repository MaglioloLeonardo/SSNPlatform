<?php
include("../DB/connectdb.php");
function isLoginValid($email, $password){
    if(!isset($email) || !isset($password))return 0;
    $email = $GLOBALS["conn"]->real_escape_string($email);
    $password = $GLOBALS["conn"]->real_escape_string($password);
    $password = hash('sha256', $password);
    $sql = "Select * from utente where Email = '$email' and Password = '$password';";
    $result = $GLOBALS["conn"]->query($sql);
    if($result and $result->num_rows > 0){
        return 1;
    }else return 0;
}

function isEmailValid($email){
    if(!isset($email)) return 2;
    $email = $GLOBALS["conn"]->real_escape_string($email);
    $sql = "Select * from utente where Email = '$email';";
    $result = $GLOBALS["conn"]->query($sql);
    if($result and $result->num_rows > 0){
        return 1;
    }else return 0;
}
?>
