<?php
include("../../Login/SessionManagement.php");
include("../../DB/connectdb.php");
include("../SupportFunctions.php");
include("../../InputFunctions.php");

ControlSession();
roleControl("Medico");

$attributiUtente = array("Dose_giornaliera" => $regexIntNumber, "Durata_terapia"=>$regexIntNumber, "Esenzione"=>$regexBoolean, "Nome_principio"=>$regexAtLeastOneText, "Utente"=>$regexEmail);
$mismatchList = array();
$thereAreErrors = false;

$mismatchList = isValidInput($attributiUtente, $mismatchList);

if(sizeof($mismatchList)>0){
    $thereAreErrors = true;
    ?>
    <p>
    <h2>Errore</h2>I seguenti campi non rispettano la sintassi corretta:
    <ul>
        <?php foreach ($mismatchList as $attribute){ ?>

            <li><?= $attribute?></li>

            <?php
        } ?>
    </ul>
    </p>
    <?php
}

if(!array_key_exists("Utente", $_POST) || !isEmailValid($_POST["Utente"])){
    $thereAreErrors = true;
    print "<p><h3>Errore: L'email usata non è associata ad un account esistente</h3></p>";
}

if($thereAreErrors){
    die();
}

foreach ($_POST as $attribute => $value){
    $_POST[$attribute] = $GLOBALS["conn"]->real_escape_string($_POST["$attribute"]);
}
$currentDate = date('Y-m-d');
$sql = "INSERT INTO ricetta (Dose_giornaliera, Durata_terapia, Esenzione, Nome_principio, Utente, Data_emissione, Medico) 
                VALUES ('{$_POST["Dose_giornaliera"]}', '{$_POST["Durata_terapia"]}', '{$_POST["Esenzione"]}', '{$_POST["Nome_principio"]}',
                        '{$_POST["Utente"]}', '{$currentDate}', '{$_SESSION[session_id()][0]}')";
performInsertQuery($sql, true);

print !$thereAreErrors;
?>

