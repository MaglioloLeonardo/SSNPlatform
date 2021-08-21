<?php
include("../../Login/SessionManagement.php");
include("../../DB/connectdb.php");
include("../SupportFunctions.php");
include("../../InputFunctions.php");

ControlSession();
roleControl("Medico");

$attributiUtente = array("ID"=>$regexIntNumber);
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

if(!array_key_exists("ID", $_POST) || !isPrescriptionOfMed($_POST["ID"], $_SESSION[session_id()][0])){
    $thereAreErrors = true;
    print "<p><h3>Errore: La ricetta indicata non è stata creata dall'account corrente</h3></p>";
}else if(!array_key_exists("ID", $_POST) || isPrescriptionSold($_POST["ID"])){
    $thereAreErrors = true;
    print "<p><h3>Errore: Esiste già un ordine effettuato da un farmacista per questa ricetta, non è possibile eliminarla senza prima aver eliminato l'ordine in questione</h3></p>";
}

if($thereAreErrors){
    die();
}

foreach ($_POST as $attribute => $value){
    $_POST[$attribute] = $GLOBALS["conn"]->real_escape_string($_POST["$attribute"]);
}

$sql = "DELETE FROM ricetta WHERE ID = '{$_POST["ID"]}' and Medico = '{$_SESSION[session_id()][0]}'";
performInsertQuery($sql, true);

print !$thereAreErrors;
?>

