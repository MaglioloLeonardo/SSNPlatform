<?php
include("../../Login/SessionManagement.php");
include("../../DB/connectdb.php");
include("../SupportFunctions.php");
include("../../InputFunctions.php");

ControlSession();
roleControl("Farmacista");

$attributiUtente = array("Nome_Farmaco"=>$regexAtLeastOneText, "Produttore_farmaco"=>$regexAtLeastOneText, "Numero_confezioni"=>$regexIntNumber,
                    "Costo_paziente"=>$regexFloatNumber, "Costo"=>$regexFloatNumber, "ID_ricetta"=>$regexIntNumber);
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
if(!array_key_exists("Costo_paziente", $_POST) ||!array_key_exists("Costo", $_POST)||(((float)$_POST["Costo_paziente"])>((float)$_POST["Costo"]))){
    $thereAreErrors = true;
    print "<p><h3>Errore: Il costo attribuito al paziente deve esser minore o uguale il costo totale dell'ordine</h3></p>";
}else if(!array_key_exists("ID_ricetta", $_POST) ||!isPrescriptionValid($_POST["ID_ricetta"])){
    $thereAreErrors = true;
    print "<p><h3>Errore: L'ID usato per identificare la ricetta non è valido</h3></p>";
}else if(!array_key_exists("ID_ricetta", $_POST) ||isPrescriptionSold($_POST["ID_ricetta"])){
    $thereAreErrors = true;
    print "<p><h3>Errore: La ricetta identificata per mezzo dell'ID è già stata espletata per mezzo di un altro odine</h3></p>";
}

if($thereAreErrors){
    die();
}

foreach ($_POST as $attribute => $value){
    $_POST[$attribute] = $GLOBALS["conn"]->real_escape_string($_POST["$attribute"]);
}

$pharmInfos = getPharmFromEmail($_SESSION[session_id()][0]);

$currentDate = date('Y-m-d');
$sql = "INSERT INTO acquisto (ID_ricetta, Numero_Confezioni, Costo, Costo_paziente, Data_vendita, Nome_Farmaco, Produttore_farmaco, Farmacista, Nome_farmacia, Indirizzo_farmacia) 
                VALUES ('{$_POST["ID_ricetta"]}', '{$_POST["Numero_confezioni"]}', '{$_POST["Costo"]}', '{$_POST["Costo_paziente"]}',
                        '{$currentDate}', '{$_POST["Nome_Farmaco"]}', '{$_POST["Produttore_farmaco"]}', '{$_SESSION[session_id()][0]}', '{$pharmInfos["Nome_farmacia"]}', 
                        '{$pharmInfos["Indirizzo_farmacia"]}');";
performInsertQuery($sql, true);

print !$thereAreErrors;
?>
