<?php
include("../../Login/SessionManagement.php");
include("../../DB/connectdb.php");
include("../SupportFunctions.php");
include("../../InputFunctions.php");

ControlSession();
roleControl("Farmacista");

$attributiUtente = array("ID_ricetta"=>$regexIntNumber);
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

if(!array_key_exists("ID_ricetta", $_POST) || !isOrderOfPharm($_POST["ID_ricetta"], $_SESSION[session_id()][0])){
    $thereAreErrors = true;
    print "<p><h3>Errore: L'ordine indicato non è stato creato dall'account corrente</h3></p>";
}

if($thereAreErrors){
    die();
}

foreach ($_POST as $attribute => $value){
    $_POST[$attribute] = $GLOBALS["conn"]->real_escape_string($_POST["$attribute"]);
}

$sql = "DELETE FROM acquisto WHERE ID_ricetta = '{$_POST["ID_ricetta"]}' and Farmacista = '{$_SESSION[session_id()][0]}'";
performInsertQuery($sql, true);

print !$thereAreErrors;
?>

