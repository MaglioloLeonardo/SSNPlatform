<?php
$regexOnlyText = "/^[a-zA-Z ]*$/";
$regexAtLeastOneText = "/.*[a-zA-Z0-9].*/";
$regexCODFiscale = "/^(?:[A-Z][AEIOU][AEIOUX]|[B-DF-HJ-NP-TV-Z]{2}[A-Z]){2}(?:[\\dLMNP-V]{2}(?:[A-EHLMPR-T](?:[04LQ][1-9MNP-V]|[15MR][\\dLMNP-V]|[26NS][0-8LMNP-U])|[DHPS][37PT][0L]|[ACELMRT][37PT][01LM]|[AC-EHLMPR-T][26NS][9V])|(?:[02468LNQSU][048LQU]|[13579MPRTV][26NS])B[26NS][9V])(?:[A-MZ][1-9MNP-V][\\dLMNP-V]{2}|[A-M][0L](?:[1-9MNP-V][\\dLMNP-V]|[0L][1-9MNP-V]))[A-Z]$/i";
$regexPassword = "/^(?=.*?[A-Z])(?=(.*[a-z]){1,})(?=(.*[\\d]){1,})(?=(.*[\\W]){1,})(?!.*\\s).{8,30}$/";
$regexDate = "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/";
$regexEmail = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";
$regexBoolean = "/^(0|1)$/";
$regexIntNumber ="/^[0-9]+$/";
$regexFloatNumber = "/^(0|[1-9]\d*)(\.\d+)?$/";

function isValidInput($attributes, $mismatchList){
    foreach ($attributes as $attribute => $regex){
        if(!isset($_POST[$attribute]) || !preg_match($regex, $_POST[$attribute])){
            array_push($mismatchList, $attribute);
        }
    }
    return $mismatchList;
}
?>